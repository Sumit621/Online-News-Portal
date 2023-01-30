<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="jquery-3.5.1.slim.min.js"></script>
        <script src="popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <?php
            session_start();
            if(!isset($_SESSION['uname']) || !$_SESSION['isadmin'] || !$_SESSION['editID']){
                header("location: /Sumit028");
                exit();
            }
            else{
                if(isset($_SESSION['editID'])){
                    $conn=mysqli_connect("localhost","root","","abst_news_portal");
                    if(!$conn){
                        die('Could not Connect to Database'. mysqli_connect_error());
                    }
                    $id=$_SESSION['editID'];
                    $sql="select * from users where ID='$id'";
                    $res=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($res)==1){
                        $row=mysqli_fetch_assoc($res);     
                    }
                }
            }
        ?>
       
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

    <body style="margin-bottom: 100;">
        <?php
            if(!isset($_SESSION['editID'])){
                die('Session not set for edit.');
            }
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $npass=$_POST['npass'];
                $rtpass=$_POST['rtpass'];
                if($npass==$rtpass){
                    $pwd=password_hash($npass,PASSWORD_DEFAULT);
                    $sql="update users set Password='$pwd' where ID='$id'";
                    if(mysqli_query($conn,$sql)){
                        header("location: adminuserprof.php?pcsucc=1");
                        exit();
                    }
                    else{
                        die("SQL Query error");
                    }
                    
                }
                else{
                    echo '<div class="alert alert-danger" role="alert">
                            Error! Passwords do not match.
                        </div>';
                }
        
            }
        ?>
        <div class="container mt-5">
                <div class="row">
                    <div class="elements-center mb-4">
                        <h2 style="text-align: center;">Password Change for ID:<?php echo $id;?></h2>
                    </div>
                </div>
                    <form action="adminpasscng.php" method="post">
                        <div class="mb-4 p-2 col-md-8 elements-center">
                            <label for="npass" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="npass" name="npass"  placeholder="Your New Password">
                            
                        </div>
                        <div class="mb-4 p-2 col-md-8 elements-center">
                            <label for="rtpass" class="form-label">Re-type New Password</label>
                            <input type="password" class="form-control" id="rtpass" name="rtpass" " placeholder="Re-type Your New Password">
                        </div>
                        <div class="mb-4 p-2 col-md-8 elements-center d-flex justify-content-center">
                            <a class="w-50 mx-2 btn btn-secondary" href="adminuserprof.php">Back</a>
                            <button class="w-50 mx-2 btn btn-warning" onclick="return confirm('Are you sure you want to update password?')" type="submit">Update Password</button>
                        </div>
                    </form>
        </div>
        <?php mysqli_close($conn); ?>
    </body>

</html>