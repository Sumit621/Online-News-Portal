
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
            if(!isset($_SESSION['uname'])){
                header("location: /Sumit028");
                exit();
            }
            else{
                $conn=mysqli_connect("localhost","root","","abst_news_portal");
                if(!$conn){
                    die('Could not Connect to Database'. mysqli_connect_error());
                }
                $uname=$_SESSION['uname'];
                $id=$_SESSION['id'];
                $sql="select * from users where User_Name='$uname' and ID='$id'";
                $res=mysqli_query($conn,$sql);
                if(mysqli_num_rows($res)==1){
                    $row=mysqli_fetch_assoc($res);     
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

    <body style="margin-bottom: 200px;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
            <a class="navbar-brand" href="/Sumit028">
            <img src="Newsiconbw.png" alt="" width="30" height="30" class="d-inline-block align-text-top">    
            ABST News</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                    if($_SESSION['isadmin']){
                        echo
                        '<ul class="navbar-nav mr-auto">
                            <li class="nav-item mr-4">
                                <a class="nav-link disabled" style="color:#eeeedd;"> Admin </a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="/Sumit028">Home<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="proflist.php">All Profiles List<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="logout.php">Log-out</a>
                            </li>
                        </ul>';

                    }
                    else{
                        echo
                        '<ul class="navbar-nav mr-auto">
                            <li class="nav-item mr-1">
                                <a class="nav-link disabled" style="color:#eeffee;">Hi, '. $_SESSION["uname"] . '</a>
                            </li>';
                        if($_SESSION['img_path']!=null){
                            echo
                            '<li class="nav-item mr-4">
                                <img src="'.$_SESSION['img_path'].'" alt="mdo" width="32" height="32" class="rounded-circle">
                            </li>';
                        }

                        echo
                            '<li class="nav-item ml-3">
                                <a class="nav-link" href="/Sumit028">Home<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link active" href="userprof.php">Profile <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="logout.php">Log-out</a>
                            </li>
                        </ul>';
                    }
                ?>
            </div>
        </nav>
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
                <div class="elements-center mb-3">
                    <h2 style="text-align: center;">Profile</h2>
                </div>
            </div>
            <?php
                echo
                '<div class="row">
                    <div class="elements-center mb-3">
                    <img src="'. $row['Img_path']. '" class="img-fluid img-thumbnail" alt="No Profile Picture" style="display: block; margin-left: auto; margin-right: auto;" height="200" width="200">
                    </div>
                </div>
                <form action="profcng.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3 col-md-3 elements-center">
                        <label for="pfp" class="form-label d-flex justify-content-center">Upload New Profile Picture</label>
                        <input type="file" class="form-control" value="" id="pfp" name="pfp">
                    </div>
                    <div class="mb-3 p-2 col-md-8 elements-center">
                        <label for="uname" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="uname" name="uname" value="'.$row['User_Name'].'" placeholder="Your Username">
                    </div>
                    <div class="mb-4 p-2 col-md-8 elements-center">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="'.$row['DOB'].'" placeholder="Your Date of Birth">
                    </div>
                    <div class="mb-3 p-1 col-md-8 elements-center d-flex justify-content-center">
                        <a class="w-50 mx-2 btn btn-secondary" href="passcng.php">Change Password</a>
                        <button class="w-50 mx-2 btn btn-success" onclick="return confirm('.'\'Are you sure you want to save changes?\''.')" type="submit">Save Changes</button>
                    </div>
                    <div class="mb-3 p-1 col-md-8 elements-center d-flex justify-content-center">
                            <a class="w-50 mx-2 btn btn-info" href="/Sumit028"> < Back</a>
                    </div>
                </form>';
                mysqli_close($conn);
            ?>
        </div>
    </body>

</html>