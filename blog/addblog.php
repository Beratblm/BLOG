<?php
// cannot access the page if there is no session
require_once "manager.php";

if(!isset($_SESSION["email"]))
{
    header("Location: ../index.php");
}

$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


if($_POST)
{
    $title = $_POST["title"];
    $text = $_POST["text"];
    $titlenumber = strlen($title);
    if($titlenumber > 80)
    {
        $errormsg = "Title is too long.";
        header("Refresh: 1; url=$url");
    }
    else
    {
        if($title!="" && $text!="")
        {
          
            $query = $db->ssql("INSERT INTO blog SET blogtitle=?, blogtext=?, user=?, time=?");
            $addblog = $query->execute([$title, $text, $username, date("Y-m-d h:i:s")]);
            if($addblog)
            {
                $errormsg = "Text Added.";
                header("Refresh: 1; url=$url");
            }
            else
            {
                $errormsg = "Could not add text.";
                header("Refresh: 1; url=$url");
            }
        }
        else
        {
            $errormsg = "Do not leave empty space!";
            header("Refresh: 1; url=$url");
        }
    }
}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Add Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include "../navbar.php"?>
    <div class="container mt-3">
      <div class="row">
      <div class="col-md-12 mx-auto">
        <form method="POST">
            <input type="text" name="title"  class="form-control" placeholder="Title">
            <textarea name="text" class="form-control mt-1" cols="30" rows="10" placeholder="Text"></textarea>
            <?php
                if(!empty($errormsg))
                {
                    ?>
                    <div class="alert alert-success mt-1" id="textadd" role="alert">
                    <?php echo $errormsg;?>
                    </div>
                    <?php
                }
                ?>
            <button type="submit" class="btn btn-warning mt-1">Publish</button>
        </form>
      </div>
      </div>
    </div>
</body>
</html>

