<?php

    include('pdoContect.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        
        $username = $_POST['user'];
        $pass = $_POST['pass'];
        
        $hashedpass = sha1($pass);

        echo $username;
        echo $pass;



        $stmt = $con->prepare("SELECT UserName, pass FROM users WHERE UserName = ? AND pass = ?");
        $stmt->execute(array($username, $hashedpass));
        $countRow = $stmt->rowCount();
        if ($countRow > 0) {
            $_SESSION['username'] = $username; //first
            header('Location: upload.php');
        } else {
            echo "<div style=' text-align: center; padding: 10px; background: red; color: white;'> كلمة المرور او اسم المستخدم خطأ </div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>تسجيل الدخول</title>
        <!-- <link rel="stylesheet" href="./css/login.css"> -->
    </head>
    <body>
        <h1>تسجيل الدخول</h1>
        <form action=" <?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
            <label for="user"> اسم المستخدم</label>
            <input type="text" name="user" id="user" placeholder="اسم المستخدم ">
            <label for="pass"> كلمة المرور</label>
            <input type="text" name="pass" id="pass" placeholder="كلمة المرور ">
            <input type="submit" value="دخول">
        </form>
        
    </body>
</html>