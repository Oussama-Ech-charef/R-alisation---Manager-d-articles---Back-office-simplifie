<?php
require 'connexion.php';
require 'article.php';

$database = new Database();
$db = $database->getConnection();
$article_obj = new Article($db);

if(isset($_GET['id'])) {
    if($article_obj->delete($_GET['id'])) {
        header("Location: index.php");
    }
}
?>