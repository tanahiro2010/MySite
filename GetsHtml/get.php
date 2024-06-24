<?php
require './functions.php';
require './userAgents.php';

$url = $_GET['url'];
$html = request($url, array_rand($userAgents));
echo $html;
?>