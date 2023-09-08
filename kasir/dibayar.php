<?php 
$tgl_dibayar = date('Y-m-d');
    if($_GET['id_transaksi']){
        include "koneksi.php";
        $qry_ubah=mysqli_query($conn,"update transaksi set tgl_bayar='$tgl_dibayar', dibayar='dibayar' where id_transaksi='".$_GET['id_transaksi']."'");
        
        if($qry_ubah){
            echo "<script>alert('Sukses bayar transaksi');location.href='tampil_transaksi.php';</script>";
        } else {
            echo "<script>alert('Gagal bayar transaksi');location.href='tambah_transaksi.php';</script>";
        }
    }
?>