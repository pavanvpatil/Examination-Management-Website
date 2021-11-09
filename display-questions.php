<?php 
    session_start();
    $hostName = $_SESSION['q_host_db'];
    $tableName = $_SESSION['q_current_table'];
    $connect = mysqli_connect("localhost", "root", "", $hostName);
    $connection = mysqli_connect("localhost", "root", "", $hostName);
    $query = "SELECT * FROM $tableName;";
    $result = mysqli_query($connection, $query);
    $questionSet = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $noOfQuestions = sizeof($questionSet); 
    $responses= $tableName."responses";
    $user=$_SESSION['user'];
    $sql= "SELECT * FROM `$responses` WHERE username='$user'";
    $result1= $connect->query($sql);
    $res= $result1->fetch_assoc();
   
    if(isset($res['result']))
    {
        if($res['result']!=NULL)
        {
            header("Location: homepage.php");
        }
        
    }


?>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@300&display=swap" rel="stylesheet">
    <style>
        body{
            background-image: linear-gradient(190deg,rgb(166, 239, 252),rgb(243, 247, 247) );
            margin: 0px;
        }
        #output{
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1.4rem;
            color: rgb(16, 1, 60);
            position: absolute;
            top: 5.4rem;
            left: 12.2rem;
            font-weight: bold;
            color: red;
        }
        #navButtons{
        position: absolute;
        flex-wrap: wrap;
        top: 10rem;
        right: 2rem;
        width: 25%;
        height: 20rem;
        margin-left: 5%;
        }
        .qnp{
            width: 65%;
        }

        .buttonHolder{
            display: flex;
            justify-content: space-between;
            position: absolute;
            top: 32.5rem;
            left: 15.5rem;
        }
        .controls{
            padding: 0.7rem;
            margin: 0.7rem;
            font-size: 1.0rem;
            font-weight: 600;
            text-align: center;
            font-family: 'Zen Kaku Gothic Antique', sans-serif;
            border: 1px solid black;
            color: white;
            background-color: teal;
            cursor: pointer;
            border-radius: 3px;
        }
        .controls:hover{
            color: rgb(236, 236, 236);
            transition: 0.4s;
            background-color: rgb(30, 96, 36);
        }
        .options{
            font-size: 20px;
            padding-left: 15px;
            color: white;
        }
        .question{
            font-size: 30px;
            margin-bottom: 10px;
            color: white;
        }
        h1{
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 4rem;
            transform: scale(1.1, 1);
            color: #20546d;
            text-shadow:6px 6px 40px rgb(57, 130, 154);
            text-align: center;
            margin: 0rem;

        }
        .Qcontainer{
            width: 65%;
            box-sizing: border-box;
            min-height: 22rem;
            font-family: 'Zen Kaku Gothic Antique', sans-serif;
            font-weight: bold;
            background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));;
            position: absolute;
            top: 10rem;
            left: 2.2rem;
            padding: 1.5rem;
            box-sizing: border-box;
            border-radius: 6px;
            border: 0.8px solid black;
        }
        input[type='radio']:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #d1d3d1;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }
        input[type='radio']:checked:after {
            width: 18px;
            height: 18px;
            border-radius: 18px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: green;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }
        .opdiv{
            padding: 8px;
        }
        .navButton{
            width: 3.2rem;
            height: 3.2rem;
            font-size: 1.5rem;
            padding: 0.3rem;
            margin: 0.2rem;
            color: teal;
            background-color: rgb(250, 240, 225);
            opacity: 70%;
            border: 0.8px solid black;
            border-radius: 2px;
        }
        .navButton:hover{
            transition: 0.5s;
            background-color: rgb(255, 226, 182)!important;
            color: black !important;
        }
        #grandp{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        .reviewButton{
            text-align: center;
            font-family: 'Zen Kaku Gothic Antique', sans-serif;
            border: 1px solid black;
            color: white;
            background-color: teal;
            cursor: pointer;
            border-radius: 3px;
            position: absolute;
            font-size: 1.1rem;
            top: 5.5rem;
            left: 1.8rem;
            padding: 0.6rem;
            margin: 0.6rem;
            font-weight: 600;
        }
        .reviewButton:hover{
            color: rgb(236, 236, 236);
            transition: 0.4s;
            background-color: rgb(30, 96, 36);
        }
        #parent{
            margin-right: 2%;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; font-size: 2.8rem;"><?php echo "Quiz name: ".$tableName?></h1>
    <div id="grandp">
        <div id="qnp">
            <div id="parent"></div>
            <div class="buttonHolder">
                <form action="Submit.php" method="post" id="form"></form>
                <button class="controls" onclick="previous()">PREVIOUS</button>
                <button class="controls" onclick="reset()">RESET</button>
                <button class="controls" onclick="next()">NEXT</button>
                <button class="controls submit" onclick="submit()">SUBMIT</button>
            </div>
        </div>
        <div id="navButtons"></div>
    </div>
    <button class="reviewButton" onclick="mark_for_review()">Mark for review</button>
    <p id="output"></p>

    <script>
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
        if("<?= $questionSet[$i]['option3'] ?>"!=''){
            o3.innerHTML = "C. "+ "<?= $questionSet[$i]['option3'] ?>"; 
            divop3.appendChild(option3);
        }if("<?= $questionSet[$i]['option4'] ?>"!=''){
            divop4.appendChild(option4);
            o4.innerHTML = "D. "+ "<?= $questionSet[$i]['option4'] ?>";
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
        questionBody.appendChild(divop3);
        questionBody.appendChild(divop4);
        form.appendChild(ans);
        parent.appendChild(questionBody);
        <?php }?>
        let questionArray = document.getElementById("parent").childNodes;
        for(let i=1; i<=questionArray.length-1; i++){
            questionArray[i].style.display = "none";
        }
        var i = 0;
        let buttonsParent = document.getElementById("navButtons");
        for(let j = 1; j <= questionArray.length; j++){
            let y = document.createElement("button");
            y.className = "navButton";
            y.id = j;
            y.innerHTML = j;
            y.addEventListener('click', function(event){
                let value=0;
                let n=i+1;
                circlename='circle'+n;
                let radios = document.getElementsByName(circlename);
                for(let j = 0; j < radios.length; j++){
                    if(radios[j].type === 'radio' && radios[j].checked){
                        value = radios[j].value;    
                           
                    }
                }
               
                if(questionArray[i].style.background == "purple" || questionArray[i].style.background == "orange"){

                }else{
                    if(value === 0){
                        currentRed();
                    }else{
                        currentGreen();
                    }
                }
                questionArray[i].style.display = "none";
                questionArray[j-1].style.display = "block";
                i = j-1;
                currentBlue();
            })
            buttonsParent.appendChild(y);
        }
        var clicked= false;
        function submit(){
             clicked= true;
            var z=0;
            let values= new Array(x+1);
            for(z=1;z<=x;z++)
            {
                var value=0;
           
            circlename='circle'+z;
            let radios = document.getElementsByName(circlename);
            for(let j = 0; j < radios.length; j++){
                if (radios[j].type === 'radio' && radios[j].checked){
                    value = radios[j].value ;  
                    values[z]= j+1;     
                    console.log(j,values[z]);
                    document.getElementById("ans"+z).value= j+1;
                }
                console.log(j);
            }
            console.log(values);          
            var form = document.getElementById("form");
            form.submit();
            }    
        }
        currentBlue();
        function next(){
            let value=0;
            let n=i+1;
            circlename='circle'+n;
            let radios = document.getElementsByName(circlename);
            for(let j = 0; j < radios.length; j++){
                if (radios[j].type === 'radio' && radios[j].checked){
                    value = radios[j].value ;    
                }
            }
            if(i == questionArray.length-1){
                questionArray[i].style.display = "none";
                questionArray[0].style.display = "block";
                if(value==0){
                    currentRed();
                }
                else{
                    currentGreen();
                }
                i = 0;
                currentBlue();
                return;
            }
            questionArray[i].style.display = "none";
            if(value == 0){
                currentRed();
            }
            else{
                currentGreen();
            }
            questionArray[i+1].style.display = "block";
            i++;
            currentBlue();
        }
        function reset(){
            let n=i+1;
            circlename='circle'+n;
            let radios = document.getElementsByName(circlename);
            for(let j=0;j<radios.length;j++){
                radios[j].checked=false;
            }
        }
        function previous(){
            let value=0;
            let n=i+1;
            circlename='circle'+n;
            let radios = document.getElementsByName(circlename);
            for(var j = 0; j < radios.length; j++){
                if(radios[j].type === 'radio' && radios[j].checked){
                    value = radios[j].value;       
                }
            }
            if(i==0){
                questionArray[i].style.display = "none";
                if(value==0){
                    currentRed();
                }
                else{
                    currentGreen();
                }
                questionArray[questionArray.length-1].style.display = "block";
                i = questionArray.length-1;
                currentBlue();
                return;
            }
            questionArray[i].style.display = "none";
            if(value==0){
                currentRed();
            }
            else{
                currentGreen();
            }
            questionArray[i-1].style.display = "block";
            i--;
            currentBlue();
        }
        function mark_for_review(){
            var value=0;
            let n=i+1;
            circlename='circle'+n;
            var radios = document.getElementsByName(circlename);
            for(var j = 0; j < radios.length; j++){
                if(radios[j].type === 'radio' && radios[j].checked){
                    value = radios[j].value;       
                }
            }
            if(i == questionArray.length-1){
                questionArray[i].style.display = "none";
                questionArray[0].style.display = "block";
                if(value==0){
                    currentOrenge();
                }
                else{
                    currentPurple();
                }
                i = 0;
                currentBlue();
                return;
            }
            questionArray[i].style.display = "none";
            if(value==0){
                currentOrenge();
            }
            else{
                currentPurple();
            }
            questionArray[i+1].style.display = "block";
            i++;
            currentBlue();
        }
        function currentBlue(){
            let navButtons = document.getElementById("navButtons");
            let buttonArray = navButtons.childNodes;
            buttonArray[i].style.background = "blue";
            buttonArray[i].style.color = "white";
        }
        function currentOrenge(){
            let navButtons = document.getElementById("navButtons");
            let buttonArray = navButtons.childNodes;
            buttonArray[i].style.background = "Orange";
            buttonArray[i].style.color = "white";
        }
        function currentRed(){
            let navButtons = document.getElementById("navButtons");
            let buttonArray = navButtons.childNodes;
            buttonArray[i].style.background = "red";
            buttonArray[i].style.color = "white";
        }
        function currentPurple(){
            let navButtons = document.getElementById("navButtons");
            let buttonArray = navButtons.childNodes;
            buttonArray[i].style.background ='purple';
            buttonArray[i].style.color = "white";
        }
        function currentGreen(){
            let navButtons = document.getElementById("navButtons");
            let buttonArray = navButtons.childNodes;
            buttonArray[i].style.background = "green";
            buttonArray[i].style.color = "white";
            
        }
        function currentYellow(){
            let navButtons = document.getElementById("navButtons");
            let buttonArray = navButtons.childNodes;
            buttonArray[i].style.background = "rgb(250, 240, 225)";
            buttonArray[i].style.color = "teal";
        }
        <?php
        date_default_timezone_set('asia/kolkata');
        $stime= date("H:i:s");
        echo "console.log('$stime');";
        
        $etime= $_SESSION['q_end_time'];
        $seconds= 0;
        $start= strtotime($stime);
        $end= strtotime($etime);
        echo "console.log('$etime');";
        $seconds= $end- $start;
        echo "console.log('$seconds');";
        ?>
        var time = <?=$seconds?> 
        var output = document.getElementById("output")
        function display(){
            if(time<=0)
            {
                submit();
            }


            if(time == 0){
                clearInterval(event);
            }
            let min = parseInt(time/60);
            let sec = time%60;
            if(parseInt(min/10)==0){
                min = '0' + min;
            }
            if(parseInt(sec/10)==0){
                sec = '0' + sec;
            }
            output.innerHTML = "Time left : "+min+":"+sec;
            time--;
        }
        let event = setInterval(display, 1000);      
    </script>
    <script>
        console.log(clicked);

window.onbeforeunload = function(event) {
    alert("hello");
    if(!clicked)
    {
        event.returnValue = "Write something clever here..";
    }
  
};
</script>
</body>

