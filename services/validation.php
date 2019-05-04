<?php

interface IValidator {
  public function validate($value);
}

class RegexValidator implements IValidator {
  private $pattern;
  
  public function __construct($pattern) {
    $this->pattern = $pattern;
  }

  public function validate($value) {
    return preg_match($this->pattern, $value);
  }
}

class ValidatorPair {
  public function __construct($validator, $error) {
    $this->validator = $validator;
    $this->error = $error;
  }

  public $validator;
  public $error;

  public function validate($value) {
    return $this->validator->validate($value);
  }
}

class ValidatorFactory {
  public function regex($pattern, $error = 'Vlera e dhene nuk eshte valide.') {
    return new ValidatorPair(new RegexValidator($pattern), $error);
  }

  public function integer($error = 'Vlera e dhene nuk eshte numer valid.') {
    return new ValidatorPair(new RegexValidator('\d+'), $error);
  }

  public function real($error = 'Vlera e dhene nuk eshte numer valid.') {
    return new ValidatorPair(new RegexValidator('\d+(\.\d+)?'), $error);
  }

  public function email($error = 'Vlera e dhene nuk eshte email valide.') {
    return new ValidatorPair(new RegexValidator('TODO'), $error);
  }
}

class ModelState {
  private $errorMap;

  public function __construct($model, $errorMap) {
    $this->model = $model;
    $this->errorMap = $errorMap;
  }

  public $model;

  public function errors() {
    return array_values($this->errorMap);
  }

  public function errorsAssoc() {
    return $this->errorMap;
  }

  public function isValid() {
    return !empty($this->errors);
  }

  public function isValidProperty($key) {
    return isset($this->errorMap[$key]);
  }
}
