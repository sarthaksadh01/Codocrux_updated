<?php

function connect_to_database()
{
    $link = mysqli_connect("us-cdbr-iron-east-05.cleardb.ne","b2935a1eb069ef","aee5efc4","heroku_cd87107b3c6ab97");
    if(mysqli_error($link))
    {
      die("Failed connecting to databse.. Please try again!");
    }
    else return $link;
}



?>
