<?php
require_once "includes/logged.php";
require_once "../includes/connection.php";

if(isset($_GET["id"]) and isset($_GET["table"]) and isset($_SERVER["HTTP_REFERER"])) {
    $id = $_GET["id"];
    $table = $_GET["table"];

    try {
        $sql = "DELETE FROM `news_db`.". $table ." WHERE `id`=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

//        echo "Deleted successfully";
        if  ($table == "news"){
            header("Location: News.php") or die();
        } else {
            header("Location: categories.php") or die();
        }
    } catch (PDOException $e) {
        echo "Error in handling delete.php: " . $e->getMessage();
    }
}