<?php
    session_start();
    if(!isset($_SESSION['uname'])){
        header("location: /Sumit028");
        exit();
    }
    else{
        $conn=mysqli_connect("localhost","root","","abst_news_portal");
        if(!$conn){
            die('Could not Connect to Database'. mysqli_connect_error());
        }
        $uname=$_POST['uname'];
        $sql="select * from users where User_Name='$uname'";
        $res=mysqli_query($conn,$sql);
        $sesun=$_SESSION['uname'];
        if($uname!=$sesun && mysqli_num_rows($res)>0){
            header("location: userprof.php?unerr=1");
            exit();
        }
        else{
            $dob=$_POST['dob'];
            $img_path=$_SESSION['img_path'];
            if($_FILES['pfp']['name']!=""){
                $img_path="static/".$_FILES['pfp']['name'];
                if(preg_match("!image!",$_FILES['pfp']['type'])){
                    if(!copy($_FILES['pfp']['tmp_name'],$img_path)){
                        die('Error Copying file');
                    }
                }
                else{
                    header("location: userprof.php?imgerr=1");
                    exit();
                }
            }
            $sql="update users set User_Name='$uname', DOB='$dob', Img_path='$img_path' where User_Name='$sesun'";
            if(mysqli_query($conn,$sql)){
                $_SESSION['uname']=$uname;
                $_SESSION['img_path']=$img_path;
                mysqli_close($conn); 
                header("location: /Sumit028");
                exit();
            }
            else{
                die("SQL Query error");
            }
        }
    }
    mysqli_close($conn); 
?>