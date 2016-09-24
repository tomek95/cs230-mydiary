<!DOCTYPE html>

<!-- THIS IS HTML -->
<html>
<head>
	<title>Assignemnt 3</title>
  
<!-- VALIDATION FUNCTION --> 
  <script>
function validateForm() {
  for(var num = 1; num <= 5; num++){
    var id = "txtar0" + num;
    if(document.getElementById(id).value == ""){
      alert("Fill out all the fields!");
      return false;
    }
  }
  window.confirm("Form submitted sucessfully!");
  return true;
  
}
  </script>
  <!-- END OF VALIDATION SCRIPT -->

  <!-- STYLE -->
  <style type="text/css">


  div#div01 {
  background: rgb(102, 0, 102);
  font-family: "Arial", Sans-serif;
  color: white;
}

table, th, td {
  border: 2px solid white;
}

table {
  width: 100%;

}

caption#capt01 {
  color: white;
  font-size: 30px;
  padding: 5px;
  font-weight: bold;
}

tr#tableNames {
  background: rgb(153, 51, 153);
  text-align: center;
  width: 100%;
  outline: none;
}

tr#tableData td {
  background: rgb(204, 0, 204);
  height: 300px;
  outline: none;
}

textarea, textarea:hover, textarea:active{
resize: none;
  outline: none;
  height: 100%;
  width: 97%;
  margin: none;
  padding: 2px;
  background: none;
  color: white;
  font-size: 17px;
  font-weight: bold;
}

div#buttonDiv {
  text-align: center;
  padding: 5px;
}

div#buttonDiv input {
  background-color: rgb(204, 204, 255);
  font-size: 20px;
  border-radius: 5px;
  border: none;
  width: 20%;
}

div#buttonDiv input:hover {
  background-color: rgb(102, 102, 255);
  cursor: pointer;
}


/**** THIS IS STYLING FOR THE RESULT TABLE ****/
div#divRes caption {
  background-color: black;
  color: white;
  padding: 5px;
  font-size: 30px;
}

table#tableRes {
  width: 100%;
  background-color: #f2f2f2;
  color: #000000;
  font-weight: bold;
table-layout: fixed;
}



table#tableRes th {
  background-color:#000000;
  color: white;
  padding: 2px;
}

table#tableRes td{
  color: white;
word-wrap: break-word;
}
table#tableRes tr:nth-child(even) {
  background-color: #a6a6a6;
}

table#tableRes tr:nth-child(odd){
  background-color: #8c8c8c;
}
</style>
  <!-- END OF STYLE -->
</head>

<body>
<div id="div01">
	<form id="form01" name = "diaryForm" method="post">
		<table><caption id="capt01">Blank Diary</caption>
			<tr id="tableNames">
				<th>When/Where</th>
				<th>Event</th>
				<th>Emotion</th>
				<th>Automatic Thoughts</th>
				<th>Rational Response</th>
			</tr>
			<tr id="tableData">
				<td><textarea id="txtar01" form="form01" name="when_where"></textarea></td>
        <td><textarea id="txtar02" form="form01" name="event"></textarea></td>
        <td><textarea id="txtar03" form="form01" name="emotion"></textarea></td>
        <td><textarea id="txtar04" form="form01" name="auto_thoughts"></textarea></td>
        <td><textarea id="txtar05" form="form01" name="rational_response"></textarea></td>
			</tr>
		</table>
      <div id="buttonDiv">
        <input type="submit" value="Save entry" onClick = "return validateForm();">
        <input type="submit" value="Show Entry" name="showentry">
      </div>
	</form>

</div>



</body>
</html>

<!-- END OF HTML -->



<!-- THIS IS PHP -->
<?php

$servername = "localhost";
$username = "tomek";
$password = "password";
$dbname = "assignment3";
$tablename = "healthdiary";

$when_whereErr = $eventErr = $emotionErr = $auto_thoughtsErr = $rational_responseErr = "";

$when_where = $event = $emotion = $auto_thoughts = $rational_response = "";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST['showentry'])) {
$sqlTwo = "SELECT * FROM $tablename";
$result = mysqli_query($conn, $sqlTwo);

if (mysqli_num_rows($result) > 0) {
       echo "<div id='divRes'><table id='tableRes'><caption>Your current entries:</caption><tr><th>When/Where</th><th>Event</th><th>Emotion</th><th>Automatic thoughts</th><th>Rational response</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["when_where"]."</td><td>".$row["event"]."</td><td> ".$row["emotion"]."</td><td>". $row['auto_thoughts']. "</td><td>" .$row['rational_response'] . "</td></tr>";
    }
    echo "</table></div>";
} else {
    echo "<div id='noResult'>0 results</div>";
}

}
else{

  if (empty($_POST['when_where'])) {
    $when_whereErr = "When/where required";
  } else {
    $when_where = saveInput($_POST["when_where"]);
  } 

  if (empty($_POST["event"])) {
    $eventErr = "Event required";
  } else {
    $event = saveInput($_POST["event"]);
  }

  if (empty($_POST["emotion"])) {
    $emotionErr = "Emotion required";
  } else {
    $emotion= saveInput($_POST["emotion"]);
  }

  if (empty($_POST["auto_thoughts"])) {
    $auto_thoughtsErr = "Auto thoughts required";
  } else {
    $auto_thoughts = saveInput($_POST["auto_thoughts"]);
  }

  if (empty($_POST["rational_response"])) {
    $rational_responseErr = "Rational response required";
  } else {
    $rational_response = saveInput($_POST["rational_response"]);
  }

$sql = "INSERT INTO $tablename (when_where, event, emotion, auto_thoughts, rational_response)
VALUES ('$when_where', '$event', '$emotion', '$auto_thoughts', '$rational_response')";


$conn->query($sql);

}
}



function saveInput($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


mysql_connect('')
?> 

<!-- END OF PHP -->
