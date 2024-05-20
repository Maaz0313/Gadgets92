<?php
require '../../dbcon.php';
$sel = $_POST['selection'];
// validate it
// connect to the database
// run a query to retrieve the other information 
$query = "select * from brands where cat_id = ?";
$result = mysqli_execute_query($con, $query, [$sel]);
$output="";
// echo the information out to the screen
while ($row = $result->fetch_assoc()) { 
$output .="<option value='" . $row['brand_id'] . "'>" . $row['brand_name'] . "</option>";
}
echo $output;
