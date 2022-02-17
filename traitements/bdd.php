<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);

$database = 'ipssisqmyteam';
$user = 'ipssisqmyteam';
$pass = 'Ipssi2022myteam';
$host = 'ipssisqmyteam.mysql.db';
$dir = '../bdd' . DS . 'dump.sql';

$mysqlDir = 'C:'.DS.'wamp64'.DS.'bin'.DS.'mysql'.DS.'mysql5.7.31'.DS.'bin';
$mysqldump = $mysqlDir . DS . 'mysqldump';

echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
exec("{$mysqldump} --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

var_dump($output);

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// $database = 'ipssisqmyteam';
// $user = 'ipssisqmyteam';
// $pass = 'Ipssi2022myteam';
// $host = 'ipssisqmyteam.mysql.db';
// $dir = '../bdd/dump.sql';

// echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";

// exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

// var_dump($output);