<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        die('Invalid Request');
    }
    if(!isset($_SESSION['uname']) || !$_SESSION['isadmin']){
        header("location: /Sumit028");
        exit();
    }
    else{
        $conn=mysqli_connect("localhost","root","","abst_news_portal");
        if(!$conn){
            die('Could not Connect to Database'. mysqli_connect_error());
        }
        $id=-1;
        if(isset($_SESSION['editNID'])){
            $id=$_SESSION['editNID'];
        }
        $nhead=$_POST['nhead'];
        $nbod=$_POST['nbod'];
        $sql="select * from news where NID='$id'";
        $res=mysqli_query($conn,$sql);
        $tmb=null;
        $img_paths=null;
        $rowcount=mysqli_num_rows($res);
        if($rowcount==1){
            $row=mysqli_fetch_assoc($res);
            $tmb=$row['Thumbnail'];
            $img_paths=$row['Img_paths'];
        }
        if($_FILES['tmb']['name']!=""){
            $tmb="static/".$_FILES['tmb']['name'];
            if(preg_match("!image!",$_FILES['tmb']['type'])){
                if(!copy($_FILES['tmb']['tmp_name'],$tmb)){
                    die('Error Copying file');
                }
            }
            else{
                header("location: addnews.php?imgerr=1");
                exit();
            }
        }
        if($_FILES['phs']['name'][0]!=""){
            $countphs=count($_FILES['phs']['name']);
            $img_paths="";
            for($i=0;$i<$countphs;$i++){
                if($i!=0){
                    $img_paths=$img_paths.",";
                }
                $single_path="static/".$_FILES['phs']['name'][$i];
                $img_paths=$img_paths.$single_path;
                if(preg_match("!image!",$_FILES['phs']['type'][$i])){
                    if(!copy($_FILES['phs']['tmp_name'][$i],$single_path)){
                        die('Error Copying file');
                    }
                }
                else{
                    header("location: addnews.php?imgPherr=1");
                    exit();
                }
            }
        }
        $ntime=date("Y-m-d H:i:s");
        if($rowcount==1){
            $sql="update news set Headline='$nhead', Body='$nbod', Thumbnail='$tmb',Img_paths='$img_paths',Time='$ntime' where NID='$id'";
        }
        else{
            $sql="insert into news(Headline,Body,Thumbnail,Img_paths,Time) 
                    values ('$nhead','$nbod','$tmb','$img_paths','$ntime')";
        }
        if(mysqli_query($conn,$sql)){
            mysqli_close($conn);
            header("location: /Sumit028");
            exit();
        }
        else{
            mysqli_close($conn); 
            die("SQL Query error");
        }
    }
?>