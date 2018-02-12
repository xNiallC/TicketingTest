<?php

require 'connection.php';

$connection = Connect();
$name = $connection->real_escape_string($_POST['ticketName']);
$content = $connection->real_escape_string($_POST['ticketContent']);

$query = "INSERT into Tickets (Name,Content,Date) VALUES('$name','$content',sysdate)";
$success = oci_parse($connection, $query);

if(!$success) {
  die($connection->error);
}

echo "Ticket Submitted";

$connection->close();

?>
