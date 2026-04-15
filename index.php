<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if($data){
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['email'] = $data['email'];

        header("Location:dashboard.php");
    }else{
        $error = "Email atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login UBSI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: url('https://share.google/Vw5SwqHK0jjGrKXyP') no-repeat center center/cover;
    height:100vh;
    margin:0;
}

/* overlay gelap */
.overlay{
    background: rgba(0,0,0,0.6);
    position:fixed;
    width:100%;
    height:100%;
    top:0;
    left:0;
}

/* container */
.login-container{
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
    z-index:2;
}

/* box login */
.login-box{
    background: rgba(255,255,255,0.95);
    padding:50px;
    border-radius:15px;
    width:350px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    text-align:center;
    backdrop-filter: blur(5px);
}

/* form */
.login-form{
    background:white;
    padding:25px;
    border-radius:10px;
    margin-top:20px;
}

/* tombol */
.btn-login{
    background:#2d6ca2;
    color:white;
    border:none;
}
.btn-login:hover{
    background:#1f4e7a;
}

/* logo */
.logo{
    width:70px;
    margin-bottom:10px;
}

</style>

</head>
<body>

<div class="overlay"></div>

<div class="login-container">

<div class="login-box">

<!-- LOGO UBSI -->
<img src="upload/logo-bsi.png" class="logo">

<h4 class="fw-bold">UBSI</h4>
<small>Sistem Kalender Event Kampus</small>

<div class="login-form">

<h6 class="mb-3">Login Admin</h6>

<?php if(isset($error)){ ?>
<div class="alert alert-danger"><?php echo $error ?></div>
<?php } ?>

<form method="POST">

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button class="btn btn-login w-100" name="login">LOGIN</button>

</form>

</div>

</div>

</div>

</body>
</html> 