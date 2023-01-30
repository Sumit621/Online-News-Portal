
<?php
    $unerr=false;
    $pwderr=false;
    if($_SERVER['REQUEST_METHOD']!='POST'){
        die('Invalid Request');
    }
    $conn=mysqli_connect("localhost","root","","abst_news_portal");
    if(!$conn){
        die('Could not Connect to Database'. mysqli_connect_error());
    }
    $uname=$_POST["uname"];
    $rawpwd=$_POST["pwd"];
    $conpwd=$_POST["conpwd"];

    $sql="Select * from users where User_Name='$uname'";
    $res=mysqli_query($conn,$sql);

    if(mysqli_num_rows($res)==0){
        if($rawpwd==$conpwd){
            $pwd=password_hash($rawpwd,PASSWORD_DEFAULT);
            $sql="insert into users(User_Name,Password,is_Admin) values ('$uname','$pwd',0)";
            if(mysqli_query($conn,$sql)){
                header("location: login.php");
                exit();
            }
            else{
                echo "Database Insertion Error";
            }
        }
        else{
            $pwderr=true;
            header("location: signup.php?pwderr=" . $pwderr);
            exit();
        }
    }
    else{
        $unerr=true;
        header("location: signup.php?unerr=" . $unerr);
        exit();
    }
    mysqli_close($conn);
?>
 


