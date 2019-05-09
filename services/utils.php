<?php

define('POST', $_SERVER['REQUEST_METHOD'] === 'POST');
define('GET', $_SERVER['REQUEST_METHOD'] === 'GET');

function fallback(&$a, $b) {
  return $a ? $a : $b;
}

function whenEquals(&$a, $b, $msg) {
  if ($a && $a == $b) {
    return $msg;
  } 
  return '';
}

function arrayToObject($array) {
  return json_decode(json_encode($array), false);
}

function objectToArray($d) {
  if (is_object($d)) {
    $d = get_object_vars($d);
  }

  if (is_array($d)) {
    return array_map(__FUNCTION__, $d);
  } else {
    return $d;
  }
}

?>