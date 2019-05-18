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

interface IDynamicData {
  public function getData();
}

function objectToArray($d) {
  if ($d instanceof IDynamicData) {
    $d = $d->getData();
  }

  if (is_object($d)) {
    $d = get_object_vars($d);
  }

  if (is_array($d)) {
    return array_map(__FUNCTION__, $d);
  } else {
    return $d;
  }
}

// String utils

function stringEquals($str1, $str2) {
  return strcasecmp($str1, $str2) == 0;
}

function queryString(&$data) {
  if (isset($data) && count($data) > 0) {
    return '?' . http_build_query($data);
  } else {
    return '';
  }
}

function buildLink($url, $data = []) {
  return $url . queryString($data);
}

// Array utils

function any(&$array, $predicate) {
  foreach ($array as $value) {
    if ($predicate($value)) {
      return true;
    }
  }

  return false;
}

function &find(&$array, $predicate) {
  foreach ($array as $value) {
    if ($predicate($value)) {
      return $value;
    }
  }

  return null;
}

?>
