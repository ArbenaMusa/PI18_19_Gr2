<?php

interface IEmailSender {
  public function verifyEmail($email, $id);
  public function resetPassword($email);
  public function joinClass();
}

class EmailManager implements IEmailSender {
  public function verifyEmail($model, $id) {
    $link = 'http://' . $_SERVER['HTTP_HOST'] . '/verify_email.php?id=' . $id;
    $subject = 'Email verification - StuDB';
    $msg = 'Dear ' . $model->name . ", please click the link below to verify your email\n" . $link;
    writeLog($msg);

    if(!mail($model->email, $subject, $msg)) {
      logError('Error sending mail to ' . $model->email);
      return false;
    }

    return true;
  }

  public function resetPassword($email) {

  }

  public function joinClass() {

  }
}

?>