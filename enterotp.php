<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
	<style>
	
	body{
			background-image: linear-gradient(170deg,rgb(59, 59, 238), white);
            font-family: 'Courier New', Courier, monospace;;
	}
		input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
	.container{
	display: flex;
	flex-flow: column;
	height: 100%;
	align-items: space-around;
	justify-content: center;
}

.userInput{
	display: flex;
	justify-content: center;
}

input{
	margin: 10px;
	height: 35px;
	width: 65px;
	border: 1px solid black;
	border-radius: 5px;
	text-align: center;
	font-family: arimo;
	font-size: 1.2rem;
	background: #eef2f3;

}

h1{
	font-family: 'Courier New', Courier, monospace;;
	text-align: center;
	font-family: arimo;
	color: rgb(111, 255, 111);
}

#submit{
	width: 150px;
	height: 40px;
	margin: 25px auto 0px auto;
	font-family: arimo;
	font-size: 1.1rem;
	border: none;
	border-radius: 5px;
	letter-spacing: 2px;
	cursor: pointer;
    background-color: teal;
	color:white;
	border:1px solid white;
}

#submit:hover{
    background-color: rgb(75, 35, 187);
    color: white;
    transition: 0.3s;
}

	</style>
</head>
<body>
    <form action="" method="post">
	<div class="container">
		<h1 style="color:white" >ENTER OTP</h1>
		<div class="userInput">
			<input type="number" id='ist' name="otp[]" maxlength="1" onkeyup="clickEvent(this,'sec')">
			<input type="number" id="sec" name="otp[]" maxlength="1" onkeyup="clickEvent(this,'third')">
			<input type="number" id="third" maxlength="1" name="otp[]" onkeyup="clickEvent(this,'fourth')">
			<input type="number" id="fourth" maxlength="1" onkeyup="clickEvent(this,'fifth')" name="otp[]">
			<input type="number" id="fifth" maxlength="1" onkeyup="clickEvent(this,'sixth')" name="otp[]">
			<input type="number" id="sixth" maxlength="1" name="otp[]">

		</div>
		<input type="submit" value="Confirm" name="submit" id='submit'>
	</div>
    </form>
	<script>
		function clickEvent(first,last){
			if(first.value.length){
				document.getElementById(last).focus();
			}
		} 
	</script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
		if(@$_POST['submit'])
		{
			session_start();
			
			$Email= $_SESSION['emailp'];
			$conn= mysqli_connect('localhost','root','','userinfo');
			$sql= "SELECT * FROM otp WHERE EMAIL='$Email'";
			$result= $conn->query($sql);
			$x = ($result->num_rows)-1;
			$otp=mysqli_fetch_all($result,MYSQLI_ASSOC);
			$inpa= $_POST['otp'];
			$j=100000;
			$inp= 0;
			for($i=0;$i<sizeof($inpa);$i++)
			{	
				$inp= ($inp) +$inpa[$i]*$j;
				$j= $j/10;
			}
			echo $inp;
			if($inp==$otp[$x]['OTP'])
			{
				$sql= "DELETE FROM otp WHERE EMAIL='$Email';";
				$conn->query($sql);
				header("Location: newpassword.php");
			}
			else
			{
				echo '<script>alert(`PLEASE ENTER CORRECT OTP`)</script>';
			}
		}
?>