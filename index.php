<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Sport Events</title>
  </head>

  <body>
   <!-- ======================= HEADER SECTION ======================= -->
   <header>
     <div class="container header_section">
       <div>
         <h1 class="header_title">Sport Events Calendar</h1>
       </div>
       <nav>
         <ul class="redirects">
           <li>
             <a href="">Home</a>
           </li>
           <li>
             <a href="">About Us</a>
           </li>
           <li>
             <a href="">Contact</a>
           </li>
         </ul>
       </nav>
     </div>
   </header>

    <!-- ======================= FILTER SECTION ======================= -->
    <div class="container">
      <!-- CHOOSE FILTER -->
      <form action="" method="post" class="filter_section">
        <label>Filter By Sport: </label>
          <select name="category">
            <option name="all" value="default">All events</option>
            <option name="football" value="1">Football</option>
            <option name="ice_hockey" value="2">Ice Hockey</option>
          </select>
          <button type="submit" name="filter" class="btn_submit">Filter</button>
          <br/>
      </form>

    <!-- ======================= CONTENT SECTION ======================= -->
     <table width="70%" cellpadding="5" cellspace="5" class="events_section">
       <tr>
         <td class="events_info">Date</td>
         <td class="events_info">Time</td>
         <td class="events_info">Team 1</td>
         <td class="events_info">Team 2</td>
       </tr>
       <?php include_once 'includes/DB.connect.php' ?>
       <?php
        $db = new Dbh();
        // $db->connect();
        $eventArr = $db->getFilteredEvents();
        $db->outputEvents($eventArr);
       ?>
     </table>

     <!-- ======================= INSERT EVENT SECTION ======================= -->
      <h3>Add New Event</h3>
      <form action="includes/insert_event.php" method="post" class="insert_section">
        <label>Sport</label>
        <select name="sport" id="sport">
          <option value="1">Football</option>
          <option value="2">Ice Hockey</option>
        </select>
        <label for="eventdate">Date</label>
        <input type="date" id="eventdate" name="eventdate" />
        <label for="eventtime">Time</label>
        <input type="time" id="eventtime" name="eventtime" />
        <label for="team_1">Team 1</label>
        <textarea name="team_1" id="team_1"></textarea>
        <label for="team_2">Team 2</label>
        <textarea name="team_2" id="team_2"></textarea>
        <button type="submit" class="btn_submit">Submit Event</button>
      </form>
    </div>
  </body>
</html>
