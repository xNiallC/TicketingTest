<?php
 require 'connect.php';

 if(isset($_POST['ticketInput'])) {
   $connection = Connect();
   $name = $connection->real_escape_string($_POST['ticketName']);
   $title = $connection->real_escape_string($_POST['ticketTitle']);
   $content = $connection->real_escape_string($_POST['ticketContent']);
   $date = $connection->real_escape_string($_POST['ticketDate']);

   $query = "INSERT into Tickets (Name,Title,Content,Date) VALUES('" . $name . "','" . $title . "','" . $content . "','" . $date . "')";
   $success = $connection->query($query);

   if(!$success) {
     die($connection->error);
     $connection->close();
     header("location: {$_SERVER['PHP_SELF']}");
     echo "Ticket Not Submitted";
   }
   else {
     $connection->close();
     header("location: {$_SERVER['PHP_SELF']}");
     echo "Ticket Submitted!";
   }


 }
 elseif (isset($_POST['ticketDelete'])) {
   $connection = Connect();
   $ticketID = $connection->real_escape_string($_POST['ticketIDToDelete']);

   $query = "DELETE FROM Tickets WHERE TicketID = '$ticketID'";
   $success = $connection->query($query);

   if(!$success) {
     die($connection->error);
     $connection->close();
     header("location: {$_SERVER['PHP_SELF']}");
   }
   else {
     $connection->close();
     header("location: {$_SERVER['PHP_SELF']}");
   }
 }
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Ticket Test</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
<body>
  <?php
    $connection = Connect();
    $sql = "SELECT TicketID, Name, Title, Content, Date from Tickets";
    $result = $connection->query($sql);
  ?>
  <form action="" method="post" id="ticketInput">
    Name:
    <input type="text" name="ticketName" required /><br />
    Title:
    <input type="text" name="ticketTitle" required /><br />
    Content:
    <input type="text" name="ticketContent" required /><br />

    <!-- Hidden date input. Automatically inputs today's date using some JS stuff -->
    <input type="hidden" name="ticketDate" id="todayDate"/><br />
    <script>
      // JS has a date function, we use to submit the date
      function getDate() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
        today = yyyy+""+mm+""+dd;
        document.getElementById("todayDate").value = today;
      }
      //call getDate() when loading the page
      getDate();
    </script>
  </form>

  <button type="submit" form="ticketInput" value="Submit Ticket" name="ticketInput">Submit Ticket</button>

  <br /><br />
  <?php
  if ($result->num_rows > 0) {
    echo "<table id='allTickets'><tr><th>ID</th><th>Name</th><th>Title</th><th>Date</th><th>Expand Content</th></tr>";

    while($row = $result->fetch_assoc()) {
      ?>
      <tr>
        <td id="regularTableElement">
          <?php echo $row["TicketID"]; ?>
        </td>
        <td id="regularTableElement">
          <?php echo $row["Name"]; ?>
        </td>
        <td id="regularTableElement">
          <?php echo $row["Title"]; ?>
        </td>
        <td id="regularTableElement">
          <?php echo $row["Date"]; ?>
        </td>
        <td id="regularTableElement">
          <!-- Create button with an ID that is specific to the row in the database, and call our expand content function with this -->
          <button onclick="expandContent('ticket<?php echo $row["TicketID"]; ?>Content')">Expand Content</button>
        </td>
        <tr><td colspan="5">
          <div id="ticket<?php echo $row["TicketID"]; ?>Content"><?php echo $row["Content"]; ?></div>
        </td></tr>
      </tr>
      <?php
    }

    echo "</table>";
  }
  $connection->close();
  ?>
  <br />
  <form action="" method="post" id="ticketDelete">
    TicketID to Delete:
    <input type="number" name="ticketIDToDelete" required /><br />
  </form>
  <button type="submit" form="ticketDelete" value="Delete Ticket" name="ticketDelete">Delete Ticket</button>
</body>
<script>
  // Simple function to expand a specific ticket
  function expandContent(elementID) {
    var x = document.getElementById(elementID);
    if(x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>
</html>
