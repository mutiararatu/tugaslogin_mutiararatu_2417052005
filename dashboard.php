<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama'])) {
    header("Location: auth.php");
    exit;
}

if (isset($_GET['hapus'])) {

    if ($_SESSION['nama'] == 'admin') {

        $id = $_GET['hapus'];

        mysqli_query(
            $conn,
            "DELETE FROM users WHERE id='$id'"
        );

        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>

        body {
            margin: 0;
            background: #ececec;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 96%;
            height: 520px;
            margin: 10px auto;
            background: #f5f5f5;
            padding: 10px;
            box-sizing: border-box;
        }

        h2 {
            font-size: 18px;
            margin-top: 0;
        }

        .logout-btn {
            font-size: 11px;
            padding: 2px 6px;
        }

        h3 {
            font-size: 14px;
            margin-top: 15px;
        }

        table {
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }

        th, td {
            border: 1px solid black;
            padding: 4px 8px;
            text-align: center;
        }

        .aksi-btn {
            font-size: 10px;
            padding: 2px 5px;
        }

        .judul {
            text-align: center;
            font-size: 30px;
            margin-top: 20px;
        }

    </style>

</head>
<body>

<div class="container">

    <h2>
        Selamat Datang,
        <?php echo $_SESSION['nama']; ?>!
    </h2>

    <a href="logout.php">
        <button class="logout-btn">
            Logout
        </button>
    </a>

    <hr>

    <?php if ($_SESSION['nama'] == 'admin') : ?>

        <h3>Menu Admin: Kelola Pengguna</h3>

        <table>

            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>

            <?php
            $query = mysqli_query(
                $conn,
                "SELECT * FROM users"
            );

            while ($data = mysqli_fetch_assoc($query)) {
            ?>

            <tr>

                <td>
                    <?php echo $data['id']; ?>
                </td>

                <td>
                    <?php echo $data['nama']; ?>
                </td>

                <td>

                    <a href="edit.php?id=<?php echo $data['id']; ?>">
                        <button class="aksi-btn">
                            Edit
                        </button>
                    </a>

                    <a
                    href="dashboard.php?hapus=<?php echo $data['id']; ?>"
                    onclick="return confirm('Yakin hapus?')"
                    >
                        <button class="aksi-btn">
                            Hapus
                        </button>
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    <?php endif; ?>

</div>