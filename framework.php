<?php

include __DIR__ . '/services/utils.php';

$config = arrayToObject([
  'json' => [
    'users' => __DIR__ . '/data/users.json'
  ]
]);

include __DIR__ . '/services/user.php';
include __DIR__ . '/services/users.php';
include __DIR__ . '/services/validation.php';

class App {
  // Serviset
  public $user;
  public $users;

  public function __construct() {
    $this->user = new SessionUser();
    $this->users = new JsonUsersManager();
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
      if (!$validator->validate($value, $key, $data)) {
        $errors[$key] = $validator->error;
      }
    }

    return new ModelState($model, $errors);
  }
}

$app = new App();
$match = new ValidatorFactory();

// MVC
function model($props = [], $errors = []) {
  $model = new stdClass();
  foreach ($props as $key => $value) {
    $model->${key} = $value;
  }

  return new ModelState($model, $errors);
}

function view(string $name, array $data = []) {
  global $app, $config;
  $modelState = model();
  foreach ($data as $key => $value) {
    $$key = $value;
  }

  $model = $modelState->model;
  include __DIR__ . '/views/' . $name . '.php';
}

function redirect(string $url, $statusCode = 303) {
  header('Location: ' . $url, true, $statusCode);
}

?>