<?php
require("../db_connect.php");
include "./jsgrid-php-master/models/ClientRepository.php";

$clients = new ClientRepository($con);

$key=array("sn","issn","callno","title","author","publisher","place","year","accessible_from","accessible_upto","url","subject","notes","accessionNo");
$file = fopen("database.csv","r");
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

fclose($file);
unlink("database.csv");

?>