<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Extra/letter_q.png">
    <title>Add questions</title>
    <link rel="stylesheet" href="questionsadd.css">
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['loggedin']))
    {
        header("Location: index.php");
    }

    ?>
    <div class="content">

    <h1>ADD QUESTION</h1>
   <div class="instuction">Please state the question, as well as the options and their responses.</div>
   
    Question:
    <form action="" method="post">
        <textarea name="question" id="question"></textarea>
        <br><br>
        Options:
        <div class="no_options">
            number of options: <input type="number" id='no_of_options' name='no_of_options' oninput="give_option_blanks();"  >
        </div>
        <div id="optioncontainer">

        </div>

        <div><input type="number" name="x" id="x" hidden></div>
        <div id="correct-option" hidden>
            correct option is: <br>
            <input type="number" name="correct-option" id="correct" required min=1 >
        </div>
        <input type="submit" value="add" name="done" id="done" disabled>


    </form>


    </div>
    <script>
        var x;
        function give_option_blanks()
        {
 
            var container= document.getElementById("optioncontainer");
             x=document.getElementById("no_of_options").value;
            console.log(x);
            if(x>5 || x<2)
            {
                document.getElementById("no_of_options").setCustomValidity('You can have 2 to 5 options for a question');
                document.getElementById("no_of_options").reportValidity();
                console.log("here");

            }
            else
            {
                while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
                for (i=1;i<=x;i++)
                {
                    var br=document.createElement("br");
                    
                    container.appendChild(document.createTextNode("Option " + (i)+": "));
                    container.appendChild(br);
                   var input=document.createElement("input");
                   input.class= "options"
                   input.type= "text";
                   input.name="option"+i; 
                   input.required;
          
                    container.appendChild(input);
                   
                    container.appendChild(document.createElement("br"));
                    container.appendChild(document.createElement("br"));
                    document.getElementById('done').disabled=false;
                    document.getElementById("no_of_options").setCustomValidity('');
                    
                }
                correct= document.getElementById('correct');
                correct.max= x;
                document.getElementById('x').value=x;


                div= document.getElementById('correct-option');
                div.hidden=false;
                
                
            }
        }


        
    </script>


        <?php

        if(isset($_POST['done']))
        {
            
            $conn = mysqli_connect('localhost', 'root', '');
            $sqlQuery = 'CREATE DATABASE IF NOT EXISTS userInfo ;';
            mysqli_query($conn,$sqlQuery);
            $conn1 = mysqli_connect('localhost', 'root', '', 'userInfo');
            $tablename= 'quiz'.$_SESSION['user'];
            $sql= 'CREATE TABLE IF NOT EXISTS `userinfo`.`'.$tablename.'` 
            ( `question` VARCHAR(1200) NOT NULL ,
            `no` INT NOT NULL AUTO_INCREMENT , 
            `option1` VARCHAR(200) NOT NULL , 
            `option2` VARCHAR(200) NOT NULL , 
            `option3` VARCHAR(200) NOT NULL , 
            `option4` VARCHAR(200) NOT NULL , 
            `option5` VARCHAR(200) NOT NULL , 
            `correct_option` TINYINT NOT NULL ,
            `no_of_options` TINYINT NOT NULL , 
            PRIMARY KEY (`no`)) ENGINE = InnoDB;';
            $question= $_POST['question'];
            $x= $_POST['x'];
            
            $conn1->query($sql);
            $options= [];
            for($i=1;$i<=$x;$i++)
            {
                $opt= "option".$i;
              
                $options[$i-1]= $_POST[$opt];
                
            }
            
            for($i=((int)$x)+1;$i<=5;$i++)
            {
                
                $options[$i-1]='';
            }
            

            $correct= $_POST['correct-option'];
            
            $sql="INSERT INTO `$tablename` (`question`,`option1`, `option2`, `option3`, `option4`, `option5`, `correct_option`, `no_of_options`)
            VALUES ('$question',  '$options[0]', '$options[1]','$options[2]','$options[3]',' $options[4]','$correct ',' $x');";
            
            if(!$conn1->query($sql))
            {
                echo "error inserting";
            }
            

        }
    
?>
</body>
</html>