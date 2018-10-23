



<?php

include ('db.php');

if(isset($_POST['jobrecord']))
{

  $duty=clean($_POST['job']);
$date = date('Y-m-d H:i:s');
    $sql=" INSERT INTO listduty(id,duty,status,timess,day) VALUES (NULL,?, ?,CURRENT_TIMESTAMP,?)";
  $stmt= $conn->prepare($sql);
         $stmt->execute(array($duty,false,$date));
         echo '<script>window.location.href="index.php"</script>';


}




if(isset($_GET['correct']))
{
$id= $_GET['correct' ];

$sql = $conn->prepare("UPDATE listduty  SET status=:stat WHERE id = :userid");
$sql->execute(
    array(
        'stat' => true,
        'userid' =>$id
    )
);
 

     echo '<script>window.location.href="index.php"</script>';


}



if(isset($_GET['jsil']))
{



 $sql = "DELETE FROM listduty WHERE id=:userjob_id " ;     

    $stmt = $conn->prepare($sql);
        $stmt->bindValue(':userjob_id', $_GET['jsil']);
 
      if($stmt->execute()){
   
?>
            <script>
            alert("ileti silindi");
            window.location.href=('index.php');
            </script>
            <?php 
}else{
?>
            <script>
            alert("ileti silinemedi");
            window.location.href=('index.php');
            </script>
            <?php 


}
}




if(isset($_POST['updatejob'])){

$id=$_POST['jobid'];
 $job = clean($_POST['ijob']);
  $var = $_POST['status'];


if($var == "succeed"){

$sql = "UPDATE listduty  SET duty=:adm , status=1 WHERE id=:id";
$q = $conn->prepare($sql);
$q->execute(array(':adm'=>$job,':id'=>$id ));
 echo '<script>window.location.href="index.php"</script>';
}else if($var == "waiting"){

$sql = "UPDATE listduty  SET duty=:adm , status=0 WHERE id=:id";
$q = $conn->prepare($sql);
$q->execute(array(':adm'=>$job,':id'=>$id ));
     echo '<script>window.location.href="index.php"</script>';



}

}




?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <title>Todolist</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/all.css" >
<link rel="stylesheet" href="css/morris.css">
 <script type="text/javascript" src="js/loader.js"></script>
</head>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">TODOLİST FOR PRESENTATİON <span class="sr-only">(current)</span></a>
          </li>
   
        </ul>
      </div>
    </nav>
    <br>
    <br>
<div class="container text-center">

<ul class="list-group">
 <?php
 $rpp = 4;
//sayfayı getirip default değeri 0 ayarlar
isset($_GET['page']) ? $page =$_GET['page'] : $page =0;
//toplam sayfa sayısını
if($page >1){

$start =($page * $rpp ) -$rpp;
}else{

$start =0;
}

//toplam kayıt dbden
$resultSet=$conn->query("SELECT * FROM listduty ORDER BY id DESC");


//toplam kayıt
$numRows=$resultSet->rowCount();

$totalPages=$numRows /$rpp;



                    
  foreach($conn->query("SELECT * from listduty  ORDER BY id DESC LIMIT $start,$rpp") as $row) 
    {
      ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <div class="pull-left">
    <?php echo $row["duty"]; ?>

<?php 

if($row["status"]==1){

echo ' <span class="badge badge-success">succeed</span>';
}else{

  echo '  <span class="badge badge-danger">waiting</span>';
}


 ?>

<span class="badge badge-primary"><i class="far fa-clock"></i>    <?php echo $row["timess"]; ?></span>

</div>
   <div class="pull-right hidden-phone">
   <a href="?correct=<?php echo $row['id']; ?>" > <button  class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>

   <a href="#editModal<?php echo $row['id']; ?>"  data-toggle="modal"><button type='button' class='btn btn-primary btn-xs'><i class="fas fa-pencil-alt"></i></button></a>

   
    <a href="?jsil=<?php echo $row['id']; ?>" ><button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></a>
 </div>
  </li>







  <!--  edit --->
<div class="modal fade" id="editModal<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="sawModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yanıtlama penceresi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body"> 

 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role ="form "method="post">
      
            <input type="hidden" name="jobid" value="<?php echo $row['id'] ?>">
        <div class="form-group">
           <label for="job">duty</label>
            <input name ="ijob" class="form-control form-control-lg"  value="<?php echo $row['duty'] ?>"  id="job"type="text">
        </div>

       <div class="form-group">
  <label for="sel1">status:</label>
  <select  id="sel1" class="form-control" name="status" >
    <option value="succeed">succeed</option>
    <option value="waiting" >waiting</option>

  </select>
</div>


        <div class="form-group">
           <button type="submit" class="btn btn-primary" name="updatejob"><span class="glyphicon glyphicon-edit"></span> gönder</button>
        </div>
  </form>

          </div>
         
         </div>
      </div>
    </div>

</ul>


    <?php
    }

    ?>
