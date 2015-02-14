<?php
echo "ajax-example.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "mnd3db1";
	//Connect to MySQL Server
mysql_connect($dbhost, $dbuser, $dbpass);
	//Select Database
mysql_select_db($dbname) or die(mysql_error());
	// Retrieve data from Query String
$username = $_GET['username'];
	// Escape User Input to help prevent SQL Injection
$username = mysql_real_escape_string($username);
	//build query
$query = "SELECT user.username, tipuser.dentipu, user.name, user.email, user.phone, grupv.dengrupv
				FROM user,tipuser,grupv
				WHERE user.codtipu=tipuser.codtipu and user.codgrupv=grupv.codgrupv
				ORDER BY '$username' DESC";
	//Execute query
$qry_result = mysql_query($query) or die(mysql_error());

	//Build Result String
$display_string = "<table border='1'>";
$display_string .= "<tr>";
$display_string .= "<th>username</th>";
$display_string .= "<th>tip user</th>";
$display_string .= "<th>name</th>";
$display_string .= "<th>email</th>";
$display_string .= "<th>phone</th>";
$display_string .= "<th>grupa varsta</th>";
$display_string .= "</tr>";

// Insert a new row in the table for each person returned
while($row = mysql_fetch_array($qry_result)){
	$display_string .= "<tr>";
	$display_string .= "<td>$row[username]</td>";
	$display_string .= "<td>$row[dentipu]</td>";
	$display_string .= "<td>$row[name]</td>";
	$display_string .= "<td>$row[email]</td>";
	$display_string .= "<td>$row[phone]</td>";
	$display_string .= "<td>$row[dengrupv]</td>";
	$display_string .= "</tr>";
	
}
echo "Query: " . $query . "<br />";
$display_string .= "</table>";
echo $display_string;
?>
