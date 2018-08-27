<?php


function connect(){
    $server='localhost:3306';
    $user='root';
    $senha='*';
    $db='dieseite';

    $con = new mysqli($server, $user, $senha, $db);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    return $con;
}