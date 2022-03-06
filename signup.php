<?php 
    require_once "login.php";
    $con = new mysqli($hn,$un,$pass,'users',$port);

    if($con->errno){
        echo $con->error;
        die();
    }
    if(isset($_POST['first_name'])
    && isset($_POST['last_name'])
    && isset($_POST['email'])
    && isset($_POST['username'])
    && isset($_POST['pass'])){
        signup_success($con);
        echo "Signup Succesful";
        header('location: programs/sql-form/login-page.php');
    }else{
        form();
    }
    function signup_success($con){
        $first = get_post($con,'first_name');
        $last = get_post($con,'last_name');
        $email = get_post($con,'email');
        $username = get_post($con,'username');
        $pass = password_hash(get_post($con,'pass'),PASSWORD_DEFAULT);
        $sql = "INSERT INTO auth_info VALUES
        ('$username','$first','$last','$email','$pass')";
        $result = $con->query($sql);
    }
    function form(){
        echo <<<_END
            <form method="post" action="signup.php">
            <div>
                First Name<input type="text" name="first_name" required>
            </div>
            <div>
                last Name<input type="text" name="last_name" required>
            </div>
            <div>
                email<input type="text" name="email" required>
            </div>
            <div>
                username<input type="text" name="username" required>
            </div>
            <div>
                password<input type="password" name="pass" required>
            </div>
            <div>
                <input type="submit">
            </div>   
        </form>  
        _END;

    }
    function get_post($con,$var){
        return $con->real_escape_string($_POST[$var]);
    }
    $con->close();
?>