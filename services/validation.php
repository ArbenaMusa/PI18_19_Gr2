<?php

include_once(__DIR__ . '/utils.php');

interface IValidator {
  public function validate($value, $key, $data);
}

class RegexValidator implements IValidator {
  private $pattern;

  public function __construct($pattern) {
    $this->pattern = $pattern;
  }

  public function validate($value, $key, $data) {
    return preg_match($this->pattern, $value);
  }
}

class EmailValidator implements IValidator {
  public function validate($value, $key, $data) {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }
}

// Kontrollon nese vlera eshte e barabarte me ndonje vlere tjeter ne input
class EqualsValidator implements IValidator {
  private $other;

  public function __construct($other) {
    $this->other = $other;
  }

  public function validate($value, $key, $data) {
    $other = $this->other;
    return isset($data[$other]) && $value == $data[$other];
  }
}

class EitherValidator implements IValidator {
  private $options;

  public function __construct($options = []) {
    $this->options = $options;
  }

  public function validate($value, $key, $data) {
    return in_array($value, $this->options);
  }
}

class NoValidator implements IValidator {
  public function validate($value, $key, $data) {
    return true;
  }
}

class RequiredValidator implements IValidator {
  public function validate($value, $key, $data) {
    return !!$value;
  }
}

class ValidatorPair {
  public function __construct(IValidator $validator, $error) {
    $this->validator = $validator;
    $this->error = $error;
  }

  public $validator;
  public $error;

  public function validate($value, $key, $data) {
    return $this->validator->validate($value, $key, $data);
  }
}

class ValidatorFactory {
  public function regex($pattern, $error = 'Invalid value') {
    return new ValidatorPair(new RegexValidator($pattern), $error);
  }

  public function integer($error = 'Not a number') {
    return new ValidatorPair(new RegexValidator('/^\d+$/'), $error);
  }

  public function real($error = 'Not a number') {
    return new ValidatorPair(new RegexValidator('\d+(\.\d+)?'), $error);
  }

  public function email($error = 'Invalid email') {
    return new ValidatorPair(new EmailValidator(), $error);
  }

  public function equals($other, $error = 'Fields dont match') {
    return new ValidatorPair(new EqualsValidator($other), $error);
  }

  public function either($options, $error = 'Invalid') {
    return new ValidatorPair(new EitherValidator($options), $error);
  }

  public function required($error = 'Required') {
    return new ValidatorPair(new RequiredValidator(), $error);
  }

  public function noValidation($error = '') {
    return new ValidatorPair(new NoValidator(), $error);
  }

  public function phone($error = 'Invalid phone number') {
    return new ValidatorPair(new RegexValidator('/^[+]?[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'), $error);
  }

  public function title($error = 'Invalid title') {
    return new ValidatorPair(new RegexValidator('/^[A-Za-z\.]{0,4}$/'), $error);
  }

  public function website($error = 'Invalid website') {
    return new ValidatorPair(new RegexValidator("/^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/"), $error);
  }
}

class ModelState implements IDynamicData {
  public static function empty() {
    return new ModelState();
  }

  private $errorMap;
  private $data;

  public function __construct($data = [], $errorMap = []) {
    $this->data = $data;
    $this->errorMap = $errorMap;
  }

  public function __isset($key) {
    return isset($this->data[$key]);
  }

  public function &__get($key) {
    return $this->data[$key];
  }

  public function __set($key, $value) {
    $this->data[$key] = $value;
  }

  public function get($key) {
    return $this->data[$key];
  }

  public function set($key, $value) {
    $this->data[$key] = $value;
  }

  public function getData() {
    return $this->data;
  }

  public function errors() {
    return array_values($this->errorMap);
  }

  public function errorsAssoc() {
    return $this->errorMap;
  }

  public function getError(string $key) {
    if (isset($this->errorMap[$key])) {
      return $this->errorMap[$key];
    }
    return null;
  }

  public function setError(string $key, string $error) {
    $this->errorMap[$key] = $error;
  }

  public function clearError(string $key) {
    unset($this->errorMap[$key]);
  }

  public function clearErrors() {
    $this->errorMap = [];
  }

  public function isValid($key = null) {
    if ($key == null) {
      return empty($this->errors());
    } else {
      return $this->isValidProperty($key);
    }
  }

  public function isValidProperty($key) {
    return isset($this->errorMap[$key]);
  }

  public function pluck($fields = []) {
    $data = $this->data;
    $errors = $this->errorMap;
    $newData = [];
    $newErrors = [];
    foreach ($fields as $field) {
      $newData[$field] = fallback($data[$field], null);
      if (isset($errors[$field])) {
        $newErrors[$field] = $errors[$field];
      }
    }

    return new ModelState($newData, $newErrors);
  }

  public function without($fields = []) {
    $all = array_keys($this->data);
    return $this->pluck(array_diff($all, $fields));
  }
}
