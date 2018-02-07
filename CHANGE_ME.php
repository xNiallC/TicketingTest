<?php
function Connect() {
  // These are the details for your university database. Need to be changed for the real ticketing system
  $host="csmysql.cs.cf.ac.uk";
  $username="YourStudentNumberHere";
  $password="Passowrd";
  $database="YourStudentNumberHere";

  $connection = new mysqli($host, $username, $password, $database) or die($connection->connect_error);

  return $connection;
}
?>
