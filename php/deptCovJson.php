

<?php
	//connect to databases
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "company";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	

    if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
    }else{
        echo "Connection Successful";
        
    }
    

     

//sql query that i will be using to get
// the data need it for the json cocument
    
   $query = "SELECT D.Dname, E.Lname, L.Dlocation
FROM Department D, Employee E, Deptlocation L
WHERE E.Ssn=D.Mgrssn AND L.Dnumber=D.Dnumber AND D.Dnumber=E.Dno
ORDER BY D.Dname;";

    

    
    $result = mysqli_query($connection, $query);
     if (!result) {
            die("Query failed: " . mysqli_connect_error());
    }else{
        echo "Query Successful";
        
    }

//putting the sql resuls into json array
      $jsonData = array();
	  
      while($row=mysqli_fetch_assoc($result))
      {
        $jsonData[] = $row;
      }
      
      echo json_encode($jsonData);



?>



<!DOCTYPE html >

<html lang="en">
	<head>
		<title>untitled</title>
	</head>
	<body>
	
	</body>
</html>

<?php
	//close db connection
	mysqli_close($connection);
?>