<?php
    session_start();
    print_r(session_name());
    if($_SESSION['status'] !== 'true'){
        header('location: /programs/sql-form/login-page.php');
    }
    require_once 'login.php';
    require_once 'display-tables.php';
    require_once 'add-row.php';
    $con = new mysqli($hn,$un,$pass,$db,$port);
    
    if($con->connect_errno){
        echo $con->connect_error;
        die("Connection Error");
    }
    if(isset($_POST['name'])
    && isset($_POST['e_id'])
    && isset($_POST['age'])
    && isset($_POST['email'])){
        $e_id = get_post($con,'e_id');
        $name = get_post($con,'name');
        $age = get_post($con,'age');
        $email = get_post($con,'email');
        $sql = "INSERT INTO employee VALUES". 
        "('$e_id','$name',$age,'$email')";
        try{
            $result = $con->query($sql);
        }catch(Exception $e){
            print_r($e->getMessage());
            die();
        }
        header("location: /programs/sql-form/forms.php");
    }
    if(isset($_POST['delete']) && isset($_POST['e_id'])){
        $e_id = get_post($con,'e_id');
        $sql = "DELETE FROM employee WHERE e_id = '$e_id'";
        try{
            $result = $con->query($sql);
        }catch(Exception $e){
            print_r($e->getMessage());
            die();
        }
    }
    if (isset($_POST['update'])){
        $set = '';
        if (get_post($con,'e_id_up')){
            $a = get_post($con,'e_id_up');
            $set .= "e_id = '$a',";
        }
        if (get_post($con,'name_up')){
            $a = get_post($con,'name_up');
            $set .= "name = '$a',";
        }
        if (get_post($con,'age_up')){
            $a = get_post($con,'age_up');
            $set .= "age = '$a',";
        }
        if (get_post($con,'email_up')){
            $a = get_post($con,'email_up');
            $set .= "email = '$a',";
        }
        $set = substr($set,0,-1);
        $e_id = get_post($con,'e_id_old');
        $sql = "UPDATE employee SET $set WHERE e_id = $e_id";
         try{
            $result = $con->query($sql);
        }catch(Exception $e){
            print_r($e->getMessage());
            die();
        }
    }
    // Checking for errors
    try{
        // Running sql Queries
        $sql = "SELECT * FROM employee";
        $result = $con->query($sql);
    }catch(Exception $e){ 
        // Printing Error message and ending the script
        print_r($e->getMessage());
        die();
    }
    dis_tables($result);
    add_row();
    echo "<button><a href='logout.php'>Click here to logout</button>";
    $result->close();
    $con->close();
    function get_post($con,$var){
        return $con->real_escape_string($_POST[$var]);
    }
?>