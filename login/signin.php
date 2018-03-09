<?php
session_start();
$admins=array("admin1"=>"qwerty","admin2"=>"123");
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
      $v=notEmpty($_POST,"username","password");
      if(empty($v["error"]))
      {
          if(empty($admins[$_POST['username']])){
          echo '{"error":["Invalid username"]}';
          die();
          }
          if($admins[$_POST['username']]==$_POST['password'])
          {
            $_SESSION['admin'] = $_POST['username'];
            $_SESSION['signed_in']=true;
            echo "login successful";
          }
          else{
            $_SESSION['admin'] = '';
            $_SESSION['signed_in']=false;
            echo '{"error":["Invalid password"]}';
          }

      }
      else
          echo json_encode($v);
?>