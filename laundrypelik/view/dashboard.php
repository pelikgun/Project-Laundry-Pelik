<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Laundry</title>
    <style>
        .welcome-message {
            background-color: #695cfe;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            margin-top: 200px;
            color: white;
        }

        .welcome-name {
            text-align: center;
        }

        .copyright {
                text-align: center;
        }

        /* .welcome-image {
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
        } */
    </style>
</head>
<body>
    <section class="home">
        <div class="welcome-message">
            <h1 class="welcome-name" >Selamat Datang di Pelik Laundry</h1>
            <p class="copyright">BERSIHKAN DAN SEGARKAN PAKAIAN ANDA !!!</p>
            <p class="copyright">Kami harap kami bisa memberikan kepuasan dan kenyamanan dalam pelayanan laundry kami.</p>
            <p class="copyright">Kualitas tinggi harga terjangkau.</p>
        </div>
        <?php if (isset($_SESSION['username'])): ?>
            <h2 class="welcome-name">Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
        <?php else: ?>
            <h2 class="welcome-name">Welcome Guest</h2>
        <?php endif; ?>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <h3 class="welcome-name" >Anda Adalah Admin</h3>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'cashier'): ?>
            <h3>Welcome Cashier</h3>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'owner'): ?>
            <h3>Welcome Owner</h3>
        <?php endif; ?>
        <p class="copyright">Copyright © 2023 Our Laundry</p>
    </section>
</body>
</html>