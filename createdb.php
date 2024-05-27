<?php
$dsn='mysql:host=localhost';
$user='root';
$password='';
try{
//la connexion a mysql:
$pdo=new PDO($dsn,$user,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//creation de a base de donnees
$sql='CREATE DATABASE IF NOT EXISTS ofppt;';
$pdo->exec($sql);

//selection et utilisation de la base de donnes :
$pdo->exec('USE ofppt');

//la creation de tables :
$sql='CREATE TABLE IF NOT EXISTS users(
 cin INT(20) NOT NULL PRIMARY KEY ,
nom VARCHAR(50) ,
prenom VARCHAR(50)
)';

$pdo->exec($sql);

echo 'created has ben done !';


}catch(PDOException $e){
echo 'erreur :' . $e->getMessage();
}








?>