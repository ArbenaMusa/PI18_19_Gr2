<?php

include __DIR__ . '/services/user.php';
include __DIR__ . '/services/validation.php';

class App {
  public $user;

  public function __construct() {
    $this->user = new SessionUser(); 
  }

  public function bind(array $requirements, $data = null) {
    if (!$data) {
      $data = $_POST;
    }

    $model = new stdClass();
    $errors = [];
    foreach ($requirements as $key => $validator) {
      $value = null;
      if (isset($data[$key])) {
        $value = $data[$key];
      }

      $model->{$key} = $value;
      if (!$validator->validate($value)) {
        $errors[$key] = $validator->error;
      }
    }

    return new ModelState($model, $errors);
  }
}

define('POST', $_SERVER['REQUEST_METHOD'] === 'POST');
define('GET', $_SERVER['REQUEST_METHOD'] === 'GET');
$app = new App();
$match = new ValidatorFactory();

function redirect(string $url, $statusCode = 303) {
  header('Location: ' . $url, true, $statusCode);
}

function view(string $name, array $data = []) {
  global $app;
  foreach ($data as $key => $value) {
    $$key = $value;
  }

  include __DIR__ . '/views/' . $name . '.php';
}

function fallback(&$a, $b) {
  return $a ? $a : $b;
}

?>