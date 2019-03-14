<?php
/****************************************************
String managment functions published in
https://zetawiki.com/wiki/PHP_utf8_chr(),_utf8_ord()

CC-BY-SA 3.0 · Powered by MediaWiki
https://zetawiki.com/wiki/%EC%A0%9C%ED%83%80%EC%9C%84%ED%82%A4_zetawiki
****************************************************/

function utf8_ord($ch) {
  $len = strlen($ch);
  if($len <= 0) return false;
  $h = ord($ch{0});
  if ($h <= 0x7F) return $h;
  if ($h < 0xC2) return false;
  if ($h <= 0xDF && $len>1) return ($h & 0x1F) <<  6 | (ord($ch{1}) & 0x3F);
  if ($h <= 0xEF && $len>2) return ($h & 0x0F) << 12 | (ord($ch{1}) & 0x3F) << 6 | (ord($ch{2}) & 0x3F);          
  if ($h <= 0xF4 && $len>3) return ($h & 0x0F) << 18 | (ord($ch{1}) & 0x3F) << 12 | (ord($ch{2}) & 0x3F) << 6 | (ord($ch{3}) & 0x3F);
  return false;
}

function utf8_chr($num) {
   if($num<128) return chr($num);
   if($num<2048) return chr(($num>>6)+192).chr(($num&63)+128);
   if($num<65536) return chr(($num>>12)+224).chr((($num>>6)&63)+128).chr(($num&63)+128);
   if($num<2097152) return chr(($num>>18)+240).chr((($num>>12)&63)+128).chr((($num>>6)&63)+128).chr(($num&63)+128);
   return false;
}


?>