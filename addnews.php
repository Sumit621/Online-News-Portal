
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
                $conn=mysqli_connect("localhost","root","","abst_news_portal");
                if(!$conn){
                    die('Could not Connect to Database'. mysqli_connect_error());
                }
                if(isset($_GET['nid'])){
                    $_SESSION['editNID']=$_GET['nid'];
                }
                if(isset($_SESSION['editNID'])){
                    $nid=$_SESSION['editNID'];
                    $sql="select * from news where NID='$nid'";
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
                                    <a class="nav-link active" href="addnews.php">Add News</a>
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
                ?>
            </div>
        </nav>
        <div class="container">
            <?php
                if(isset($_GET['imgerr'])){
                    echo '<div class="alert alert-danger" role="alert">
                            Error! Uploaded Thumbnail Image File format is not correct.
                        </div>';
                }
                else if(isset($_GET['imgPherr'])){
                    echo '<div class="alert alert-danger" role="alert">
                            Error! Uploaded Body Photos File format is not correct.
                        </div>';
                }
            ?>
            <div class="row">
                <div class="elements-center mb-3">
                    <h2 style="text-align: center;">News</h2>
                </div>
            </div>
            <?php
                if(isset($_SESSION['editNID'])){
                    echo
                    '
                    <form action="adminnewscng.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3 p-2 col-md-8 elements-center">
                            <label for="nhead" class="form-label">Headline</label>
                            <input type="text" maxlength="200" class="form-control" id="nhead" name="nhead" value="'.$row['Headline'].'" placeholder="News Headline">
                        </div>
                        <div class="mb-3 p-2 col-md-8 elements-center">
                            <label for="nbod" class="form-label">Body</label>
                            <textarea maxlength="2000" class="form-control" id="nbod" name="nbod" echo placeholder="News Body" rows="4">'.$row['Body'].'</textarea>
                        </div>';
                }
                else{
                    echo
                    '
                    <form action="adminnewscng.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3 p-2 col-md-8 elements-center">
                            <label for="nhead" class="form-label">Headline</label>
                            <input type="text" maxlength="200" class="form-control" id="nhead" name="nhead" placeholder="News Headline">
                        </div>
                        <div class="mb-3 p-2 col-md-8 elements-center">
                            <label for="nbod" class="form-label">Body</label>
                            <textarea maxlength="2000" class="form-control" id="nbod" name="nbod" placeholder="News Body" rows="4"></textarea>
                        </div>';
                        
                }
                echo 
                    '<div class="mb-3 p-2 col-md-6 elements-center">
                                <label for="tmb" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control" value="" id="tmb" name="tmb">
                    </div>
                    <div class="mb-3 p-2 col-md-6 elements-center">
                        <label for="phs" class="form-label">Photos</label>
                        <input type="file" class="form-control" value="" id="phs" name="phs[]" multiple>
                    </div>
                    <div class="mb-3 p-1 col-md-8 elements-center d-flex justify-content-center">
                        <button class="w-50 mx-2 btn btn-success" onclick="return confirm('.'\'Are you sure you want to add/change this news?\''.')" type="submit">Save Changes</button>
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