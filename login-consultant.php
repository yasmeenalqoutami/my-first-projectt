<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
  /* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-image:url("12.jpeg");
    height: 100%;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container {
    display: flex;
    width: 100%;
    max-width: 1000px;
    position: absolute;
    left:0;
    padding: 90px;

}

.left-column {
    flex: 1;
    padding: 40px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.form-container {
    max-width: 400px;
    margin: 0 auto;
}

h2 {
    color: #2c2c2c;
    margin-bottom: 10px;
}

p {
    color: #555;
    margin-bottom: 20px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    outline: none;
}

button {
    width: 100%;
    padding: 15px;
    background:rgb(59, 67, 186);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background:rgb(34, 163, 255);
}

a {
    display: block;
    margin-top: 20px;
    color: #ff6f00;
    text-decoration: underline;
}

.right-column {
    flex: 1;
    position: relative;
    overflow: hidden;
}

.trophy {
    width: 80%;
    max-width: 400px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    filter: drop-shadow(0 0 10px #ff6f00);
}

.floating-icons {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
}

.icon {
    position: absolute;
    animation: float 5s infinite ease-in-out;
}

.icon1 {
    width: 50px;
    top: 20%;
    left: 10%;
}

.icon2 {
    width: 30px;
    top: 40%;
    right: 20%;
}

/* Add more icon styles as needed */

.activate-text {
    position: absolute;
    bottom: 20px;
    right: 20px;
    color: white;
    text-align: right;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .left-column,
    .right-column {
        flex: 1;
        padding: 20px;
    }

    .trophy {
        width: 60%;
    }
}

@keyframes float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0); }
}
</style>
<body>
    <div class="container">
        <!-- Left Column (Form) -->
        <div class="left-column">
            <div class="form-container">
                <h2>Hey, welcome back!</h2>
                <p>Login to your Smoker account</p>
                <form action="#" method="post">
                    <input type="text" placeholder="Name*" name="cName" required>
                    <input type="password" placeholder="Password*" name="cPassword" required>
                    <button type="submit" name="Submit">Log in</button>
                </form>
                <?php 
                session_start();
                if(isset($_POST["Submit"]))
                {
                  Include 'config.php';
                    $uname = mysqli_real_escape_string($conn,$_POST['cName']);
                    $password = mysqli_real_escape_string($conn,$_POST['cPassword']);
                
                    if ($uname != "" && $password != ""){
                
                        $sql_query = "SELECT count(*) as cntUser from `consultant` WHERE `cName` ='".$uname."' and `cPassword` ='".$password."'";
                        $result = mysqli_query($conn,$sql_query);
                        $row = mysqli_fetch_array($result);
                
                        $count = $row['cntUser'];
                
                        $res = mysqli_query($conn,$sql_query);
                        if($count > 0){
                            $_SESSION['consultant'] = $uname;
                            header('Location: pages/chatwithuser.php');
                        }
                        else
                        {
                            ?>
                            <script>
                            alert("Error Please Try Again ...!");
                            </script>
                            <?php 
                        }
                
                    }
                }
            ?>
                <!-- <a href="#">Forgot password? Click here...</a> -->
            </div>
        </div>

        <!-- Right Column (Trophy & Graphics) -->
        <div class="right-column">
        </div>
    </div>
</body>
</html>