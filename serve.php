<?php


/**
 * Server script to deploy a dev-php inline server
 */

$config = parse_ini_file("config.ini");
$host = $config["SERVER_HOST"];
$port = $config["SERVER_PORT"];

echo("Serving in $host:$port");
exec("php -S $host:$port -t public/ router.php");
