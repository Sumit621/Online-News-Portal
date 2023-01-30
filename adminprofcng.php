<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        die('Invalid Request');
    }
    if(!isset($_SESSION['uname']) || !$_SESSION['isadmin'] || !$_SESSION['editID']){
        header("location: /Sumit028");
        exit();
    }
    else{
        $conn=mysqli_connect("localhost","root","","abst_news_portal");
        if(!$conn){
            die('Could not Connect to Database'. mysqli_connect_error());
        }
        $id=$_SESSION['editID'];
        $uname=$_POST['uname'];
        $sql="select * from users where ID='$id'";
        $res1=mysqli_query($conn,$sql);
        $row1=mysqli_fetch_assoc($res1);
        $dbun=$row1['User_Name'];
        $sql="select * from users where User_Name='$uname'";
        $res=mysqli_query($conn,$sql);
        if($uname!=$dbun && mysqli_num_rows($res)>0){
            header("location: adminuserprof.php?unerr=1");
            exit();
        }
        else{
            $dob=$_POST['dob'];
            $img_path=$row1['Img_path'];
            if($_FILES['pfp']['name']!=""){
                $img_path="static/".$_FILES['pfp']['name'];
                if(preg_match("!image!",$_FILES['pfp']['type'])){
                    if(!copy($_FILES['pfp']['tmp_name'],$img_path)){
                        die('Error Copying file');
                    }
                }
                else{
                    header("location: adminuserprof.php?imgerr=1");
                    exit();
                }
            }
            $sql="update users set User_Name='$uname', DOB='$dob', Img_path='$img_path' where User_Name='$dbun'";
            if(mysqli_query($conn,$sql)){
                header("location: proflist.php");
                exit();
            }
            else{
                die("SQL Query error");
            }
        }
    }
    mysqli_close($conn); 
?>