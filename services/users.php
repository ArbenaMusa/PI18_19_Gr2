<?php

interface IUsersManager {
  public function create($data);
  public function check($username, $password);
}

function appendToFile($path, $item) {
  $json = json_decode(file_get_contents($path));
  array_push($json, objectToArray($item));
  file_put_contents($path, json_encode($json));
}

class JsonUsersManager implements IUsersManager {
  public function check($email, $password) {
    global $config;
    $path = $config->json->users;
    $users = json_decode(file_get_contents($path));
    $user = find($users, function ($user) use ($email) {
      return stringEquals($user->email, $email);
    });

    if ($user && password_verify($password, $user->password)) {
      return $user;
    } else {
      return false;
    }
  }

  public function create($data) {
    global $config;
    $path = $config->json->users;
    $email = $data->email;
    $users = json_decode(file_get_contents($path));

    if (any($users, function ($user) use ($email) {
      return stringEquals($user->email, $email);
    })) {
      return true;
    }

    array_push($users, objectToArray($data));
    file_put_contents($path, json_encode($users));
    return false;
  }
}

class SqlUsersManager implements IUsersManager {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }

  public function create($data) {
    $db = $this->app->db;

    $checkForDuplicate = 'SELECT * FROM users WHERE email = %s';
    if ($db->exists($checkForDuplicate, $data->email)) {
      return true;
    }

    $query = "INSERT INTO users(name, email, password, type) VALUES(%s, %s, %s, %s)";
    if(!$db->execute($query, $data->name, $data->email, $data->password, $data->type)) {
      return true;
    }

    return false;
  }

  public function check($email, $password) {
    $db = $this->app->db;

    $user = $db->first('SELECT * FROM users WHERE email=%s', $email);
    if (!$user) {
      return false;
    }

    if (password_verify($password, $user->password)) {
      return $user;
    } else {
      return null;
    }
  }
}
