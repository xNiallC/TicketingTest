<?php
 require 'connection.php';
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Ticket Test</title>
  </head>
<body>
  <?php
    $connection = Connect();
    $sql = "SELECT TicketID, Name, Content, Date";
    $result = $connection->query($sql);
  ?>
  <form action="ticketSubmitted.php" method="post">
    Name:
    <input type="text" name="ticketName" required /><br />
    Content:
    <input type="text" name="ticketContent" required /><br />
    Date:
    <input type="date" name="ticketDate" required /><br />
  </form>
  <br />
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
</body>
</html>
