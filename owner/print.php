<?php
session_start();
if ($_SESSION['status_login'] != true) {
  header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Hasil Transaksi Laundry</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }

        .tengah {
            text-align: center;
        }
    </style>
    <table>
        <tr text-align="center">
            Laporan Hasil Transaksi Laundry
        </tr>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jenis Paket</th>
            <th>QTY</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
        <?php
        include "koneksi.php";

        $data = mysqli_query($conn, "select * from transaksi");
        while ($data_transaksi = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td style='text-align: center;'><?php echo $data_transaksi['id_transaksi'] ?></td>
                <?php
                $qry_member = mysqli_query($conn, "select * from transaksi join member on member.id_member=transaksi.id_member where id_transaksi= '" .$data_transaksi['id_transaksi'] . "'");
                $data_member = mysqli_fetch_array($qry_member);
                ?>
                <td><?php echo $data_member['nama']; ?></td>
                <?php
                $qry_paket = mysqli_query($conn, "select * from transaksi join paket on paket.id_paket=transaksi.id_paket where id_transaksi='" . $data_transaksi['id_transaksi'] . "'");
                $data_paket = mysqli_fetch_array($qry_paket);
                ?>
                <td><?php echo $data_paket['jenis']; ?></td>
                <td><?php echo $data_transaksi['qty']; ?></td>
                <td><?php echo $data_transaksi['tgl']; ?></td>
                <td><?php echo $data_transaksi['status']; ?> </td>
                <?php
                $total = $data_transaksi['qty'] * $data_paket['harga'];
                ?>
                <td>Rp <?=$total?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>