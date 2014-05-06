<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>



<?php

$search = $_POST['search_term'];

echo "Search Term: " . $search . "<br><br>";

$link = mysqli_connect("localhost", "root", "123", "my_db");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
} else {
  echo "Connection successful<br>";
}

$sql = "SELECT * FROM movies WHERE title LIKE '%$search%'";
$result = mysqli_query($link, $sql);

echo "<table border = '1'>
<tr>
<th>movieid</th>
<th>title</th>
<th>director</th>
<th>genres</th>
<th>actors</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  $movieid = $row['movieid'];
  echo "<td>" . $movieid . "</td>";
  echo "<td>" . $row['title'] . "</td>";
  echo "<td>" . $row['director'] . "</td>";
  $sqlgenre = "SELECT genre FROM moviegenres JOIN movies ON moviegenres.movieid = movies.movieid JOIN genres ON moviegenres.genreid = genres.genreid AND moviegenres.movieid = '$movieid' GROUP BY genre";
  $resultgenre = mysqli_query($link, $sqlgenre);
  echo "<td>";
  $rowzero = mysqli_fetch_array($resultgenre);
  echo $rowzero['genre'];
  while ($rowgenre = mysqli_fetch_array($resultgenre)) {
    echo", " . $rowgenre['genre'];
  }
  echo "</td>";

  $sqlactor = "SELECT actor FROM movieactors JOIN movies ON movieactors.movieid = movies.movieid JOIN actors ON movieactors.actorid = actors.actorid AND movieactors.movieid = '$movieid' GROUP BY actor";
  $resultactor = mysqli_query($link, $sqlactor);
  echo "<td>";
  $rowzero = mysqli_fetch_array($resultactor);
  echo $rowzero['actor'];
  while ($rowactor = mysqli_fetch_array($resultactor)) {
    echo"; " . $rowactor['actor'];
  }
  echo "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br>";


?>


</body>
</html>