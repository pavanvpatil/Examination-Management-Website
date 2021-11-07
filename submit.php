<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
      session_start();
      $user= $_SESSION['user'];
      $host= $_SESSION['q_host_db'];
      $qname= $_SESSION['q_current_table'];
      $qnameres= $qname."responses";
      $conn1= mysqli_connect("localhost","root",'',"$host");
      $sql= "INSERT INTO `$qnameres` (`username`) VALUES ('$user');";
      if(! $conn1->query($sql))
      {
          echo $conn1->error;
      }
      $id=$conn1->insert_id;
      $answers= $_POST['values'];
      $sql= "SELECT  `correct_option` FROM `$qname`;";
      $result=  $conn1->query($sql);
      $correct= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $rightans=0; 
      for ($i=1;$i<=sizeof($answers);$i++)
      {
        $j= $i-1;
        $val= $answers[$j];
        if($val==$correct[$j]['correct_option'])
        {   
          $rightans++;
        }
        $sql= "UPDATE `".$qnameres."` SET `$i` = '$val' WHERE `$qnameres`.`no` = $id;";
        if(!$conn1->query($sql))
        {
            echo $conn1->error;
        }
      }
      $sql= "ALTER TABLE `$qnameres` ADD if not exists `result` INT";


      if(!$conn1->query($sql))
      {
          echo $conn1->error;
      }
      $sql= "UPDATE `".$qnameres."` SET `result` = '$rightans' WHERE `$qnameres`.`no` = $id;";

      if(!$conn1->query($sql))
      {
          echo $conn1->error;
      }
      $connuser= mysqli_connect('localhost','root','',$user);
      $qid= $_SESSION['id'];
      $sql= "UPDATE reg_quizes SET `attempted`= '1' WHERE `id`='$qid';";
      $connuser->query($sql);
      // $sql= "CREATE IF NOT EXISTS "
      // $sql= "INSERT INTO "
      unset($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.anychart.com/releases/8.0.0/js/anychart-base.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>Result</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Mono&family=Roboto:wght@100&family=Zen+Kaku+Gothic+Antique:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
      @media print
      {    
          .no-print, .no-print *
          {
              display: none !important;
          }
      }
      body{
        margin: 0px;
        padding: 0px;
        background: linear-gradient(190deg,rgb(243, 247, 247),rgb(166, 239, 252));
        /* font-family: 'Zen Kaku Gothic Antique', sans-serif; */
        font-family: 'Courier New', Courier, monospace;
        color: rgb(102, 48, 84);
      }
      .flex1{
        display: flex;
        justify-content: space-between;
        margin: 2% 5%;
      }
      .flex2{
        display: flex;
        justify-content: space-between;
        margin: 2% 5%;
      }
      .result{
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 3% 5%;
        position: relative;
      }
      .heading{
        position:relative;
        top: 0rem;
        text-align: center;
        margin: 0px;
        font-size: 2.8rem;
        color: rgb(27, 160, 78);
      }
      h1{
        margin: 0px;
      }
      /* nav style */
      .topnav {
  overflow: hidden;
  position: relative;
  background-color:rgb(176, 237, 248);
  height: auto;
  width: auto;
  position: sticky;
  top: 0;
  border: 1px solid black;
  z-index: 100;
  font-family: 'Courier New', Courier, monospace;
  font-weight: bold;
}

.topnav a {
  float: left;
  color:black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 22px;
}

.topnav a:hover {
  background-color:skyblue;
  color: black;
}

#login_icon{
  width: 27px;
  height: 27px;
  border-radius: 50%;
}

#log_img{
  padding-top: 8px;
  padding-right: 8px;
  cursor: pointer;
  position: absolute;
  top: 15%;
  right: 1%;

}
.print{
  position: relative;
  display: flex;
  flex-direction: row-reverse;
  margin: 3%;
}
.printBtn{
  padding: 0.8rem;
  font-size: 1.1rem;
  border: .6px solid darkblue;
  border-radius: 4px;
  color: white;
  background:rgb(102, 48, 84);
}
.printBtn:hover{
  background-color: green;
  transition: 0.7s;
}
    </style>
</head>
<body>
<div class="topnav no-print">
  <a style="font-size: 17px;" href="homepage.php"><i class="fa-solid fa-house-user"></i> Home</a>
  <a style="font-size: 17px;" href="contact.php"><i class="fa-solid fa-phone"></i></i> Contact</a>
  <a style="font-size: 17px;" href="about.php"><i class="fa-solid fa-book"></i> About</a>
  <a style="font-size: 17px;" href="viewprofile.php"><i class="fas fa-user-alt"></i> Profile</a>
  <a style="font-size: 17px;" href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
  <div  id="log_img">
  <span style="font-size:17px;color:blue;"><i class="fas fa-user-alt"></i> <?php echo "$user"; ?></span>
  </div> 
</div>
  <h1 class="heading">
    Quiz Name: 
    <span style="color: rgb(0, 183, 255)">
    <?php echo $qname ?>
    </span>
  </h1>

  <div class="flex1">
    <h1>
      Candidate name: 
      <span style=" color: rgb(114, 113, 113)">
        <?php echo $_SESSION['user']; ?>
      </span>
    </h1>
    <h1>
      Host name: 
      <span style=" color: rgb(114, 113, 113)">
        <?php echo $_SESSION['q_host_db']; ?>
      </span>
    </h1>
  </div>

  <div class="flex2">
    <h1>
      Quiz date: <?php echo "25/11/2022";?>
    </h1>
    <h1>
      Quiz ID: <?php echo "2" ?>
    </h1>
  </div>

  <div class="result">
  <h2 style="font-size: 2rem; margin-top: 0px;">Your score: <span><?php echo '<span style="color:rgb(21, 167, 21);">'.$rightans.'</span>'.'/'.'<span style="color: rgb(0, 183, 255);">'.sizeof($answers).'</span>'; ?></span></h2>
    <h1><i class="fas fa-poll-h"></i> Question Statistics</h1>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
</div>
<div class="print no-print">
  <button class="printBtn"onclick="window.print();">Print Result</button>
</div>

<script>
  var xValues = ["Correct", "Total"];
  var yValues = [<?=$rightans?>,<?=sizeof($answers)?>];
  var barColors = ["rgb(21, 167, 21)", "rgb(0, 183, 255)"];


new Chart("myChart", {
  type: "horizontalBar",
  data: {
  labels: xValues,
  datasets: [{
    backgroundColor: barColors,
    data: yValues
  }]
},
  options: {
    legend: {display: false},
    title: {
      display: false,
      text: "World Wine Production 2018"
    },
    scales: {
      xAxes: [{ticks: {min: 0, max:<?=sizeof($answers)?>}}]
    }
  }
});
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
</script>

</body>
</html>

<?php
}
?>






