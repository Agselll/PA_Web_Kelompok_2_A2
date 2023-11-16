<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="../style/detail-produk.css">
    <link rel="stylesheet" href="../style/tambahjasa.css">
    <link rel="stylesheet" href="../style/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <nav class="navbar">
            <a class="btn" href="../views/index.php">home</a>
            <a class="btn" href="../views/index.php">about us</a>
            <a class="btn" href="../views/index.php">layanan</a>
            <?php if(!isset($_SESSION['login'])) {?>
                <a class="btn" href="../views/logout.php">Logout</a>
            <?php } else {?>

                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a href="dataorder.php" class="btn">Order</a>
                    <a href="kritiksaran.php" class="btn">Kritik & Saran</a>
                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                <?php endif ?>
            <?php } ?>
        </nav>
        
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>

    <div class="segitiga-bergerak">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
    </div>

    <main>
    <?php
        include('../views/koneksi.php');
        $id = $_GET['id'];
        $result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_jasa = $id");
        $data_produk = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_produk[] = $row;
        }
        foreach ($data_produk as $produk)
        ?>
        <div class="home">
        <div class="container">
            <div class="product-div">
                <div class = "product-div-left">
                    <div class = "img-container">
                        <img src = "../images/data_jasa/<?php echo $produk['gambar']?>" alt = "Item 1">
                    </div>
                </div>
                <div class = "product-div-right">
                    <span class = "product-name"><?php echo $produk['nama'];?></span>
                    <span class = "product-price">Rp <?php echo number_format($produk['harga'],0,'.','.');?></span>
                    <span class = "product-description">Deskripsi : <?php echo $produk['deskripsi'];?></span>
                    <a href="tambah_order.php?id=<?php echo $produk['id_jasa'] ?>" class="btn-produk">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </main>
        </div>
        
</body>
<script text="text/javascript" src="../js/javascripts.js"></script>
</html>