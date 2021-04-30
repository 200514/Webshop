<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "webshop";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

define("BASEURL", "http://localhost:8888/PHP/Webshop/");
define("BASEURL_CMS", "http://localhost:8888/PHP/Webshop/admin/");

function prettyDump($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}
