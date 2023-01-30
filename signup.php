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
        if(isset($_GET['pwderr'])){
            echo '<div class="alert alert-danger" role="alert">
                        Error! Passwords do not match.
                    </div>';
        }

        else if(isset($_GET['unerr'])){
            echo '<div class="alert alert-danger" role="alert">
                    Error! Username is already taken.
                </div>';
        }
    ?>

    <body style="margin-bottom: 200px; margin-top: 30px;">

        <div class="container">
            <div class="row">
                <div class="elements-center">
                    <img src="Newsicon.png" style="display: block; margin-left: auto; margin-right: auto;" height="75" width="75">
                    <h1>ABST News Portal</h1>
                </div>
            </div>
            <div class="row">
                <div class="elements-center">
                    <h3 style="text-align: center;">Sign-up</h3>
                </div>
            </div>
            <form action="signupfm.php" method="post">
                <div class="mb-3 p-2 col-md-8 elements-center">
                    <label for="uname" class="form-label">User Name</label>
                    <input type="text" maxlength="50" class="form-control" id="uname" name="uname" placeholder="Your Username">
                </div>
                <div class="mb-3 p-2 col-md-8 elements-center">
                    <label for="pwd" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Your Password">
                </div>
                <div class="mb-3 p-2 col-md-8 elements-center">
                    <label for="conpwd" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="conpwd" name="conpwd" placeholder="Re-type Your Password">
                </div>
                <div class="mb-3 p-3 col-md-8 elements-center d-flex justify-content-center">
                    <button class="w-50 btn btn-secondary" type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </body>

</html>