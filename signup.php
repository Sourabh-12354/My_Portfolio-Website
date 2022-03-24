<?php

    $host ="localhost";
    $port=3306;
    $username="root";
    $password="";

    try 
    {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=userdata", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    function save_Info()
    {
        $sql = "INSERT INTO user_info(first_name, last_name, email, phone_number, dob, pass, sequrity_question) VALUES('".addslashes($_POST['firstname'])."','".addslashes($_POST['lastname'])."','".addslashes($_POST['email'])."', '".addslashes($_POST['number'])."', '".addslashes($_POST['dob'])."','".addslashes($_POST['password'])."','".addslashes($_POST['sequrity_answer'])."')";
        $GLOBALS['conn']->query($sql);
        echo '<script>alert("Sign Up Sccessfully");</script>';
    }
    if(isset($_POST['submit']))
    {   
        //Count id from database where id is primary key
        $count = $conn->query('select count(*) FROM user_info WHERE id')->fetchColumn(); 
        //echo $count;
        if($count>0)
        {
            //select all information from databse
            $sql = "SELECT * FROM `user_info`";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll();
            $cnt = 0;
        //condition check if any user has same email,firstname or phone_number.
            foreach ($users as $user) 
            {
                if ($user['first_name'] == $_POST['firstname']) 
                {
                    echo '<script>alert("there is a user by this username");</script>';
                    $cnt++;
                }
                if ($user['email'] == $_POST['email']) 
                {
                    echo '<script>alert("there is a user by this email");</script>';
                    $cnt++;
                }
                if ($user['phone_number'] == $_POST['number'])
                {
                    echo '<script>alert("there is a user by this phone_number");</script>';
                    $cnt++;
                }
            }
            if($cnt>0)
            {
                echo '<script>alert("there is a alredy user registerd!!");</script>';
            }
            else
            {
                save_Info();
            }
            
        }
        
        else{
           save_Info();
        }
    }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="signup.css"></link>
</head>
<body>
    <form action="" method="post">
        <h2>Sign Up</h2>
        <label id="lbl-name">First Name:</label><br>
        <input type="text" name="firstname" class="fname" required="" autocomplete="off"  placeholder="Enter First Anme:"><br>
        <label class="placeholder">Last Name:</label><br>
        <input type="text" name="lastname" class="lname" required="" autocomplete="off"  placeholder="Enter Last Name:"><br>
        <label class="placeholder">Email:</label><br>
        <input type="email"    name="email" class="email" required="" autocomplete="off"  placeholder="Enter Email Address:"><br>
        <label class="placeholder">Phone:</label><br>
        <input type="number"   name="number" class="number" required="" autocomplete="off"  placeholder="Enter Phone Number:"><br>
        <label class="placeholder">Date Of Birth:</label><br>
        <input type="date" name="dob" class="date" required="" autocomplete="off"><br>
        <label class="placeholder">Password:</label><br>
        <input type="password" name="password" class="password" autocomplete="off"  placeholder="Type A Password"><br>
        <h3>Security Question:</h3>
        <select name="security" id="security">
            <br>
            <option value="">Which is First School</option>
            <option value="">Best Friend Name:</option>
            <option value="">Childhood Name:</option>
        </select><br>
        <input type="text" name="sequrity_answer" class="answer" autocomplete="off" placeholder="Write Question Answer:"><br>
        <input type="submit" name="submit" value="Register" id="register">
    </form>
</body>
</html> -->