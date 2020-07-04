<?php
if (! function_exists('numhash')) {
	function numhash($n) {
		return (((0x0000FFFF & $n) << 16) + ((0xFFFF0000 & $n) >> 16));
	}
}
if (! function_exists('excerpt')) {
	function excerpt($s, $n = 150) {
		$sub = substr(strip_tags($s), 0, $n);
		if(strlen($s)>$n)
			$sub .= '...';
		return $sub;
	}
}