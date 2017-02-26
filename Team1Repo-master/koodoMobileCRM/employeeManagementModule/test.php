<?php

$password="abc123";
$incorrect="anus";

$crypt=crypt($password);
$compare=crypt($password,$crypt);
$compare=crypt($incorrect,$crypt);

echo $crypt;
echo "<br>";
echo $compare;

?>
