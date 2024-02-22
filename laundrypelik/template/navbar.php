<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="images/1.png" alt="">
                </span>
                <div class="text logo-text">
                    <span class="name">Laundry</span>
                    <span class="profession">Pelik Company</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <?php
                if(@$_SESSION['role']=='admin'){
                ?>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="index.php?page=Dashboard">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Outlet">
                            <i class='bx bxs-store icon'></i>
                            <span class="text nav-text">Outlet</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Paket">
                            <i class='bx bx-package icon'></i>
                            <span class="text nav-text">Package</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Pelanggan">
                            <i class='bx bx-male-female icon'></i>
                            <span class="text nav-text">Pelanggan</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Transaksi">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Transaction</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=User">
                            <i class='bx bxs-user-detail icon'></i>
                            <span class="text nav-text">User</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="index.php?page=Laporan">
                            <i class='bx bxs-report icon'></i>
                            <span class="text nav-text">Report</span>
                        </a>
                    </li>
                    <?php
                    }elseif(@$_SESSION['role']=='kasir') {
                    ?>
                    <li class="nav-link">
                        <a href="index.php?page=Pelanggan">
                            <i class='bx bx-male-female icon'></i>
                            <span class="text nav-text">Pelanggan</span>
                        </a> 
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Transaksi">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Transaction</span>
                        </a>
                    </li>
                    <?php
                    }else{
                    ?>
                    <li class="nav-link">
                        <a href="index.php?page=Laporan">
                            <i class='bx bxs-report icon'></i>
                            <span class="text nav-text">Report</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <!-- ... (your existing code) ... -->

            <div class="bottom-content">
                <li class="nav-link">
                        <i class='bx bxs-user icon'></i>
                        <span class="profile-name"><?=$_SESSION['username']?></span>
                        <br> 
                        <span class="profile-role"><?=$_SESSION['role']?></span>
                </li>
                <li class="">
                    <a href="logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <!-- ... (remaining code) ... -->
            </div>

            <!-- ... (remaining code) ... -->

        </div>
    </nav>
</body>

</html>