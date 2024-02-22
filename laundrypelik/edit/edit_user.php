<?php
session_start();
$role = @$_SESSION['role'];

if (!@$_SESSION['username']) {
    echo "<script>alert('Login First!');window.location.href='login.php'</script>";
} else if ($role == 'kasir' || $role == 'owner') {
    echo "<script>alert('Locked Access! | Your role cannot access this page.');window.location.href='../'</script>";
} else {
    include_once '../koneksi.php';

    $id = $_GET['id'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../assets/img/logo.svg" type="image/x-icon">
        <link rel="stylesheet" href="../css/edit_user.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
        <title>Edit Password</title>
    </head>

    <body>
        <form action="proses_edit_user.php?id=<?= $id ?>" method="post">
            <div class="container">
                <div class="box">
                    <span class="title">PASSWORD</span>
                    <div class="input-data">
                        <i class="ri-lock-2-fill"></i>
                        <input type="password" name="password" id="" placeholder="New Password" autocomplete="off" required>
                    </div>
                    <div class="box-btn">
                        <a href="../index.php?page=User" class="cancel-btn">CANCEL</a>
                        <button class="submit-btn">SUBMIT</button>
                    </div>
                </div>
            </div>
        </form>
    </body>

    </html>
<?php
}
?>