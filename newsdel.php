<?php
    session_start();
    if(!isset($_SESSION['uname']) || !$_SESSION['isadmin']){
        header("location: /Sumit028");
        exit();
    }
    else{
        if(isset($_GET['nid'])){
            $nid=$_GET['nid'];
            $conn=mysqli_connect("localhost","root","","abst_news_portal");
            if(!$conn){
                die('Could not Connect to Database'. mysqli_connect_error());
            }
            $sql="delete from news where NID='$nid'";
            if(!mysqli_query($conn,$sql)){
                die('SQL query error');
            }
            $sql="delete from comments where NID='$nid'";
            if(!mysqli_query($conn,$sql)){
                die('SQL query error');
            }
            mysqli_close($conn);
            header("location: /Sumit028");
            exit();
        }
    }
?>