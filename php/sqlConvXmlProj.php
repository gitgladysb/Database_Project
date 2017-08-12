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
     $query = "SELECT P.Pnumber, P.Pname, D.Dname,
E.Lname, E.Fname, W.Hours
From Project P, Department D, Employee E, WorksOn W
WHERE D.Dnumber=E.Dno AND E.Ssn=W.Essn AND P.Pnumber=W.Pnum
ORDER BY P.Pnumber";


    
   
//creating the xml document

    $xml=new DOMDocument("1.0");
    $xml->formatOutput=true;

    $projects=$xml->createElement("projects");
    $xml->appendChild($projects);




    
    $result = mysqli_query($connection, $query);
     if (!result) {
            die("Query failed: " . mysqli_connect_error());
    }else{
        echo "Query Successful";
        
    }


      //getting data into xml tags (parent and children)
	  
      while($row=mysqli_fetch_array($result))
      {
        
          $project=$xml->createElement("project");
          $projects->appendChild($project);
          
          $Pnumber=$xml->createElement("Pnumber",$row['Pnumber']);
          $project->appendChild($Pnumber);
          
          $Pname=$xml->createElement("Pname",$row['Pname']);
          $project->appendChild($Pname);
          
          $Dname=$xml->createElement("Dname",$row['Dname']);
          $project->appendChild($Dname);
          
          $Lname=$xml->createElement("Lname",$row['Lname']);
          $project->appendChild($Lname);
          
          $Fname=$xml->createElement("Fname",$row['Fname']);
          $project->appendChild($Fname);
          
          $Hours=$xml->createElement("Hours",$row['Hours']);
          $project->appendChild($Hours);
          
      }
      

        echo "<xmp>".$xml->saveXML()."</xmp>";
        $xml->save("reports1.xml");



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