<?php
interface Authenticator
{
    public function hashPassword();
    public static function isPasswordCorrect($password,$username);
    public function login($con,$password,$username);
    public static function logout();
    public function createFormErrorSessions();
}
?>
