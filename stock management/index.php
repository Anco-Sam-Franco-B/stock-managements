<?php
    session_start();
    if(isset($_SESSION['admin_info'])){
        header("Location: dashboard.php");
    }
    include("./includes/configs/config.php");
    $page_title="Admin Login";
    include("./includes/pages/form/header.php");
?>

<div class="form">
    <div class="form-header">
        <div class="icon-admin">
            <i class="fas fab fa-user-tie admin-icon"></i>
        </div>
        <h1>Admin LogIn</h1>
    </div>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <div class="btn">
            <button name="login"><i class="fas fa-sign-in-alt"></i> &nbsp; Log In</button>
        </div>

        <?php
            if(isset($_POST['login'])){
                $username=$_POST['username'];
                $password=$_POST['password'];
                $HashPassword=md5($password);

                if($username && $password){
                    $checkAdmin_Cridentials=mysqli_query($con,"SELECT * FROM admin WHERE username='$username' AND password='$HashPassword'");
                    if(mysqli_num_rows($checkAdmin_Cridentials)>0){
                        $_SESSION['admin_info']=$username;
                        echo'
                        <script>
                            alert("Login Successfully!");
                            location.href="dashboard.php";
                        </script>
                    ';
                    }
                    else{
                        echo'
                        <script>
                            alert("Invalid Username and Password for admin!");
                        </script>
                    ';
                    }
                }
                else{
                    echo'
                    <script>
                        alert("All fields are required!");
                    </script>
                ';
                }
            }
        ?>
    </form>
</div>
<?php
    include("./includes/pages/form/footer.php");
?>