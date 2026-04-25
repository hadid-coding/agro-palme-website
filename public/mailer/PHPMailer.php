<?php
namespace PHPMailer\PHPMailer;
class PHPMailer {
  public $Host,$SMTPAuth,$Username,$Password,$SMTPSecure,$Port,$CharSet='UTF-8';
  public $From,$FromName,$Subject,$Body;
  private $to=[];
  function isSMTP(){}
  function addAddress($a){ $this->to[]=$a; }
  function send(){
    $headers = "From: {$this->FromName} <{$this->From}>\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";
    return mail(implode(',', $this->to), $this->Subject, $this->Body, $headers);
  }
}
class Exception extends \Exception {}
