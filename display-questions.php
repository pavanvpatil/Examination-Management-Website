<?php 
    $connection = mysqli_connect("localhost", "root", "", "dbname");
    $query = "SELECT * FROM tbname";
    $result = mysqli_query($connection, $query);
    $questionSet = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $noOfQuestions = sizeof($questionSet); 
?>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="display-questions.css">
</head>
<body>
    <h1 style="text-align: center;">Quiz Name</h1>
    <div id="grandp">
        <div id="qnp">
            <div id="parent"></div>    <!--done-->
            <div class="buttonHolder"> <!--done -->
                <button class="controls" onclick="previous()">Previous</button>
                <button class="controls" onclick="next()">Next</button>
            </div>
        </div>
        <div id="navButtons"></div>
    </div>
    <button class="reviewButton">Mark for review</button>
    <p id="output"></p>

    <script>
        let parent = document.getElementById("parent");
        let x= <?= $noOfQuestions?>;
        let i1 = 1;
    <?php for( $i=0; $i< $noOfQuestions ; $i++){ ?>
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
        option1.name = "circle"+i;
        option2.name = "circle"+i;
        option3.name = "circle"+i;
        option4.name = "circle"+i;
        divop1.appendChild(option1);
        divop2.appendChild(option2);
        divop3.appendChild(option3);
        divop4.appendChild(option4);
        o1.innerHTML = "A. "+ "<?= $questionSet[$i]['option1'] ?>";
        o2.innerHTML = "B. "+ "<?= $questionSet[$i]['option2'] ?>";
        o3.innerHTML = "C. "+ "<?= $questionSet[$i]['option3'] ?>"; 
        o4.innerHTML = "D. "+ "<?= $questionSet[$i]['option4'] ?>";
        o1.className = "options";
        o2.className = "options";
        o3.className = "options";
        o4.className = "options";
        divop1.appendChild(o1);
        divop2.appendChild(o2);
        divop3.appendChild(o3);
        divop4.appendChild(o4);
        question.innerHTML = i1+". "+ "<?= $questionSet[$i]['question'] ?>";
        i1++
        question.className = "question";
        questionBody.appendChild(question);
        questionBody.appendChild(divop1);
        questionBody.appendChild(divop2);
        questionBody.appendChild(divop3);
        questionBody.appendChild(divop4);
        parent.appendChild(questionBody);
    <?php }?>
        let questionArray = document.getElementById("parent").childNodes;
        for(let i=1; i<=questionArray.length-1; i++){
            questionArray[i].style.display = "none";
        }
        let buttonsParent = document.getElementById("navButtons");
        for(let i = 1; i <= questionArray.length; i++){
            let y = document.createElement("button");
            y.className = "navButton";
            y.innerHTML = i;
            buttonsParent.appendChild(y);
        }
        var i = 0;
        currentBlue();
        function next(){
            if(i == questionArray.length-1){
                questionArray[i].style.display = "none";
                questionArray[0].style.display = "block";
                currentYellow();
                i = 0;
                currentBlue();
                return;
            }
            questionArray[i].style.display = "none";
            currentYellow();
            questionArray[i+1].style.display = "block";
            i++;
            currentBlue();
        }
        function previous(){
            if(i==0){
                questionArray[i].style.display = "none";
                currentYellow();
                questionArray[questionArray.length-1].style.display = "block";
                i = questionArray.length-1;
                currentBlue();
                return;
            }
            questionArray[i].style.display = "none";
            currentYellow();
            questionArray[i-1].style.display = "block";
            i--;
            currentBlue();
        }
        function currentBlue(){
            let navButtons = document.getElementById("navButtons");
            let buttonArray = navButtons.childNodes;
            buttonArray[i].style.background = "blue";
            buttonArray[i].style.color = "white";
        }
        function currentYellow(){
            let navButtons = document.getElementById("navButtons");
            let buttonArray = navButtons.childNodes;
            buttonArray[i].style.background = "rgb(250, 240, 225)";
            buttonArray[i].style.color = "teal";
        }
        var time = 600;
        var output = document.getElementById("output")
        function display(){
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
</body>

