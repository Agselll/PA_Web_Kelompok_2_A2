<?php
include('koneksi.php');
$id = $_GET['id'];

// Mengambil data produk berdasarkan id
$query = "SELECT * FROM `order` WHERE `id` = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $number_phone = $_POST['number_phone'];
    $address = $_POST['address'];
    $product = $_POST['product'];

    $query = "UPDATE `order` SET `name`='$name', `number_phone`='$number_phone', `address`='$address', `jasa`='$product' WHERE `id`=$id";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        echo "<script>document.location.href='data.php'</script>";
    } else {
        echo "<script>alert('Data berhasil diperbarui!');document.location.href='data.php';</script>";
    }
        
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit_produk</title>
    <link rel="stylesheet" href= "../style/style1.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="responsive.css">
    <style>
            .hapus-gambar-checkbox {
        display: inline-block;
        align-items: left;
        width:30px;
    }
    </style>
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

<center><h1>Edit Order</h1></center>
<form method="POST" action="" enctype="multipart/form-data">
<section class="base">
        <div>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $data['name']  ?>" autofocus="" required="" /> 
        </div>
        <div>
            <label>Number Phone</label>
            <input type="text" name="number_phone" value="<?php echo $data['number_phone']  ?>" />
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $data['address']  ?>" required="" />
        </div>
        <div>
            <label>Product</label>
            <input type="text" name="product" value="<?php echo $data['jasa']  ?>" readonly required="" />
        </div>
        <div>
            <button type="submit" name="submit">Simpan Data</button>
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

