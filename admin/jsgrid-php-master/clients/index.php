<?php
require("../../../db_connect.php");
include "../models/ClientRepository.php";

$clients = new ClientRepository($con);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $clients->getAll(array(
            "sn" => $_GET["sn"],
            "issn" => $_GET["issn"],
            "callno" => $_GET["callno"],
            "title" => $_GET["title"],
            "author" => $_GET["author"],
            "publisher" => $_GET["publisher"],
            "place" => $_GET["place"],
            "year" => $_GET["year"],
            "accessible_from" => $_GET["accessible_from"],
            "accessible_upto" => $_GET["accessible_upto"],
            "url" => $_GET["url"],
            "subject" => $_GET["subject"],
            "notes" => $_GET["notes"],
            "accessionNo" => $_GET["accessionNo"]
        ));
        break;

    case "POST":
        $result = $clients->insert(array(
            "sn" => $_POST["sn"],
            "issn" => $_POST["issn"],
            "callno" => $_POST["callno"],
            "title" => $_POST["title"],
            "author" => $_POST["author"],
            "publisher" => $_POST["publisher"],
            "place" => $_POST["place"],
            "year" => $_POST["year"],
            "accessible_from" => $_POST["accessible_from"],
            "accessible_upto" => $_POST["accessible_upto"],
            "url" => $_POST["url"],
            "subject" => $_POST["subject"],
            "notes" => $_POST["notes"],
            "accessionNo" => $_POST["accessionNo"]
        ));
        break;

    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);

        $result = $clients->update(array(
            "sn" => $_PUT["sn"],
            "issn" => $_PUT["issn"],
            "callno" => $_PUT["callno"],
            "title" => $_PUT["title"],
            "author" => $_PUT["author"],
            "publisher" => $_PUT["publisher"],
            "place" => $_PUT["place"],
            "year" => $_PUT["year"],
            "accessible_from" => $_PUT["accessible_from"],
            "accessible_upto" => $_PUT["accessible_upto"],
            "url" => $_PUT["url"],
            "subject" => $_PUT["subject"],
            "notes" => $_PUT["notes"],
            "accessionNo" => $_PUT["accessionNo"]
        ));
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $clients->remove($_DELETE["sn"]);
        break;
}


header("Content-Type: application/json");
echo json_encode($result);
?>
