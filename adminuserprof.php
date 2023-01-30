
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
            if(!isset($_SESSION['uname']) || !$_SESSION['isadmin']){
                header("location: /Sumit028");
                exit();
            }
            else{
                if(isset($_GET['id']) && !isset($_SESSION['editID'])){
                    $_SESSION['editID']=$_GET['id'];
                }
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

    <body style="margin-bottom: 200; margin-top: 25px;">
        
        <div class="container">
            <?php
                if(isset($_GET['unerr'])){
                    echo '<div class="alert alert-danger" role="alert">
                            Error! Username is already taken.
                        </div>';
                }
                else if(isset($_GET['imgerr'])){
                    echo '<div class="alert alert-danger" role="alert">
                            Error! Uploaded Image File format is not correct.
                        </div>';
                }
                else if(isset($_GET['pcsucc'])){
                    echo '<div class="alert alert-success" role="alert">
                            Password Updated Successfully!
                        </div>';
                }
            ?>
            <div class="row">
                <div class="elements-center mb-2">
                    <h2 style="text-align: center;">Profile</h2>
                </div>
            </div>
            <?php
                if(!isset($_SESSION['editID'])){
                    die('Session not set for edit.');
                }
                echo
                '<div class="row">
                    <div class="elements-center mb-2">
                    <img src="'. $row['Img_path']. '" class="img-fluid img-thumbnail" alt="No Profile Picture" style="display: block; margin-left: auto; margin-right: auto;" height="200" width="200">
                    </div>
                </div>
                <form action="adminprofcng.php" method="post" enctype="multipart/form-data">
                    <div class="mb-2 col-md-3 elements-center">
                        <label for="pfp" class="form-label d-flex justify-content-center">Upload New Profile Picture</label>
                        <input type="file" class="form-control" value="" id="pfp" name="pfp">
                    </div>
                    <div class="mb-1 col-md-1 elements-center">
                        <label for="id" class="form-label" >ID</label>
                        <input type="number" class="form-control" id="id" name="id" value="'.$row['ID'].'" readonly>
                    </div>
                    <div class="mb-2 p-2 col-md-8 elements-center">
                        <label for="uname" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="uname" name="uname" value="'.$row['User_Name'].'" placeholder="Your Username">
                    </div>
                    <div class="mb-3 p-2 col-md-8 elements-center">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="'.$row['DOB'].'" placeholder="Your Date of Birth">
                    </div>
                    <div class="mb-2 col-md-8 elements-center d-flex justify-content-center">
                        <a class="w-50 mx-2 btn btn-secondary" href="adminpasscng.php">Change Password</a>
                        <button class="w-50 mx-2 btn btn-success" onclick="return confirm('.'\'Are you sure you want to save changes?\''.')" type="submit">Save Changes</button>
                    </div>
                    <div class="mb-3 p-1 col-md-8 elements-center d-flex justify-content-center">
                            <a class="w-50 mx-2 btn btn-info" href="proflist.php"> < Back</a>
                    </div>
                </form>';
                mysqli_close($conn);
            ?>
        </div>
    </body>

</html>