<?php

include "Client.php";

class ClientRepository {

    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new Client();
        $result->sn = $row["SN"];
        $result->issn = $row["ISSN"];
        $result->callno = $row["CallNo"];
        $result->title = $row["Title"];
        $result->author = $row["Author"];
        $result->publisher = $row["Publisher"];
        $result->year = $row["Year"];
        $result->accessible_from = $row["Accessible_from"];
        $result->accessible_upto = $row["Accessible_upto"];
        $result->url = $row["URL"];
        $result->subject = $row["Subject"];
        $result->notes = $row["Notes"];
        $result->accessionNo = $row["AccessionNo"];
        return $result;
    }

    public function getById($sn) {
        $sql = "SELECT * FROM books WHERE SN = ?";
        $q = $this->db->prepare($sql);
        $q->bind_param("s", $sn);
        $q->execute();
        $result=$q->get_result() or die("Failed to connect to MySQL: " . mysqli_error($con));
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $this->read($row);
    }

    public function getAll($filter) {
        $sn = "%" . $filter["sn"] . "%";
        $issn = "%" . $filter["issn"] . "%";
        $callno = "%" . $filter["callno"] . "%";
        $title = "%" . $filter["title"] . "%";
        $author = "%" . $filter["author"] . "%";
        $publisher = "%" . $filter["publisher"] . "%";
        $place = "%" . $filter["place"] . "%";
        $year = "%" . $filter["year"] . "%";
        $accessible_from = "%" . $filter["accessible_from"] . "%";
        $accessible_upto = "%" . $filter["accessible_upto"] . "%";
        $url = "%" . $filter["url"] . "%";
        $subject = "%" . $filter["subject"] . "%";
        $notes = "%" . $filter["notes"] . "%";
        $accessionNo = "%" . $filter["accessionNo"] . "%";
        $sql = "SELECT * FROM books WHERE sn LIKE ? AND title LIKE ?";
        $q = $this->db->prepare($sql);
        $q->bind_param("ss", $sn,$title);
        $q->execute();
        $result=$q->get_result();
        $rows=array();
        while($row=$result->fetch_array(MYSQLI_ASSOC))
            array_push($rows,$row);

        $result1 = array();
        foreach($rows as $row) {
            array_push($result1, $this->read($row));
        }
        return $result1;
    }


    public function update($data) {
        $sql = "UPDATE books SET ISSN =?, CallNo =?, Title =?, Author =?, Publisher =?, Place =?, Year =?, Accessible_from =?, Accessible_upto =?, URL =?, Subject =?, Notes =?, AccessionNo =? WHERE sn=?";
        $q = $this->db->prepare($sql);
        $q->bind_param("ssssssssssssss",$data["issn"], $data["callno"], $data["title"], $data["author"], $data["publisher"],$data["place"],$data["year"],$data["accessible_from"],$data["accessible_upto"],$data["url"],$data["subject"],$data["notes"],$data["accessionNo"],$data["sn"]);
        $q->execute();
    }
    public function insert($data) {
        $sql = "INSERT INTO  books ( ISSN ,  CallNo ,  Title ,  Author ,  Publisher ,  Place ,  Year ,  Accessible_from ,  Accessible_upto ,  URL ,  Subject ,  Notes ,  AccessionNo ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $q = $this->db->prepare($sql);
        $q->bind_param("sssssssssssss",$data["issn"], $data["callno"], $data["title"], $data["author"], $data["publisher"],$data["place"],$data["year"],$data["accessible_from"],$data["accessible_upto"],$data["url"],$data["subject"],$data["notes"],$data["accessionNo"]);
        $q->execute();
        return $this->getById($this->db->insert_id);
    }
    public function remove($sn) {
        $sql = "DELETE FROM books WHERE sn = ?";
        $q = $this->db->prepare($sql);
        $q->bind_param("s", $sn);
        $q->execute();
    }

}

?>