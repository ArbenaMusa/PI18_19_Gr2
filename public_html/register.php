<?php

if (POST) {
  /*
      POST = [
        'emri' => 'ardit',
        'email' => '123'
        'mosha' => 19
      ]
  */
  
  $modelState = $app->bind([
    'username' => $match->regex('/^[A-Za-z]{2,5}$/', 'Shfrytezuesi duhet te kete se paku 5 karaktere.'),
    'email' => $match->email('Email e shfrytezuesit nuk eshte valide.'),
    'age' => $match->integer()
  ]);

  if ($modelState->isValid()) {
    // save user
  } else {
    return view('register', [
      'modelState' => $modelState,
      'model' => $modelState->model
    ]);
  }

  if ($modelState->isValid()) {

  }
  
} else {
  return redirect('/login.php');
}