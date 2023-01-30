<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <?php
        session_start();
        if(isset($_SESSION['viewNID'])){
            unset($_SESSION['viewNID']);
        }
    ?>
</head>

<body style="margin-bottom: 100px;">

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
                                <a class="nav-link active" href="/Sumit028">Home<span class="sr-only">(current)</span></a>
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
                                <img src="'.$_SESSION['img_path'].'" alt="pfp" width="32" height="32" class="rounded-circle">
                            </li>';
                        }

                        echo
                            '<li class="nav-item ml-3">
                                <a class="nav-link active" href="/Sumit028">Home<span class="sr-only">(current)</span></a>
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
                                <a class="nav-link active" href="/Sumit028">Home<span class="sr-only">(current)</span></a>
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

    <div class="container">
        <div class="row mb-3 d-flex justify-content-center">
            <div class="d-flex justify-content-center">
                <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
                    <input class="form-control mr-sm-2" type="search" name="srchtxt" placeholder="Search News" aria-label="Search">
                    <button class="btn btn-secondary my-2" type="submit" name="srch">Search</button>
                </form>
            </div>
        </div>
        <?php
            if(isset($_SESSION['uname']) && $_SESSION['isadmin']){
                echo
                '<div class="row mb-2 d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary btn-lg my-2" href="addnews.php"><strong>+</strong> Add News</a>
                    </div>
                </div>';
            }
        ?>
        
        <?php
            $conn=mysqli_connect("localhost","root","","abst_news_portal");
            if(!$conn){
                die('Could not Connect to Database'. mysqli_connect_error());
            }
            if(isset($_POST['srch'])){
                $srchal=strtolower($_POST['srchtxt']);
                $srchau=strtoupper($_POST['srchtxt']);
                $srchfl=lcfirst($_POST['srchtxt']);
                $srchfu=ucfirst($_POST['srchtxt']); 
                $srchfa=ucwords($_POST['srchtxt']); 
                $sql="select * from news
                        where (Headline like '%$srchal%')
                        or (Headline like '%$srchau%')
                        or (Headline like '%$srchfl%')
                        or (Headline like '%$srchfu%')
                        or (Headline like '%$srchfa%')";
            }
            else{
                $sql="select * from news";
            }
            $res=mysqli_query($conn,$sql);
            if(mysqli_num_rows($res)>0){
                while($row=mysqli_fetch_assoc($res)){
                    if(strlen($row['Body'])>80){
                        $nbod=substr($row['Body'],0,80)."...";
                    }
                    else{
                        $nbod=$row['Body'];
                    }
                    echo
                    '<div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">'.$row['Headline'].'</h5>
                                    <p class="card-text mb-1">'.$nbod.'</p>
                                    <a href="newsview.php?nid='.$row['NID'].'" class="card-text stretched-link">Continue reading</a>
                                    <p class="card-text mt-1"><small class="text-muted">Last updated on '.$row['Time'].'</small></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <img src="'.$row['Thumbnail'].'" class="img-fluid img-thumbnail" alt="">
                            </div>';
                    if(isset($_SESSION['uname']) && $_SESSION['isadmin']){
                        echo'
                            <div class="col-md-6 pb-3 ml-3">
                                <a class="btn mr-2 btn-warning" href="addnews.php?nid='.$row['NID'].'">Edit</a>
                                <a class="btn ml-2 btn-danger" onclick="return confirm('.'\'Are you sure you want to delete this news?\''.')" href="newsdel.php?nid='.$row['NID'].'">Delete</a>
                            </div>
                        ';
                    }
                    echo'
                        </div>
                    </div>';

                }
            }
            else{
                echo
                '<div class="row mb-2 d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                        <h2>Sorry! No News Found</h2>
                    </div>
                </div>';
            }
            mysqli_close($conn);
        ?>
        
    </div>

    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>