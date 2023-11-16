<?php include('koneksi.php');
session_start(); // Mulai sesi

$_SESSION['role'] = 'admin';

// Periksa apakah pengguna telah masuk. Jika tidak, arahkan ke halaman login.
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// Periksa peran pengguna. Jika bukan admin, arahkan ke halaman lain atau tampilkan pesan kesalahan.
if ($_SESSION['role'] !== 'admin') {
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/AZ.ico">
    <title></title>
    <link rel="stylesheet" href="../style/style2.css">
    <link rel="stylesheet" href="../style/style1.css">
</head>
<body>
    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <nav class="navbar">
            <a class="btn"  href="../views/index.php">home</a>
            <a class="btn" href="../views/index.php">about us</a>
            <a class="btn" href="../views/index.php">layanan</a>
            <?php if(!isset($_SESSION['login'])) {?>
                <a class="btn" href="../views/login.php">Login</a>
            <?php } else {?>
                <a class="btn" href="logout.php">Logout</a>

                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a href="dataorder.php" class="btn">Order</a>

                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                <?php endif ?>
            <?php } ?>
        </nav>
        
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>

        <div class="crud">
            <h1>  </h1>
            
                <div class="btn-kelola">
                    <button> <a href="index.php">Kembali</a> </button>
                    <button> <a href="tambahjasa.php">Tambah</a> </button>
                </div>
    

            <table>
                <thead>
                    <tr>
                        <th> No. </th>
                        <th> Gambar </th>
                        <th> Nama </th>
                        <th> Deskripsi </th>
                        <th> Harga </th>
                        <th colspan="2"> Kelola </th>
                    </tr>
                </thead>
                <?php 
                    if (isset($_GET["search"])) {
                        $keyword = $_GET["cari"];
                        
                    }
                    else {
                        $result = mysqli_query( 
                                    $koneksi, "SELECT * FROM produk");
                    }

                    $products = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $products[] = $row;
                    }
                    $i = 1; 
                    foreach ($products as $product):
                ?>
                <tr>
                    <td> <?php echo $i ;?> </td>
                    <td> <img src="../images/data_jasa/<?= $product["gambar"] ?>" width="100px" alt=""> </td>
                    <td> <?php echo $product['nama'] ;?> </td>
                    <td> <?php echo $product['deskripsi'] ;?> </td>
                    <td> Rp. <?php echo $product['harga'] ;?> </td>
                    <td>
                        <a href="edit_produk.php?id=<?php echo $product['id_jasa']; ?>">Edit &nbsp;&nbsp;&nbsp;&nbsp;</a>
                        &nbsp;
                        <a href="hapus_produk.php?id=<?php echo $product['id_jasa']; ?>" onclick="return confirm('Anda yakin ingin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php 
                    $i++; 
                    endforeach;
                ?>
            </table>
        </div>
    </div>    
</body>
<script text="text/javascript" src="../js/javascripts.js"></script>
</html>
