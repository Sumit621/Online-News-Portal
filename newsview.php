<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <?php
        session_start();
        if(!isset($_GET['nid']) && !isset($_SESSION['viewNID'])){
            header("location: /Sumit028");
            exit();
        }
        else{
            if(!isset($_SESSION['viewNID'])){
                $_SESSION['viewNID']=$_GET['nid'];
            }
            $conn=mysqli_connect("localhost","root","","abst_news_portal");
            if(!$conn){
                die('Could not Connect to Database'. mysqli_connect_error());
            }
            $nid=$_SESSION['viewNID'];
            $sql="select * from news where NID='$nid'";
            $res=mysqli_query($conn,$sql);
            if(mysqli_num_rows($res)==1){
                $row=mysqli_fetch_assoc($res);     
            }
            else{
                die('SQL Query result invalid');
            }
        }
    ?>
</head>

<style>
    h2{
        font-family: "Times New Roman", Times, serif;
        font-size: 60px;
        font-size: bold;
    }
</style>

<body style="margin-bottom: 10px;">

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
                if(isset($_SESSION['uname'])){
                    if($_SESSION['isadmin']){
                        if(isset($_SESSION['editNID'])){
                            unset($_SESSION['editNID']);
                        }
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
                                    <a class="nav-link" href="addnews.php">Add News</a>
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
                                <a class="nav-link" href="userprof.php">Profile <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="logout.php">Log-out</a>
                            </li>
                        </ul>';
                    }
                }
                else{
                    echo
                    '<ul class="navbar-nav mr-auto">
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="/Sumit028">Home<span class="sr-only">(current)</span></a>
                            </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="signup.php">Sign-up</a>
                        </li>
                    </ul>';
                }
            ?>
        </div>
    </nav>

    <div class="container mb-4">
        <div class="row mb-2 d-flex justify-content-center">
            <div class="d-flex justify-content-center">
                <h2><?php echo $row['Headline'];?></h2>
            </div>
        </div>
        <div class="row mb-2 d-flex justify-content-center">
            <div class="d-flex justify-content-center">
                <?php
                    $phs_arr=preg_split("/[,]/",$row["Img_paths"]);
                    $i=1;
                    foreach ($phs_arr as $ph){
                        if($i<=2){
                            echo '<img class="mx-2" src="'.$ph.'" class="img-fluid" alt="" height="400px" width="400px">';
                            $i++;
                        }
                        else{
                            echo '     
                                </div>
                            </div>
                            <div class="row mb-2 d-flex justify-content-center">
                                <div class="d-flex justify-content-center">
                                <img class="mx-2" src="'.$ph.'" class="img-fluid" alt="" height="480" width="480">';
                            $i=1;
                        }
                    }
                ?>
            </div>
        </div>
        <div class="row mt-3 mb-3 d-flex ">
            <div class="d-flex">
                <p><?php echo $row['Body'];?></p>
            </div>
        </div>
        <div class="row mb-2 d-flex">
            <h3 class="mt-5 float-left">Comments:</h3> 
        </div>
        <hr class="my-2">
        <?php
            $sql="select * from comments where NID='$nid'";
            $res=mysqli_query($conn,$sql);
            while($cmts=mysqli_fetch_assoc($res)){
                $uid=$cmts["UID"];
                $sql2="select * from users where ID='$uid'";
                $res2=mysqli_query($conn,$sql2);
                if(mysqli_num_rows($res2)==1){
                    $usr=mysqli_fetch_assoc($res2);     
                }
                else{
                    die('SQL Query result invalid');
                }
                echo '
                    <div class="card mb-3">
                        <div class="row g-0 mb-1">
                            <div class="col-md-10">
                                <div class="card-body">';
                if($usr["is_Admin"]){
                    echo '
                                    <h6 class="card-title"><strong> '.$usr["User_Name"].'</strong></h6>
                    ';
                }
                else{
                    echo'
                                    <h6 class="card-title"><img src="'.$usr["Img_path"].'" width="36" height="36" class="rounded-circle"><strong> '.$usr["User_Name"].'</strong></h6>
                    ';  
                }
                echo'               
                                    <p class="card-text mb-1">'.$cmts["Comment"].'</p>
                                </div>
                            </div>';
                if(isset($_SESSION['uname']) && ($_SESSION['id']==$cmts["UID"] || $_SESSION['isadmin'])){
                    echo '
                            <div class="col-md-6 pb-3 ml-3">
                                <a class="btn btn-sm ml-2 btn-danger" onclick="return confirm('.'\'Are you sure you want to delete this comment?\''.')" href="commentdel.php?cid='.$cmts["CID"].'">Delete</a>
                            </div>';
                }
                       
                echo'   </div>
                    </div>
                ';

            }
            if(isset($_SESSION['uname'])){
                echo '
                    <div class="my-4">
                        <form class="justify-content-center" action="addcomment.php" method="post">
                            <div class="mb-3 p-2 col-md-8 justify-content-center">
                                <label for="cbod" class="form-label">Write a Comment</label>
                                <textarea maxlength="2000" class="form-control" id="cbod" name="cbod" placeholder="Your Comment..." rows="4"></textarea>
                            </div>
                        
                            <div class="col-md-8 text-center"> 
                                <button class="w-25 btn btn-sm btn-success" type="submit" name="addCmnt" onclick="return confirm('.'\'Are you sure you want to post comment?\''.')">Post Comment</button>
                            </div>
                        </form>
                    </div>
                ';
            }
        ?> 
            
        <!-- <div class="card mb-3">
            <div class="row g-0 mb-1">
                <div class="col-md-10">
                    <div class="card-body">
                        <h6 class="card-title"><img src="" width="20" height="20"><strong> User Name</strong></h6>
                        <p class="card-text mb-1">this is the comment body. It can be very long as well.</p>
                    </div>
                </div>
                <div class="col-md-6 pb-3 ml-3">
                    <a class="btn btn-sm ml-2 btn-danger" onclick="return confirm('Are you sure you want to delete this news?')" href="/">Delete</a>
                </div>
            </div>
        </div> -->

        <!-- <div class="my-4">
            <form class="justify-content-center" action="adminnewscng.php" method="post">
                <div class="mb-3 p-2 col-md-8 justify-content-center">
                    <label for="cbod" class="form-label">Write a Comment</label>
                    <textarea maxlength="2000" class="form-control" id="cbod" name="cbod" placeholder="Your Comment..." rows="4"></textarea>
                </div>
            
                <div class="col-md-8 text-center"> 
                    <button class="w-25 btn btn-sm btn-success" type="submit" name="addCmnt" onclick="return confirm('Are you sure you want to post comment?')">Post Comment</button>
                </div>
            </form>
        </div> -->  
    </div>

    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>