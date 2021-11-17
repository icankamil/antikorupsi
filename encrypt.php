<?php
$id=uniqid('users');
$pass=password_hash("merokokdilarang", PASSWORD_DEFAULT);
echo $pass."<br>";
echo $id;

?>