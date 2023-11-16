
<?php include('koneksi.php');
    $id = $_GET['id'];
    $query = "DELETE FROM produk where id_jasa ='$id'";
    $result = mysqli_query($koneksi, $query);

    if(!$result) {
        die("Querry Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        echo"<script>document.location.href='kelola_jasa.php'</script>";

    } else {
        echo "<script>alert('Data berhasil dihapus!);</script>";
        echo"<script>document.location.href='kelola_jasa.php'</script>";
    }

?>