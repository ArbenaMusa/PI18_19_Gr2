<?php

interface IUsersManager {
  public function create($data);
  public function check($email, $password);
  public function find($email);
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

  public function find($email) {
    return find($users, function ($user) use ($email) {
      return stringEquals($user->email, $email);
    });
  }
}

class SqlUsersManager implements IUsersManager {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }

  public function create($data) {
    // 0 = success
    // 1 = email is in use
    // 2 = db error
    $db = $this->app->db;

    $checkForDuplicate = 'SELECT * FROM users WHERE email = %s';
    if ($db->exists($checkForDuplicate, $data->email)) {
      return 1;
    }

    $query = "INSERT INTO users(name, email, password, type, verified) VALUES(%s, %s, %s, %s, %d)";
    if(!$db->execute($query, $data->name, $data->email, $data->password, $data->type, 0)) {
      return 2;
    }

    return 0;
  }

  public function check($email, $password) {
    // 0 = success
    // 1 = email/password wrong
    // 2 = email not verified
    $db = $this->app->db;

    $user = $db->first('SELECT * FROM users WHERE email=%s', $email);
    if (!$user) {
      return makeError('Email or password is wrong.');
    }

    if ($user->verified == 0) {
      return makeError('Email is not verified');
    }

    if (password_verify($password, $user->password)) {
      return makeResult($user);
    } else {
      return makeError('Email or password is wrong.');
    }
  }

  public function find($email) {
    return $this->app->db->first('SELECT * FROM users WHERE email=%s', $email);
  }
}
