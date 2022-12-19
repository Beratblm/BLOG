<?php
require_once("crud.php");

$db = new crud();


error_reporting(0);
ob_start();
session_start();




//We pulled the logged in user's data from the database
if(isset($_SESSION["email"]))
{
    $users = $db->read("users",$_SESSION["email"],"email");   
    $usernumber = $users->rowCount();
    $usersinfo = $users->fetch(PDO::FETCH_ASSOC);
    if($usernumber > 0)
    {
        $username = $usersinfo["username"];
        $email = $usersinfo["email"];
        $registerdate = $usersinfo["registerdate"];
        $authority = $usersinfo["authority"];
    }
}



// // we pull data of blog posts from database
$bloginfo = $db->optionalread("blog", ["column_name" => "blogid", "column_sort" => "desc"]);

if($_GET)
{
     $blogid = intval($_GET["blogid"]);
     $query = $db->read("blog",$blogid, "blogid");
     $query->execute([$_GET["blogid"]]);
     $info = $query->fetch(PDO::FETCH_ASSOC); 
}

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
