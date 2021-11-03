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
    elseif(!isset($_SESSION['qname']))
    {
        header("Location: question.php");
    }    
    // echo $_SESSION['qname'];
    



if(isset($_POST['done']))
{
    // unset($_SESSION['edit']);
    $conn = mysqli_connect('localhost', 'root', '');
    $username= $_SESSION['user'];
    $sqlQuery = "CREATE DATABASE IF NOT EXISTS `$username` ;";
    mysqli_query($conn,$sqlQuery);
    $conn1 = mysqli_connect('localhost', 'root', '', "$username");
    $tablename= $_SESSION['qname'];
    
    $sql= "CREATE TABLE IF NOT EXISTS `$username`.`".$tablename.
    '`( `question` VARCHAR(1200) NOT NULL ,
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
    $conn1->query($sql);

    $sql= "CREATE TABLE IF NOT EXISTS `$username`.`".$tablename.'responses`(
        `username` VARCHAR(200) NOT NULL,
        `no` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`no`)) ENGINE= InnoDB;';
    $conn1->query($sql);
    $response= $tablename."responses";

    $x= $_POST['x'];
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
    if(!isset($_SESSION['edit']))
    {
        $sql="INSERT INTO `$tablename` (`question`,`option1`, `option2`, `option3`, `option4`, `option5`, `correct_option`, `no_of_options`)
        VALUES ('$question',  '$options[0]', '$options[1]','$options[2]','$options[3]',' $options[4]','$correct ',' $x');";
        
        if ($conn1->query($sql) === TRUE) {
            $last_id = $conn1->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn1->error;
        }
        echo $last_id;
        //  $sql= " SELECT `no` FROM `$tablename` ORDER BY `no` DESC LIMIT 1";
        //  $result= $conn1->query($sql);
        //  $sie= mysqli_fetch_assoc($result);
        
        //  echo $sie["no"];
        $sql= "ALTER TABLE `$response`
        ADD `$last_id` INT";
        $conn1->query($sql);
    }
    else
    {
        $j= $_POST['j'];
        $j++;

        $sql= "UPDATE 
            `$tablename`
        SET 
            `question` ='$question',
            `option1`='$options[0]',
            `option2`='$options[1]',
            `option3`='$options[2]', 
            `option4`='$options[3]' , 
            `option5`='$options[4]', 
            `correct_option`='$correct', 
            `no_of_options`='$x' 
        WHERE 
            `no` = $j;";
        if(!$conn1->query($sql))
        {
            echo $conn1->error;
        }
        unset($_SESSION['edit']);
    }
}
    
?>
    


    <div class="content">

    <h1>ADD QUESTION</h1>
   <div class="instuction ">Please state the question, as well as the options and their responses.</div>
   
   <p> Question:</p>
    <form action="" method="post" class="questionsadd">
        <textarea name="question" id="question"></textarea>
        <br><br>

       <p> Options:</p>
        <div class="no_options t">
            number of options: <input type="number" id='no_of_options' name='no_of_options' oninput="give_option_blanks();"  >
        </div>
        <div id="optioncontainer">

        </div>

        <div><input type="number" name="x" id="x" hidden></div>
        <div id="correct-option" class="t" hidden>
            correct option is: <br>
            <input type="number" name="correct-option" id="correct" required min=1 >
        </div>
        <input type="number" name="j" id="j" hidden>
        <div class="submit">
        <input type="submit" value="add" name="done" id="done" disabled>
        </div>
        <button onclick="preview()">Preview added questions</button>
    </form>
    </div>
   


<script>

var x;
<?php

$edit= 0;
if(isset($_SESSION['edit']))
{
  
    
    $_SESSION['host']=$_SESSION['user'];
    $database = $_SESSION['host'];
    $connection = mysqli_connect("localhost", "root", "", "$database");
    $tablename= $_SESSION['qname'];
    $query = "SELECT * FROM `$database`.`" .$tablename.'`';
    $result = mysqli_query($connection, $query);
    $questionSet = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $noOfQuestions = sizeof($questionSet);
    $j= $_POST['editb'];

    echo "console.log($j);";
    $edit= 1;
    
    
    ?>
    document.getElementById("question").value= "<?=$questionSet[$j]['question']?>";
    give_option_blanks1(<?=$questionSet[$j]['no_of_options']?>);
    document.getElementById("correct").value= <?=$questionSet[$j]['correct_option']?>;
    document.getElementById("j").value= "<?=$j?>";
    var op=1;
    
    
    
<?php


    for($x=1;$x<=$questionSet[$j]['no_of_options'];$x++)
    {?>
    y= "option"+op;
    document.getElementById(y).value="<?=$questionSet[$j]["option".$x]?>";
    op++;
    <?php
    }

    // unset($_SESSION['edit']);
    
}
?>

function preview()
{
    window.location.href="editquestions.php";
}

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
function give_option_blanks1(x)
{

    var container= document.getElementById("optioncontainer");
        document.getElementById("no_of_options").value=x;
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
            input.id= "option"+i;
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


</body>
</html>