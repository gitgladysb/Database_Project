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
    

     
    
//getting the data from mysql data base 
    
   $query = "SELECT D.Dname, E.Lname, L.Dlocation
FROM Department D, Employee E, Deptlocation L
WHERE E.Ssn=D.Mgrssn AND L.Dnumber=D.Dnumber AND D.Dnumber=E.Dno
ORDER BY D.Dname;";

    

    //creating the xml document 


    $xml=new DOMDocument("1.0");
    $xml->formatOutput=true;

    $departments=$xml->createElement("departments");
    $xml->appendChild($departments);




    
    $result = mysqli_query($connection, $query);
     if (!result) {
            die("Query failed: " . mysqli_connect_error());
    }else{
        echo "Query Successful";
        
    }


      //getting data into xml tags (parent and children)
	  
      while($row=mysqli_fetch_array($result))
      {
        
          $department=$xml->createElement("department");
          $departments->appendChild($department);
          
          $Dname=$xml->createElement("Dname",$row['Dname']);
          $department->appendChild($Dname);
          
          $Lname=$xml->createElement("Lname",$row['Lname']);
          $department->appendChild($Lname);
          
          $Dlocation=$xml->createElement("Dlocation",$row['Dlocation']);
          $department->appendChild($Dlocation);
          
          
          
      }
      

        echo "<xmp>".$xml->saveXML()."</xmp>";
        $xml->save("reports.xml");



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