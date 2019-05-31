<?php

interface IUser {
  public function name();
  public function loggedIn();
  public function logOut();
}

class SessionUser implements IUser {
  public function __construct() {
    session_start();
  }

  public function id() {
    return isset($_SESSION['id']) ? $_SESSION['id'] : null;
  }

  public function name() {
    return isset($_SESSION['name']) ? $_SESSION['name'] : null;
  }

  public function email() {
    return isset($_SESSION['email']) ? $_SESSION['email'] : null;
  }

  public function type() {
    return isset($_SESSION['type']) ? $_SESSION['type'] : null;
  }

  public function title() {
    return isset($_SESSION['title']) ? $_SESSION['title'] : null;
  }

  public function loggedIn() {
    return isset($_SESSION['email']) && $_SESSION['email'];
  }

  public function logIn($user) {
    $_SESSION['id'] = $user->id;
    $_SESSION['email'] =$user->email;
    $_SESSION['name'] = $user->name;
    $_SESSION['type'] = $user->type;
  }

  public function logOut() {
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    unset($_SESSION['type']);
  }
}
