
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $conn=mysqli_connect("localhost","root","","abst_news_portal");
        if(!$conn){
            die('Could not Connect to Database'. mysqli_connect_error());
        }
        $uname=$_POST["uname"];
        $rawpwd=$_POST["pwd"];

        $sql="Select * from users where User_Name='$uname'";
        $res=mysqli_query($conn,$sql);

        if(mysqli_num_rows($res)==1){
            $row=mysqli_fetch_assoc($res);
            if(password_verify($rawpwd,$row['Password'])){
                session_start();
                $_SESSION['uname']=$row['User_Name'];
                $_SESSION['id']=$row['ID'];
                $_SESSION['isadmin']=$row['is_Admin'];
                $_SESSION['img_path']=$row['Img_path'];
                mysqli_close($conn);
                header("location: /Sumit028");
                exit();
            }
            else{
                $pwderr=true;
            }
                
        }
        
        else{
            $unerr=true;
        }
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="jquery-3.5.1.slim.min.js"></script>
        <script src="popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>

    <style>

        .elements-center{
            width: 100%;
            padding: auto;
            align-items: center;
            margin: auto;
        }

        h1{
            font-family: "Times New Roman", Times, serif;
            text-align: center;
        }

    </style>

    <?php
        if(isset($unerr)){
            echo '<div class="alert alert-danger" role="alert">
                        Error! Wrong Username.
                    </div>';
        }
        else if(isset($pwderr)){
            echo '<div class="alert alert-danger" role="alert">
                        Error! Wrong Password.
                    </div>';
        }

    ?>

    <body style="margin-bottom: 200px; margin-top: 20px;">
        <div class="container">
            <div class="row mb-2 mt-5">
                <div class="elements-center">
                    <img src="Newsicon.png" style="display: block; margin-left: auto; margin-right: auto;" height="75" width="75">
                    <h1>ABST News Portal</h1>
                </div>
            </div>
            <div class="row">
                <div class="elements-center mb-3">
                    <h3 style="text-align: center;">Log-in</h3>
                </div>
            </div>
            <form action="login.php" method="post">
                <div class="mb-3 p-3 col-md-8 elements-center">
                    <label for="uname" class="form-label">User Name</label>
                    <input type="text" maxlength="50" class="form-control" id="uname" name="uname" placeholder="Your Username">
                </div>
                <div class="mb-3 p-3 col-md-8 elements-center">
                    <label for="pwd" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Your Password">
                </div>
                <div class="mb-3 p-3 col-md-8 elements-center d-flex justify-content-center">
                    <button class="w-50 btn btn-secondary" type="submit">Log in</button>
                </div>
            </form>
        </div>
    </body>

</html>