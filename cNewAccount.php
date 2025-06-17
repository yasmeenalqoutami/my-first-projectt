<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Account</title>
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
    background-image:url("2.jpeg");
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
    background:rgba(14, 104, 0, 0.99);
        color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background:rgb(53, 175, 78);
}

a {
    display: block;
    margin-top: 20px;
    color:rgba(14, 104, 0, 0.99);
    text-decoration: underline;
}
a:hover {
    color:rgb(53, 175, 78);
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
                <p>Register New Account</p>
                <form action="#" method="post">
                <input type="text" placeholder="First Name*" name="fname" required>
                <input type="text" placeholder="Last Name*" name="lname" required>
                <input type="text" placeholder="username*" name="username" required>
                <input type="text" placeholder="Email*" name="uEmail" required>
                <input type="text" placeholder="Phone*" name="uPhone" required>
                <input type="password" placeholder="Password*" name="password" required>
                <button type="submit" name="Submit">Register</button>
                </form>
                <?php
                // تضمين ملف الاتصال بقاعدة البيانات
                include 'config.php';

                // التحقق من تقديم النموذج
                if (isset($_POST["Submit"])) {
                    // استقبال البيانات وإزالة الأكواد الضارة
                    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
                    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
                    $uPhone = mysqli_real_escape_string($conn, $_POST['uPhone']);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // تخزين كلمة المرور بشكل آمن

                    // التحقق من وجود اسم المستخدم
                    $check = mysqli_query($conn, "SELECT COUNT(*) AS count FROM `user` WHERE `uName` = '$username'");
                    $row = mysqli_fetch_assoc($check);

                    if ($row['count'] > 0) {
                        ?>
                        <script>
                            alert("عذرًا، اسم المستخدم هذا موجود بالفعل.");
                        </script>
                        <?php
                    } else {
                        // إدراج البيانات في قاعدة البيانات
                        $query = mysqli_query($conn, "INSERT INTO `user` (FirstName, LastName, uName, uEmail, uPhone, uPassword) 
                                                    VALUES ('$fname', '$lname', '$username', '$uEmail', '$uPhone', '$password')");

                        if ($query) {
                            echo "<script>
                                    alert('تم التسجيل بنجاح');
                                    window.location.href='login.php';
                                </script>";
                            exit();
                        } else {
                            $error = "حدث خطأ أثناء التسجيل. الرجاء المحاولة مرة أخرى.";
                        }
                    }
                }
                ?>
                <a href="Login.php">I Have account? Click here...</a>
            </div>
        </div>

        <!-- Right Column (Trophy & Graphics) -->
        <div class="right-column">
        </div>
    </div>
</body>
</html>