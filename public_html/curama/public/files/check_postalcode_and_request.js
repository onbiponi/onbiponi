"use strict";
var CheckPostalcodeAndRequest = function(data, views){
    var _normalizePostalcode = function(postalcode) {
        return postalcode
        .replace(/[‐－―ー−-]/g, '')
        .replace(/\s+/g, '')
        .replace(/[０-９]/g, function(s) {
            return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
        });
    };

    var _isPostalcodeValid = function(postalcode) {
        return /^\d{7}$/.test(postalcode);
    };

    var _getLocationData = function(data, views) {
        var fixedPostalcode = _normalizePostalcode(data.postalcode);
        if (_isPostalcodeValid(fixedPostalcode)) {
            data.postalcode = fixedPostalcode;
            $.ajax({
                type: 'GET',
                url: 'https://curama.jp/api/postal/check-released/',
                data: data,
                dataType: 'json',
                success: views.success,
                error: views.error
            });
        }
        return null;
    };

    return {
        run: function() {
            _getLocationData(data, views);
        }
    };
}
