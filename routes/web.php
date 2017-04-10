<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    echo "Hostname 'redis' can be found at: " . gethostbyname('redis')."\n";
    echo "Hostname 'postgres' can be found at " . gethostbyname('postgres')."\n";

    $hostname='postgres';
    $username='docker';
    $password='docker';
    $dbname='my_app';

    try {
        $dbh = new PDO("pgsql:host=$hostname;dbname=$dbname", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        echo "BRYAN: Connected to the database at hostname 'postgres': " . gethostbyname('postgres') . "\n";
    } catch(Exception $e) {
        echo $e->getMessage();
    }
});
