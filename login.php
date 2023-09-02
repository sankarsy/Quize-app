
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="log.css">
    <title>Document</title>
</head>
<body>
    <div>
        <!-- login msg -->
        <?php

        include("config.php");

        if(isset($_GET["mes"]))
        {
            echo $_GET["mes"];
        }

        ?>
    </div>
    <div class="container">

    
        <form action="login.php" method="post" autocomplete="off" onsubmit="return formvalidation()">
            <header>Login Here</header>
            
            <input type="text" id="name" name="name" placeholder="User name" ><br><br>
            
            

            <input type="password" id="password" name="password" placeholder="password" ><br><br>
            
            
            <input type="submit" name="submit" value="login"class="btn btn-primary" ><br><br>
            <center>
            <a href="index.html">New User Registration</a>
            </center>
        </form>
    </div>

    <?php
    session_start();
    //declaring and variables
    $name = "";
    $email = "";
    $errors = array(); 
    $_SESSION['success'] = "";
    
    
    if(isset($_POST["submit"]))
    {
        
        $username =$_POST["name"];
        $password =$_POST["password"];

        //erro massage if the input field is left blank
        if(empty($username)){
            
            array_push($errors, "username is required");
        }
        if(empty($password)){
           
            array_push($errors,"password is required");
        }
        
        if(count($errors) == 0)
        {
            
        
            $sql = "select *from users where name = '$username' and password = '$password'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result); 

            if($count == 1){  
                // echo "<h1><center> Login successful </center></h1>"; 
                $_SESSION['name'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header("location:home.php?mes=<p class='error'>Registration Successfully .please login Here</p>"); 
            }  
            else{  
                echo "<p class='error'> Login failed. Invalid username or password.</p>";  
            }  
            
        
            }
            else{
            
            include 'error.php';

        }

       
    }
    


?>


    
</body>
</html>



