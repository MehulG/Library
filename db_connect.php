<?php 
    session_start();
	$_SESSION["host"] = "localhost";
	$_SESSION["db_user"] = "root";
	$_SESSION["db_password"] = "";
    $_SESSION["db_name"]="library";
    $con=mysqli_connect($_SESSION["host"],$_SESSION["db_user"],$_SESSION["db_password"]) or die("Failed to connect to MySQL: " . mysqli_error($con));
    mysqli_select_db($con,$_SESSION["db_name"]) or die("Failed to connect to MySQL: " . mysqli_error());
    function signed_in()
    {
        global $con;
		
        if(array_key_exists("signed_in",$_SESSION) and (bool)$_SESSION['signed_in'])
        {
            $stmt=$con->prepare("SELECT * from users where uid=?");
            $stmt->bind_param("s",$_SESSION['userid']);
            $stmt->execute();
            $result = $stmt->get_result();
            $count = mysqli_num_rows($result);
            if($count==1){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $_SESSION['name'] = $row['name']; 
            $_SESSION['email'] = $row['email']; 
			$_SESSION['contact'] = $row['contact'];
			$_SESSION['username'] = $row['username'];
            return true;
            }
            return false;
        }
        else
            return false;
    }

?>