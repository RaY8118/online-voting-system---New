<?php
    session_start();
    include("connection.php");

    $mobile = $_POST['mob'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    $check = mysqli_query($connect, "select * from user where mobile='$mobile' and password='$pass' and role='$role' ");

    if(mysqli_num_rows($check)>0){
        $getGroups = mysqli_query($connect, "select name, photo, votes, id from user where role=2 ");
        if(mysqli_num_rows($getGroups)>0){
            $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);
            $_SESSION['groups'] = $groups;
        }
        $data = mysqli_fetch_array($check);
        $_SESSION['id'] = $data['id'];
        $_SESSION['status'] = $data['status'];
        $_SESSION['data'] = $data;
        if($role==1)
        echo '<script>
                window.location = "../routes/candidatelogin.php";
            </script>';
        else if($role==2){
            echo '<script>
            window.location = "../routes/infopage.php";
        </script>';
        }
        else{
            echo '<script>
            window.location = "../admin/result.php";
        </script>';
        }
    }
    else{
        echo '<script>
                alert("Invalid credentials!");
                window.location = "../";
            </script>';
    }
    
?>