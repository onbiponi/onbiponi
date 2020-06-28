var GUEST_BOOKMARKS = "guest_bookmarks";
var APIClient = (function () {
    function APIClient() {
    }
    APIClient.post = function (url, body, callback) {
        var _this = this;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.responseType = 'json';
        xhr.onload = function () {
            _this.onSuccess(xhr.status, xhr.response, callback);
        };
        xhr.onerror = function () {
            _this.onError(xhr.status);
        };
        xhr.send(JSON.stringify(body || {}));
        return;
    };
    APIClient.get = function (url, callback) {
        var _this = this;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url);
        xhr.setRequestHeader("Cache-Control", "no-cache");
        xhr.setRequestHeader("Pragma", "no-cache");
        xhr.setRequestHeader("Expires", "Sat, 01 Jan 2000 00:00:00 GMT");
        xhr.responseType = 'json';
        xhr.onload = function () {
            _this.onSuccess(xhr.status, xhr.response, callback);
        };
        xhr.onerror = function () {
            _this.onError(xhr.status);
        };
        xhr.send();
        return;
    };
    APIClient.onSuccess = function (status, response, callback) {
        if (status === 200) {
            var data = void 0;
            if (typeof response === "string") {
                data = JSON.parse(response);
            }
            else {
                data = response;
            }
            if (callback) {
                callback(data);
            }
        }
        else {
            console.log('onSuccess: Request failed.  Returned status of ' + status);
        }
    };
    APIClient.onError = function (status) {
        console.log('onError: Request failed.  Returned status of ' + status);
    };
    return APIClient;
}());
var Bookmark = (function () {
    function Bookmark() {
    }
    Bookmark.getBookmarkCount = function (callback) {
        var isLoggedIn = Bookmark.readCookie("isLoggedInAsUser");
        if (isLoggedIn && isLoggedIn.toLowerCase() === "true") {
            Bookmark.getUserBookmarkCount(callback);
        }
        else {
            Bookmark.getGuestBookmarkCount(callback);
        }
    };
    Bookmark.bulkPostBookmark = function (callback) {
        var bookmarks = Bookmark.getGuestBookmarkList();
        if (bookmarks.length === 0) {
            return;
        }
        var payloadBookmarks = bookmarks.map(function (bm) { return ({
            serviceId: bm.serviceId,
            itemId: bm.itemId
        }); });
        var payload = {
            bookmarks: payloadBookmarks
        };
        var completion = function (data) {
            var badgeCount = Bookmark.convertBookmarkCount(data.totalCount);
            callback(badgeCount);
        };
        APIClient.post("/v1/bookmark/bulkcreate/", payload, completion);
    };
    Bookmark.removeAllLocalBookmark = function () {
        window.localStorage.removeItem(GUEST_BOOKMARKS);
    };
    Bookmark.getUserBookmarkCount = function (callback) {
        var completion = function (data) {
            var badgeCount = Bookmark.convertBookmarkCount(data.totalCount);
            callback(badgeCount);
        };
        APIClient.get("/v1/bookmarkcounts/", completion);
    };
    Bookmark.getGuestBookmarkCount = function (callback) {
        var bookmarkStoredString = window.localStorage.getItem(GUEST_BOOKMARKS);
        if (!bookmarkStoredString) {
            callback("");
            return;
        }
        var bookmarks;
        var count = 0;
        if (bookmarkStoredString) {
            try {
                bookmarks = JSON.parse(bookmarkStoredString);
            }
            catch (err) {
                callback("");
                return;
            }
            count = count + bookmarks.filter(function (b) { return !b.isDisabled; }).length;
        }
        var badgeCount = Bookmark.convertBookmarkCount(count);
        callback(badgeCount);
        return;
    };
    Bookmark.removeAllGuestBookmark = function () {
        window.localStorage.removeItem(GUEST_BOOKMARKS);
    };
    Bookmark.setCookie = function (cookie, value, days) {
        if (!days) {
            days = 365 * 10;
        }
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toUTCString();
        document.cookie = cookie + "=" + value + expires + "; path=/";
    };
    Bookmark.readCookie = function (name) {
        var cookies = document.cookie || '';
        var cookieIndex = cookies.indexOf(name);
        if (cookieIndex === -1) {
            return;
        }
        var cookie = cookies.split(name + '=').pop();
        if (!cookie) {
            return;
        }
        var items = cookie.split(';');
        if (items.length !== 0) {
            return items[0];
        }
        return;
    };
    Bookmark.getGuestBookmarkList = function () {
        var bookmarkStoredString = window.localStorage.getItem(GUEST_BOOKMARKS);
        if (!bookmarkStoredString) {
            return [];
        }
        var bookmarks;
        try {
            bookmarks = JSON.parse(bookmarkStoredString);
        }
        catch (err) {
            return [];
        }
        return bookmarks.filter(function (b) { return !b.isDisabled; });
    };
    Bookmark.convertBookmarkCount = function (count) {
        if (count === 0) {
            return "";
        }
        return count > 9 ? "9+" : "" + count;
    };
    return Bookmark;
}());
var CookieStatuses;
(function (CookieStatuses) {
    CookieStatuses["Empty"] = "Empty";
    CookieStatuses["Created"] = "Created";
    CookieStatuses["Changed"] = "Changed";
    CookieStatuses["Deleted"] = "Deleted";
})(CookieStatuses || (CookieStatuses = {}));
var CookieListener = (function () {
    function CookieListener(cookie, callback) {
        this.cookieName = cookie;
        this.callback = callback;
    }
    CookieListener.prototype.start = function () {
        var cookie = Bookmark.readCookie(this.cookieName);
        var listeningCookie = Bookmark.readCookie("listeningCookie");
        var registeredCookie = listeningCookie ? JSON.parse(listeningCookie) : {};
        if (!registeredCookie[this.cookieName] && cookie) {
            this.callback(CookieStatuses.Created);
        }
        else if (registeredCookie[this.cookieName] && !cookie) {
            this.callback(CookieStatuses.Deleted);
        }
        else if (cookie !== registeredCookie[this.cookieName]) {
            this.callback(CookieStatuses.Changed);
        }
        else {
            this.callback(CookieStatuses.Empty);
        }
        if (cookie) {
            registeredCookie[this.cookieName] = cookie;
            var registeredCookieString = JSON.stringify(registeredCookie);
            Bookmark.setCookie("listeningCookie", registeredCookieString);
        }
        return;
    };
    return CookieListener;
}());