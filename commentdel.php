<?php
    session_start();
    if(!isset($_SESSION['viewNID'])){
        header("location: /Sumit028");
        exit();
    }
    else{
        if(isset($_GET['cid'])){
            $cid=$_GET['cid'];
            $conn=mysqli_connect("localhost","root","","abst_news_portal");
            if(!$conn){
                die('Could not Connect to Database'. mysqli_connect_error());
            }
            $sql="delete from comments where CID='$cid'";
            if(!mysqli_query($conn,$sql)){
                die('SQL query error');
            }
            mysqli_close($conn);
            header("location: newsview.php");
            exit();
        }
    }
?>