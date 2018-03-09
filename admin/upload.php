<?php
$target_dir = "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.\n";
} else {
    echo "Sorry, there was an error uploading your file.\n";
}

require("../db_connect.php");
include "./jsgrid-php-master/models/ClientRepository.php";

$clients = new ClientRepository($con);

$key=array("sn","issn","callno","title","author","publisher","place","year","accessible_from","accessible_upto","url","subject","notes","accessionNo");
$file = fopen($target_file,"r");
while(! feof($file))
  {
  $book=fgetcsv($file);
    $b=array_combine($key,$book);
    $clients->insert(array(
        "issn" => $b["issn"],
        "callno" => $b["callno"],
        "title" => $b["title"],
        "author" => $b["author"],
        "publisher" => $b["publisher"],
        "place" => $b["place"],
        "year" => $b["year"],
        "accessible_from" => $b["accessible_from"],
        "accessible_upto" => $b["accessible_upto"],
        "url" => $b["url"],
        "subject" => $b["subject"],
        "notes" => $b["notes"],
        "accessionNo" => $b["accessionNo"]
    ));
  }
echo "Import successfull";
fclose($file);
unlink($target_file);
?>