<?php
require_once "manager.php";

if($authority == "User")
{
    header("Location: ../index.php");
}

if(!isset($_SESSION["email"]))
{
    header("Location: ../index.php");
}

if($_GET)
{

    $blogid = intval($_GET["blogid"]);
    $query = $db->ssql("DELETE FROM blog WHERE blogid=?");
    $query->execute([$blogid]);
    header("Location: ../index.php");
}
?>