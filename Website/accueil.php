<?php
$source = "mysql:host=localhost;dbname=login_moderationtrain";
$login = "user";
$mdp = "azerty";
try{
    $db = new PDO($source, $login, $mdp);
    echo "Vous êtes connecté !";
    }
catch(PDOException $e)
{
    $error_message = $e->getMessage();
    echo $error_message;
    exit();
}
?>
