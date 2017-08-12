

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
     $query = "SELECT P.Pnumber, P.Pname, D.Dname,
E.Lname, E.Fname, W.Hours
From Project P, Department D, Employee E, WorksOn W
WHERE D.Dnumber=E.Dno AND E.Ssn=W.Essn AND P.Pnumber=W.Pnum
ORDER BY P.Pnumber";

    


    

    

    
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
      //printing the results 
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