<ul class="pagination">

       <?php


                  for($x=1;$x <= $totalPages;$x++){


                   echo "<li class='page-item'><a class='page-link' href='?page=$x'>$x</a></li>";
            }  ?>
</ul>
<br>



</div>


<div class="container text-center">
<input id ="fir" type="hidden" value="<?php

$stmt = $conn->prepare("SELECT count(*) FROM listduty WHERE status = 1");
$stmt->execute();
$count = $stmt->fetchColumn();
echo $count;

 ?>">
 



<input id ="sec" type="hidden" value="<?php

$stmt = $conn->prepare("SELECT count(*) FROM listduty WHERE status = 0");
$stmt->execute();
$count = $stmt->fetchColumn();
echo $count;

 ?>">
 



 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" method="post" enctype="multipart/form-data" >
<div class="form-group">

  <label for="job">yapılacaklar</label>
  <textarea id="msg" name="job" class="form-control" rows="4" cols="50">
</textarea>
<p id="checkchar"></p>


<script>
var message =document.getElementById('msg');
var cchar=document.getElementById('checkchar');
var max="300";
 var checkfunc=function(){
if(message.value.length < max){
 
cchar.innerHTML=(max-message.value.length)+"karakteriniz mevcut";
}else if(message.value.length >= max){
cchar.innerHTML="karakteriniz sınırı aşıldı ";
message.disabled="true";
}
}
setInterval(checkfunc,300);
</script>
</div>


   <button type="submit" name="jobrecord" class="btn btn-success btn-xs">Listeye ekle</button>
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
Show  completion task rate
</button>
<button type="button" class="btn btn-primary disabled" data-toggle="modal" data-target="#showjob">
Show time to task numbers
</button>
 </form>

 <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Task  completion Rate</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div id="piechart"></div>
      <script type="text/javascript" src="js/loader.js"></script>

      <script type="text/javascript">
        
  
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
    var first=document.getElementById('fir').value;
      var second=document.getElementById('sec').value;

    var data = google.visualization.arrayToDataTable([
          ['status', 'jobscount'],
          ['succeed',  parseInt(first)],
          ['waiting',  parseInt(second)]
        ]);

      var options = {
          title: 'TOTAL Tasks rate',
          is3D: true,
           colors: ['#28a745', '#dc3545']
        };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
      </div>

    </div>
  </div>
</div>


 <!-- The Modal -->
<div class="modal" id="showjob">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">show time to job statistics</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


<p>
      <?php

      /*
$query="SELECT count(duty) FROM listduty";
$stmt=$conn->prepare($query);
$stmt->execute();



$userData =array();


while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{

  $userData['job'][][]=$row;

  }
echo json_encode($userData);

*/
?>

    </p>
      <script type="text/javascript" src="js/loader.js"></script>

       <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "getData.php",
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
data.addColumn('string', 'Task');
data.addColumn('number', 'Hours per Day');
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 400, height: 240});
    }

    </script>
        <div id="chart_div"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
      </div>

    </div>
  </div>
</div>








</div>

</body>
</html>
