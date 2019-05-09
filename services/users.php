<?php

interface IUsersManager {
  public function create($data);
}

function appendToFile($path, $item) {
  $json = json_decode(file_get_contents($path));
  array_push($json, objectToArray($item));
  file_put_contents($path, json_encode($json));
}

class JsonUsersManager implements IUsersManager {
  public function create($data) {
    global $config;
    appendToFile($config->json->users, $data);
  }
}