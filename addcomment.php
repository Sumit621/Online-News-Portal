<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        die('Invalid Request');
    }
    if(!isset($_SESSION['uname']) || !isset($_SESSION['viewNID'])){
        header("location: /Sumit028");
        exit();
    }
    else{
        $conn=mysqli_connect("localhost","root","","abst_news_portal");
        if(!$conn){
            die('Could not Connect to Database'. mysqli_connect_error());
        }
        $uid=$_SESSION['id'];
        $nid=$_SESSION['viewNID'];
        $cbod=$_POST['cbod'];
        
        $sql="insert into comments(UID,NID,Comment) 
                values ('$uid','$nid','$cbod')";
        if(mysqli_query($conn,$sql)){
            mysqli_close($conn);
            header("location: newsview.php");
            exit();
        }
        else{
            mysqli_close($conn); 
            die("SQL Query error");
        }
    }
?>