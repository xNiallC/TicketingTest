<?php
 require 'connect.php';

 if(isset($_POST['ticketInput'])) {
   $connection = Connect();
   $name = $connection->real_escape_string($_POST['ticketName']);
   $content = $connection->real_escape_string($_POST['ticketContent']);
   $date = $connection->real_escape_string($_POST['ticketDate']);

   $query = "INSERT into Tickets (Name,Content,Date) VALUES('" . $name . "','" . $content . "','" . $date . "')";
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
  </head>
<body>
  <?php
    $connection = Connect();
    $sql = "SELECT TicketID, Name, Content, Date from Tickets";
    $result = $connection->query($sql);
  ?>
  <form action="" method="post" id="ticketInput">
    Name:
    <input type="text" name="ticketName" required /><br />
    Content:
    <input type="text" name="ticketContent" required /><br />
    Date:
    <input type="date" name="ticketDate" required /><br />
  </form>

  <button type="submit" form="ticketInput" value="Submit Ticket" name="ticketInput">Submit Ticket</button>

  <br /><br />
  <?php
  if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Content</th><th>Date</th></tr>";

    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["TicketID"]."</td><td>".$row["Name"]."</td><td>".$row["Content"]."</td><td>".$row["Date"]."</td></tr>";
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
</html>
