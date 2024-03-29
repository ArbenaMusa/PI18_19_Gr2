<?php

interface IUser {
  public function logIn($user);
  public function loggedIn();
  public function logOut();
  public function id();
  public function name();
  public function email();
  public function type();
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

  public function loggedIn() {
    return isset($_SESSION['id']) && $_SESSION['id'];
  }

  public function logIn($user) {
    $_SESSION['id'] = $user->id;
    $_SESSION['name'] = $user->name;
    $_SESSION['email'] =$user->email;
    $_SESSION['type'] = $user->type;
  }

  public function logOut() {
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['type']);
  }
}
