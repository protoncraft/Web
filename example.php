<!DOCTYPE html>
<html>
<body>

<?php

echo "Hello World!<br>";
// phpinfo();

$link = mysqli_connect("localhost","root","123","my_db");

if (!$link) {

   echo "Could not connect to server<br>";
}  else {
   echo "Connection established<br>";
}

echo mysqli_get_server_info() . "<br>";


/*
$sql = mysqli_query($link,"INSERT INTO Persons (FirstName, LastName, Age)
VALUES ('Peter', 'Griffin',35)");
echo "<pre>Debug: $sql</pre>";
$result = mysqli_query($link, $sql);
if (false==$result) {
   printf("error: %s\n", mysqli_error($link));
}  else {
   echo "done";
}
*/


$result = mysqli_query($link, "SELECT * FROM Persons");

while($row = mysqli_fetch_array($result)) {
   echo $row['FirstName'] . " " . $row['LastName'] . " " . $row['Age'];
   echo "<br>";
}


mysqli_close();

?>

</body>
</html>