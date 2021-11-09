<?php
    session_start();
    $email=$_SESSION['mail'];
    if(!isset($_SESSION['loggedin']))
    {
        header("Location: index.php");
    }
    $connect=mysqli_connect("localhost","root","","userInfo");
    $sql="SELECT * FROM usertable WHERE uGmail='$email'";
    $result=mysqli_query($connect,$sql);
    $row = $result->fetch_assoc();
    $username=$row['uName'];
?>
<link rel="icon" href="Website-icon/letter_q.png">
<div class="topnav">
      <a style="font-size: 17px;" href="homepage.php"><i class="fa-solid fa-house-user"></i> Dashboard</a>
      <a style="font-size: 17px;" href="contact.php"><i class="fa-solid fa-phone"></i></i> Contact</a>
      <a style="font-size: 17px;" href="about.php"><i class="fa-solid fa-book"></i> About</a>
      <a style="font-size: 17px;" href="viewprofile.php"><i class="fas fa-user-alt"></i> Profile</a>
      <a style="font-size: 17px;" href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
      <div  id="log_img">
      <!-- <img src="login_icon.jpg" alt="no image found" id="login_icon"><br> -->
      <span style="font-size:17px;color:blue;"><i class="fas fa-user-alt"></i> <?php echo "$username"; ?></span>
      </div> 
</div>
<html>
    <head>
        <title>Compete</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
body{
  margin: 0rem;
  padding: 0rem;
  font-family: 'Courier New', Courier, monospace;
  font-weight:600;
  background-image: linear-gradient(170deg,rgb(243, 247, 247),rgb(166, 239, 252) );
}
.topnav {
  overflow: hidden;
  background-color:rgb(176, 237, 248);
  height: auto;
  width: auto;
  position: sticky;
  top: 0;
  border: 1px solid black;
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
#output{
  margin:5%;
  margin-top:2%;
  font-size:20px;
}

li{
  margin:2%;
  margin-left:0%;
}
</style>
    </head>
    <body>
      <h1 style="text-align:center; color: grey;">Website Overview</h1>
    <div id="output">
            Compete website enables users to use the features of efficient examination conduct seemlessly. Every user has a feature to host any objective based quiz by mentioning the necessary details of the quiz conduct like quiz date, quiz time and duration. The host can also set the academic criteria for the users to register for the quiz. Every user in the website can register for the quiz given they have passed necessary academic requirements by suitable means and give the examination on the quiz portal. After giving the examination users can veiw there quiz report which enables them to reassess their performance. The home page has many features which enables users to view their profile, know about how the website works and many more.
        </div>
        <h1 style="text-align:center; color: grey;">Website Components</h1>
        <div id="output">
            <ul>
                <li>
                    <b>Login: </b> Every user has to login into the homepage atleast once before using the website features. If the user is new to the website then he/she can set up a new account by signing up and providing necessay details like email-ID, username, educational qualification etc and setting up a password. Username and user email-ID should be unique for avoiding unwanted conflicts.
                </li>
                <li>
                    <b>Home page: </b>  After logging into the website successfully the homepage is displayed. Its UI enables users to host, register, attempt and review the quiz 
                    by a single button click. All the quizes hosted on the website are displayed using carousel on the homepage which contains all the necessay information about the quiz content and conduct. There is an additional feature in the foot section of the homepage where the number of current users in the website, the number of quizes hosted by the user and the number of quizes hosted in the website are displayed dynamically. The users can also veiw their profile and the website overview. Logout feature is also added where the user can logout from the website if required and in the later stage can resume by logging in.
                </li>
                <li>
                   <b> Host a quiz:</b>  This page takes the questions from the quiz host 
                    and stores it in the user database.
                    The host is asked to enter the necessary details like quiz name, date of the examination, start time, end time and eligibility of the candidate.
                    Then the host is required to add questions.
                    The host is allowed to chose multiple choice questions with number of options varying from two to five.
                    The host has to feed in the question and after giving number of options, 
                    the form for entering the choices is generated dynamically. The host must also provide the correct option corresponding to the question in the input form which will be used for evaluation in the quiz portal.
                    <!-- We are planning to implement taking images of questions in the coming days. -->
                </li>
                <li>
                    <b>Quiz portal: </b> The quiz portal has many subtle features which enables the users to become scrupulous about their responses and attempt to thier level best. There are buttons for displaying next and previous questions. The navigation buttons provided for question transversal help user to navigate between questions effortlessly. Different visual colors are displayed for different attempt status of a quesiton. <span style="color: red;">Red</span> for attempting a question and not selecting an option, <span style="color: green">green</span>  for attempting a question and selecting an option, <span style="color: orange;">orange</span> for not answering and marking a question for review and <span style="color: purple;">purple</span> for answering and marking a question for review. Timer is displayed for diplaying the time remaining and if the user doesn't submit the quiz in time it will get auto submitted.
                </li>
            </ul>
        </div>
    </body>
</html>