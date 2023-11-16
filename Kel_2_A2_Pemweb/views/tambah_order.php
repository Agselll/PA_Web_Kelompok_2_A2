<?php
session_start();
include 'koneksi.php';

$id_user = $_SESSION['id_user'];

$username = $_SESSION['username'];



$idService = $_GET["id"];

$queryService = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_jasa = $idService");

$dataService = mysqli_fetch_assoc($queryService);


if (isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $number_phone = $_POST['number_phone'];
    $jasa = $_POST['jasa'];
    $address = $_POST['address'];
    $date_order = $_POST['date_order'];

    $query = "INSERT INTO `order` (`id`, `id_akun` , `name`, `number_phone`, `address`, `jasa`, `date_order`) VALUES (NULL, $id_user , '$name',  '$number_phone', '$address', '$jasa','$date_order')";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Querry Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        echo "<script>document.location.href='dataorder.php';</script>";
    } else {
        echo "
        <script>
        alert('Berhasil Melakukan Pesanan!');
        document.location.href = 'dataorder.php';
        </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah_order</title>
    <link rel="stylesheet" href="../style/style1.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="responsive.css">
</head>


    <body>
    <!-- header section starts -->
    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="#about">about us</a>
            <a href="#layanan">layanan</a>
            <?php if(!isset($_SESSION['login'])) {?>
                <a href="../views/logout.php">Logout</a>
            <?php } else {?>
                <!-- <a href="logout.php">Logout</a> -->

                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a href="data_order.php" class="btn">Order</a>
                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                    <a href="data.php" class="btn">Data</a>
                <?php endif ?>
            <?php } ?>
        </nav>
        
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>

    <center><h1>Tambah Order</h1></center>

    <form method="POST" action="" enctype="multipart/form-data">
    <section class="base">
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?= $username ?>" readonly required="" />
            <input type="hidden" name="id_user" value="<?= $id_user ?>"> 
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" autofocus="" required="" /> 
        </div>
        <div>
            <label>Number Phone</label>
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="10" maxlength="13" name="number_phone" />
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="address" required="" />
        </div>
        <div>
            <label>Date Order</label>
            <input type="date" name="date_order" required="" />
        </div>
        <div>
            <label>Jasa</label>
            <input type="text" value="<?= $dataService["nama"] ?>" name="jasa" readonly required="" />
        </div>
    </form>
    <div>
        <button type="submit" name="submit">Simpan Produk</button>
        <a href="../views/index.php" class="btn-back">Batalkan Pesanan</a>
    </div>
</section>

    <script>
            const icon = document.getElementById("icon");
            icon.addEventListener("click", function () {
                document.body.classList.toggle("dark-theme");
                    if (document.body.classList.contains("dark-theme")) {
                            icon.src = "../images/sun.png";
                    } else {
                            icon.src = "../images/moon.png";
                    }
            });
    </script>
</body>
</html>