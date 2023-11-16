<?php
include 'koneksi.php';
  
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar = $_FILES["gambar"]["name"];
    $tmp_name = $_FILES["gambar"]["tmp_name"];
    
    $ekstensi_diperbolehkan = array('png', 'jpg');
    $ekstensigmbr = explode(".", $gambar);
    $ekstensigmbr = strtolower(end($ekstensigmbr));

    if(in_array($ekstensigmbr,$ekstensi_diperbolehkan) === true){
        $nm_gambar = date('Y-m-d');
        $nm_gambar .= ".";
        $nm_gambar .= strtolower($name) . "-file";
        $nm_gambar .= ".";
        $nm_gambar .= $ekstensigmbr;
    
        move_uploaded_file($tmp_name,'../images/data_jasa/'.$nm_gambar);
    
        $query = "INSERT INTO `produk` (`id_jasa`, `nama`, `deskripsi`, `harga` , `gambar`) VALUES (NULL,'$name', '$deskripsi', $harga , '$nm_gambar')";
        $result = mysqli_query($koneksi, $query);
    
        if (!$result) {
            die("Querry Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            echo "<script>document.location.href='kelola_jasa.php';</script>";
        } else {
            echo "<script>alert('Data berhasil ditambahkan!);</script>";
            echo "<script>document.location.href='kelola_jasa.php'</script>";
        }
    } else {
        echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png!');document.location.href='tambahjasa.php;</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah_jasa</title>
    <link rel="stylesheet" href= "../style/style1.css">
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="style2.css"> -->
    <link rel="stylesheet" href="responsive.css">
</head>


    <body>
    <!-- header section starts -->
    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about us</a>
            <a href="#layanan">layanan</a>
            <?php if(!isset($_SESSION['login'])) {?>
                <a href="../views/login.php">Login</a>
            <?php } else {?>
                <a href="logout.php">Logout</a>

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

    <center><h1>Tambah Jasa</h1></center>
    <form method="POST" action="" enctype="multipart/form-data">
    <section class="base">
        <div>
            <label>Nama Jasa</label>
            <input type="text" name="name" autofocus="" required="" /> 
        </div>
        <div>
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" />
        </div>
        <div>
            <label>Harga</label>
            <input type="number" min="100000" max="1000000" name="harga" />
        </div>
        <div>
            <label>Gambar</label>
            <input type="file" name="gambar" required="" />
        </div>
        <div>
            <button type="submit" name="submit">Simpan Jasa</button>
        </div>
    </section>
    </form>

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