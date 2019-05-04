<?php

if ($app->user->loggedIn()) {
  return view('home');
} else {
  return redirect('/login.php');
}

?>