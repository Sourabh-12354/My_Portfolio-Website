<?php
    $emailErr="";
    $passErr="";
    if(isset($_POST['submit']))
    {
        if(empty($_POST['email']))
        {
            $emailErr ="* Email can't empty!";
        }
        if(empty($_POST['password']))
        {
            $passErr ="* Password can't empty!";
        }
        else
        {   

            $host ="localhost";
            $username="root";
            $password="";
            $host="localhost";
            $port=3306;

            try 
            {
                $conn = new PDO("mysql:host=$host;port={$port};dbname=userdata", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }

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
                    
                    if ($user['email'] != $_POST['email']) 
                    {
                        //echo '<script>alert("User email is incorrect!!");</script>';
                        $cnt++;
                    }
                    if ($user['pass'] != $_POST['password'])
                    {
                        //echo '<script>alert("User password is incorrect!!");</script>';
                        $cnt++;
                    }
                    if(($user['email']==$_POST['email']) && ($user['pass'] == $_POST['password']))
                    {
                        echo '<script>alert("Login Successfully!!");</script>';
                        $cnt=0;
                        break;
                        
                    }

                }
                if($cnt>0)
                {
                    echo '<script>alert("User email/password is incorrect!!");</script>';
                }
                
            }
            else{
                echo '<script>alert("Account is not yet registered.Please Register first!!");</script>';
            }
        }
    }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login">
        <form action="" method="POST">
            <img src="images/Google (2).png" alt="Google" >
            <h1>Sign In</h1>
            <legend>Use Your Google Account</legend>
            <br>
            <label for="email" id="email_label">Email:</label>
            <input type="email" name="email" id="email" placeholder="someone@gmail.com">
            <span><?php echo $emailErr;?></span></br></br>
            <label id="password_label" for="password">Password:</label>
            <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password.."/>
            <span><?php echo $passErr;?></span></br><br>
            <input type="submit" id="login" name="submit" value="Login"></br></br>
            <p>Haven't Any Account.Register here. <span><input type="button" onclick="location.href='signup.php';" id ="signup" value="Register" /></span></p>
            
        </form>
    </div>
</body>
</html> -->