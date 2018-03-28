<?php
 function notEmpty(){
  $response=array();
  $response['error']=array();
  $n=func_num_args();
  $a_bind_params=func_get_args();
  if(!is_array($a_bind_params[0]))
      return "no";
  for($i=1;$i<$n;$i++){
     if(empty($a_bind_params[0][$a_bind_params[$i]]))
         array_push($response['error'],$a_bind_params[$i]." not found");
     elseif($a_bind_params[0][$a_bind_params[$i]]=="")
          array_push($response['error'],$a_bind_params[$i]." cannot be empty");
  }
  return $response;
}
    require "db_connect.php";
      $v=notEmpty($_GET,"type","query");
      //if(empty($v["error"]))
      //{
        $_GET['query']='%'.$_GET['query'].'%';
        $query="SELECT * FROM books WHERE ".$_GET['type']." LIKE ?";
		if(!empty($_GET['publication'])){
			$publishers_array=json_decode(json_encode($_GET['publication']),true);
			$publishers="'".implode("','",$publishers_array)."'";
			$q=' AND Publisher in ('.$publishers.')';
			$query=$query.$q;
			}
		$query=$query.' ORDER BY '.$_GET["type"];
        $stmt=$con->prepare($query) or die(mysqli_error($con));
        $stmt->bind_param("s",$_GET['query']) or die("Failed to connect to server: " . mysqli_error($con));
          $stmt->execute() or die("Failed to connect to MySQL: " . mysqli_error($con));
          $result=$stmt->get_result() or die("Failed to connect to MySQL: " . mysqli_error($con));
          $total_count = mysqli_num_rows($result);
          $search_result=array("count"=>$total_count);
          if(empty($_GET['page']))
          $count=0;
          else
          $count=$_GET['page'];
          for($i=1;$i<$count;$i++){
            for($j=0;$j<25;$j++)
            $row = $result->fetch_array(MYSQLI_ASSOC);
          }
          $i=0;
          $book = array();
            while(($row = $result->fetch_array(MYSQLI_ASSOC)) && $i<25){
                //print_r($row);
                    array_push($book,$row);
                    $i=$i+1;
            }
            array_push($search_result, $book);
            echo json_encode($search_result);
    //}
      // else
      //     echo json_encode($v);
          ?>