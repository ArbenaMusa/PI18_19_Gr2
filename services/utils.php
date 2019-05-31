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

class Result {

  public $value;
  public $error;
  public $isError;
  public $isSuccess;

  public function __construct($val, $isError = false) {
    if($isError) {
      $this->value = null;
      $this->error = $val;
    } else {
      $this->value = $val;
      $this->error = null;
    }
    $this->isError = $isError;
    $this->isSuccess = !$isError;
  }
}

function makeResult($val) {
  return new Result($val, false);
}

function makeError($error) {
  return new Result($error, true);
}

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol . $domainName;
}

// Log utils

function get_caller_info() {
  $c = '';
  $file = '';
  $func = '';
  $class = '';
  $trace = debug_backtrace();
  if (isset($trace[2])) {
    $file = $trace[1]['file'];
    $func = $trace[2]['function'];
    if ((substr($func, 0, 7) == 'include') || (substr($func, 0, 7) == 'require')) {
      $func = '';
    }
  } else if (isset($trace[1])) {
    $file = $trace[1]['file'];
    $func = '';
  }

  if (isset($trace[3]['class'])) {
    $class = $trace[3]['class'];
    $func = $trace[3]['function'];
    $file = $trace[2]['file'];
  } else if (isset($trace[2]['class'])) {
    $class = $trace[2]['class'];
    $func = $trace[2]['function'];
    $file = $trace[1]['file'];
  }

  if ($file != '') {
    $file = basename($file);
  }

  $c = $file . ': ';
  $c .= $class != '' ? $class . '->' : '';
  $c .= $func != '' ? $func . '()' : '';
  return $c;
}

function writeLog($txt = "") {
  file_put_contents(__DIR__ . '/../log.txt', $txt . PHP_EOL, FILE_APPEND | LOCK_EX);
}

function logError($msg = '') {
  writeLog(date('H:i:s') . ' [Error@' . $_SERVER['PHP_SELF'] . '] ' . get_caller_info() . ': ' . $msg);
}

?>
