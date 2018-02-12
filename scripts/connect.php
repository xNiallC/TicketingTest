<?php
function Connect() {
  // These are the details for your university database. Need to be changed for the real ticketing system
  $username="group1";
  $password="yMj22SdAqpqSJS2";

  $connection = oci_connect($username, $password, 'csora12edu');

  return $connection;
}
?>
