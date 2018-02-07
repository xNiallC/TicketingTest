<?php

require 'connection.php';

$connection = Connect();
$name = $connection->real_escape_string($_POST['ticketName']);
$content = $connection->real_escape_string($_POST['ticketContent']);
$date = $connection->real_escape_string($_POST['ticketDate']);

$query = "INSERT into Tickets (Name,Content,Date) VALUES('" . $name . "','" . $content . "','" . $date . "')";
$success = $connection->query($query);

if(!$success) {
  die($connection->error);
}

echo "Ticket Submitted";

$connection->close();

?>
