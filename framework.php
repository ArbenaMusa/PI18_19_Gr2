<?php

include_once __DIR__ . '/services/utils.php';

$config = arrayToObject([
  'json' => [
    'users' => __DIR__ . '/data/users.json'
  ]
]);

include_once __DIR__ . '/services/user.php';
include_once __DIR__ . '/services/users.php';
include_once __DIR__ . '/services/validation.php';

class App {
  // Serviset
  public $user;
  public $users;

  public function __construct() {
    $this->user = new SessionUser();
    $this->users = new JsonUsersManager();
  }

  public function bind(array $requirements, $source = null) {
    if (!$source) {
      $source = $_POST;
    }

    $data = [];
    $errors = [];
    foreach ($requirements as $key => $validator) {
      $value = null;
      if (isset($source[$key])) {
        $value = $source[$key];
      }

      $data[$key] = $value;
      if (!$validator->validate($value, $key, $source)) {
        $errors[$key] = $validator->error;
      }
    }

    return new ModelState($data, $errors);
  }
}

$app = new App();
$match = new ValidatorFactory();

// MVC
function model($data = [], $errors = []) {
  return new ModelState($data, $errors);
}

function view(string $name, array $data = []) {
  global $app, $config;
  $model = model();
  foreach ($data as $key => $value) {
    $$key = $value;
  }

  include __DIR__ . '/views/' . $name . '.php';
}

function redirect(string $url, $statusCode = 303) {
  header('Location: ' . $url, true, $statusCode);
}

?>