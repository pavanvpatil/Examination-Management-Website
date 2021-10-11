<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add questions</title>
</head>
<body>
   <div class="instuction">Please give the question and four options and their answers.</div>
   
    Question:
    <form action="" method="post">
        <textarea name="question" id="question" style="width:90%"></textarea>
        <br><br>
        Options:
        <div class="no_options">
            number of options: <input type="number" id='no_of_options' name='no_of_options' oninput="give_option_blanks();"  >
        </div>
        <div id="optioncontainer">

        </div>
        <div></div>
        <div></div>
        <input type="submit" value="add" name="done" id="done" disabled>


    </form>



    <script>

        function give_option_blanks()
        {
 
            var container= document.getElementById("optioncontainer");
            var x=document.getElementById("no_of_options").value;
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
                   input.id= "options"
                   input.type= "text";
                   input.name="option"+i; 
                   input.required;
          
                    container.appendChild(input);

                   
                    container.appendChild(document.createElement("br"));
                    container.appendChild(document.createElement("br"));
                    document.getElementById('done').disabled=false;
                    document.getElementById("no_of_options").setCustomValidity('');
                    
                }
            }
        }
    </script>


        <?php
    
?>
</body>
</html>