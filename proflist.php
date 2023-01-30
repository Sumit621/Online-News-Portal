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
            if(isset($_SESSION['editID'])){
                unset($_SESSION['editID']);
            }
            if(isset($_SESSION['editNID'])){
                unset($_SESSION['editNID']);
            }
        ?>
    </head>

    <body>
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
                                    <a class="nav-link disabled" style="color: #eeeedd;"> Admin </a>
                                </li>
                                <li class="nav-item ml-3">
                                    <a class="nav-link" href="/Sumit028">Home<span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item mx-2">
                                    <a class="nav-link active" href="proflist.php">All Profiles List<span class="sr-only">(current)</span></a>
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
                $conn=mysqli_connect("localhost","root","","abst_news_portal");
                if(!$conn){
                    die('Could not Connect to Database'. mysqli_connect_error());
                }
                $sql="select * from users";
                $res=mysqli_query($conn,$sql);
                if(!mysqli_num_rows($res)>0){
                    echo '<h2>No users in the Database!</h2';     
                }
                else{
                    echo 
                    '<table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Image Path</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>';
                    while($row=mysqli_fetch_assoc($res)){
                        echo 
                        '<tr>
                        <td>'.$row['ID'].'</td>
                        <td>'.$row['User_Name'].'</td>
                        <td>'.$row['DOB'].'</td>
                        <td>'.$row['Img_path'].'</td>
                        <td> 
                            <a class="btn mr-2 btn-warning btn-sm" href="adminuserprof.php?id='.$row['ID'].'">Edit</a>
                            <a class="btn ml-2 btn-danger btn-sm" onclick="return confirm('.'\'Are you sure you want to delete this user?\''.')" href="userdel.php?id='.$row['ID'].'">Delete</a>
                        </td>
                        </tr>';

                    }
                    echo 
                    '
                    </tbody>
                    </table>';
          
                }
                mysqli_close($conn);   
            ?>
        </div>

    </body>
</html>