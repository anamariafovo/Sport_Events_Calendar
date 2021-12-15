<?php

class Dbh {

  private $host = 'localhost';
  private $user = 'root';
  private $pwd = '';
  private $dbName = 'sport_events';
  private $conn = null;

  public function __construct() {
        $this->connect();
  }

  public function connect() {
      $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbName);
  }

  public function getAllEvents() {

    $sql = "SELECT * FROM events";
    $query = mysqli_query($this->conn, $sql);
    $eventArr = $query->fetch_all(MYSQLI_ASSOC);
    return $eventArr;
  }

  public function getFilteredEvents(){

    $sql = "SELECT * FROM events";

    if(isset($_POST['filter'])){
      $sql = "";
      $search_value = $_POST['category'];
      $sql .= "SELECT * FROM events
      WHERE events._sport_id='{$search_value}'";
    }
    if($_POST['category'] == 'default'){
        $sql = "";
        $sql = "SELECT * FROM events";
    }

    $query = mysqli_query($this->conn, $sql);
    $eventArr = $query->fetch_all(MYSQLI_ASSOC);
    return $eventArr;

  }

  public function outputEvents($eventArr) {

    print("<h2>Upcomming Events</h2>");

    foreach ($eventArr as $e) {
      echo "<tr><td>" .$e['date'].
        "</td><td>" .$e['time'].
        "</td><td>" .$e['team_1'].
        "</td><td>" .$e['team_2'].
        "</td><td>" ."<a href='includes/delete_event.php?id=" . $e['id'] . "'><button class='btn_delete'>Remove</button></a>".
        "</td></tr>";
    }
  }

  public function addEvent() {

    $sport = $_REQUEST['sport'];
    $date = $_REQUEST['eventdate'];
    $time = $_REQUEST['eventtime'];
    $team_1 = $_REQUEST['team_1'];
    $team_2 = $_REQUEST['team_2'];

    $sql = "INSERT INTO events (_sport_id, date, time, team_1, team_2) VALUES ";
    $sql .= "('" . $sport . "',";
    $sql .=  "'" . $date . "',";
    $sql .=  "'" . $time . "',";
    $sql .= "'" . $team_1 . "',";
    $sql .= "'" . $team_2 . "')";

    //print $sql;
    if(mysqli_query($this->conn, $sql)){
      print ("Stored");
    } else {
      print("Failed");
    }
  }

  public function deleteEvent() {

    $id = $_REQUEST['id'];

    $sql = "DELETE FROM events WHERE id = '" . $id . "'";

    //print $sql;
    if(mysqli_query($this->conn, $sql)){
      print ("Stored");
    } else {
      print("Failed");
    }
  }
}

?>
