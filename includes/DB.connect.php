<?php

class Dbh {

  // not secure
  private $host = 'localhost';
  private $user = 'root';
  private $pwd = '';
  private $dbName = 'sport_events';
  private $conn = null;

  // ctor
  public function __construct() {

        $this->connect();
  }

  // OOP uses new mysqli (mysqli->query())
  // Procedural uses mysqli_connect (mysqli_query())
  public function connect() {

      $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbName);
      //handle connection error
      if($this->conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $this->conn->connect_errno;
        exit();
      }
  }

  public function getAllEvents() {

    $sql = "SELECT * FROM events";
    // here perform a single SQL query
    $query = $this->conn->real_query($sql);
    // use store_results() instead of fetch_all(MYSQLI_ASSOC)
    $eventArr = $this->conn->store_result();
    $this->conn->close();
    return $eventArr;
  }

  public function getFilteredEvents(){

    $sql = "SELECT * FROM events";

    // if the filter button is pushed
    if(isset($_POST['filter'])){
      $sql = "";
      // get the chosen value
      $search_value = $_POST['category'];
      // check if the chosen category is default
      if($search_value == 'default'){
          $sql = "";
          $sql = "SELECT * FROM events";
      }
      // get only events with chosen sport
      else{
        $sql .= "SELECT * FROM events
        WHERE events._sport_id='{$search_value}'";
      }
    }

    $query = $this->conn->real_query($sql);    
    $eventArr = $this->conn->store_result();
    $this->conn->close();
    return $eventArr;

  }

  public function outputEvents($eventArr) {

    print("<h2>Upcoming Events</h2>");

    foreach ($eventArr as $e) {
      echo "<tr><td>" .date('D', strtotime($e['date'])).
        "</td><td>" .$e['date'].
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

    // store new data
    if($query = $this->conn->real_query($sql)){
      print ("Stored");
    } else {
      print("Failed");
    }
  }

  public function deleteEvent() {

    $id = $_REQUEST['id'];

    $sql = "DELETE FROM events WHERE id = '" . $id . "'";

    // store new data
    if($query = $this->conn->real_query($sql)){
      print ("Stored");
    } else {
      print("Failed");
    }
  }
}

?>
