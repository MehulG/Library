   <?php
   require "db_connect.php";
        $query="SELECT DISTINCT Publisher FROM books";
        $stmt=$con->prepare($query) or die(mysqli_error($con));
          $stmt->execute() or die("Failed to connect to MySQL: " . mysqli_error($con));
          $result=$stmt->get_result() or die("Failed to connect to MySQL: " . mysqli_error($con));
          $book = array();
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    array_push($book,$row["Publisher"]);
            }
            echo json_encode($book);
			
			?>
