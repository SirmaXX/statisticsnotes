<?php 
include ('db.php');
      
$query="SELECT count(duty),day FROM listduty";
$stmt=$conn->prepare($query);
$stmt->execute();



$userData =array();


while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{

  $userData['job'][][]=$row;
  

  }

$formattedData = json_encode($userData);

//set the filename
$filename = 'members.json';

//open or create the file
$handle = fopen($filename,'w+');

//write the data into the file
fwrite($handle,$formattedData);

//close the file
fclose($handle);
?> 