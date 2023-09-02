
<?php
	session_start();
	if(!ISSET($_SESSION["name"])){
		header('location:login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>quiz app</title>
    <link rel="stylesheet" href="ho.css">
    
</head>
<body>
    
    <div class="flex">
        <div class="user-container">
            <!-- <p>Wecome To Quiz Game.</p> -->
            <div class="user">
            <img src="images.jpg" alt="No Image" class="avatar"><br>
            </div>
            <div class="wecome">
            
            <p><?php echo $_SESSION["name"];?></p>

            </div>

            <div class="countdown" >
                <span>CountDown :</span> <span id="countdown">10</span>  
            </div>
            
            
            <div class="quiz-score flex">
                <p style="color: black;"> quize : </p>
                <span id="current-quize"></span>/<span id="total-question"></span>
                </div>

            <div class="score">
                score :
                <span id="correct-score"></span>


            </div>
            
            
            <div class="logout-btn">
            <a href="logout.php"  >logout</a>
            </div>
          
            


        </div>
        <div class="wrapper">
        <p class="quiz-title"> Quize Game  </p>
             <div class="quiz-container">            
                <div class="class-head">
                    <div id="progress-bar">
                        <div id="filler"></div>      
                    </div>
                    <div class="quiz-body">
                        <h2 class="quiz-question" id="question"><br><span class="category"></span></h2>
                        <ul class="quiz-options">
                    
                        </ul>
                        <div id="result"></div>
                    </div>
                    <div class="quiz-foot">
                        <button type="button" id="check-answer">check answer</button>
                        <button type="button" id="play-again"> play again</button>
                    </div>
                </div>
            </div>
            
        </div>
        



        
        <script src="quiz.js"></script>
    </div>
   
</body>
</html>
