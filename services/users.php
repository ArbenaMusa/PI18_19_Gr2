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