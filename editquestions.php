<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    session_start();
    $database = $_SESSION['user'];
    $connection = mysqli_connect("localhost", "root", "", "$database");
    $tablename= $_SESSION['qname'];
    $query = "SELECT * FROM `$database`.`" .$tablename.'`';
    $result = mysqli_query($connection, $query);
    $questionSet = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $noOfQuestions = sizeof($questionSet); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit questions</title>
    <link rel="icon" href="Extra/letter_q.png">
    <link rel="stylesheet" href="editquestions.css">    
</head>
<body>
<h1 style="text-align: center;" id='quizname'>Quiz Name</h1>
    <button onclick="saveall()">Save All</button>
    <div id="grandp">
        <div id="qnp">
            <div id="parent"></div>    <!--done-->    
        </div>
    <form action="questionsadd.php" style="display:none" method="post" id= "form">
        <input type="number" name="editb" id="editb">
    </form>
<script>
        document.getElementById("quizname").innerHTML="<?=$tablename?>";
        let parent = document.getElementById("parent");
        let x= <?= $noOfQuestions?>;
        let i1 = 1;
    <?php for( $i=0; $i< $noOfQuestions ; $i++){ ?>
        var form = document.getElementById("form");
        var questionBody = document.createElement("div");
        questionBody.className = "Qcontainer";
        var question = document.createElement("div");
        var divop1 = document.createElement("div");
        var divop2 = document.createElement("div");
        var divop3 = document.createElement("div");
        var divop4 = document.createElement("div");
        var edit= document.createElement("div");
        var editb= document.createElement("button");
        
        editb.innerHTML= "Edit";

        editb.setAttribute("onclick","editf(<?=$i?>)")
       
        edit.appendChild(editb);
        var option1 = document.createElement("input");
        var option2 = document.createElement("input");
        var option3 = document.createElement("input");
        var option4 = document.createElement("input");
        var ans= document.createElement("input");
        var o4 = document.createElement("span");
        var o3 = document.createElement("span");
        var o2 = document.createElement("span");
        var o1 = document.createElement("span");
        divop1.className = "opdiv";
        divop2.className = "opdiv";
        divop3.className = "opdiv";
        divop4.className = "opdiv";
        option1.className = "buttons";
        option2.className = "buttons";
        option3.className = "buttons";
        option4.className = "buttons";
        option1.type = "radio";
        option2.type = "radio";
        option3.type = "radio";
        option4.type = "radio";
        ans.type= "input";
        ans.name= "values[]";
        ans.hidden= true;
        ans.id= 'ans'+i1;
        ans.value=0;
        option1.name = "circle"+i1;
        option2.name = "circle"+i1;
        option3.name = "circle"+i1;
        option4.name = "circle"+i1;

        if("<?= $questionSet[$i]['option1'] ?>"!=''){
            divop1.appendChild(option1);
            o1.innerHTML = "A. "+ "<?= $questionSet[$i]['option1'] ?>";
        }
        if("<?= $questionSet[$i]['option2'] ?>"!=''){
            divop2.appendChild(option2);
            o2.innerHTML = "B. "+ "<?= $questionSet[$i]['option2'] ?>";
        }

        o1.className = "options";
        o2.className = "options";
        o3.className = "options";
        o4.className = "options";
        divop1.appendChild(o1);
        divop2.appendChild(o2);
        divop3.appendChild(o3);
        divop4.appendChild(o4);
        question.innerHTML = i1+". "+ "<?= $questionSet[$i]['question'] ?>";
        i1++;
        question.className = "question";
        questionBody.appendChild(question);
        questionBody.appendChild(divop1);
        questionBody.appendChild(divop2);
        if("<?= $questionSet[$i]['option3'] ?>"!=''){
            o3.innerHTML = "C. "+ "<?= $questionSet[$i]['option3'] ?>"; 
            divop3.appendChild(option3);
            questionBody.appendChild(divop3);
        }if("<?= $questionSet[$i]['option4'] ?>"!=''){
            divop4.appendChild(option4);
            o4.innerHTML = "D. "+ "<?= $questionSet[$i]['option4'] ?>";
            questionBody.appendChild(divop4);
        }
 
        edit.className= "edits";
        questionBody.appendChild(edit);
        parent.appendChild(questionBody);
    <?php }?>

    function editf(editno)
    {
        document.getElementById("editb").value= editno;
        <?php
            $_SESSION['edit']= TRUE; 
        ?>
        
        var form = document.getElementById("form");
        form.submit(); 
    }
    function saveall()
    {
       
        location.replace("index.php");
    
    }

    </script>
</body>
</html>