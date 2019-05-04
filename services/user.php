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

  public function name() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
  }

  public function loggedIn() {
    return isset($_SESSION['user']) && $_SESSION['user'];
  }

  public function logOut() {
    unset($_SESSION['user']);
  }
}
