<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'connect.php';
$connection = Connect();

$ticketID = $_POST['TicketID'];
$new_status = $_POST['newStatus'];

if (isset($new_status) && !empty($new_status)) && (isset($ticketID) && !empty($ticketID)){
    $query = "UPDATE Tickets SET name='$new_status' WHERE TicketID='$ticketID'";
    $stid = oci_parse($connection, $query);
}
?>