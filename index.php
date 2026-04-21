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
$_SESSION['nama'] = $data['nama'];   // WAJIB
$_SESSION['role'] = $data['role'];   // kalau ada kolom role
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>
<body class="login-page">

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