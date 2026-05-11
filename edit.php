<?php
session_start();
include 'koneksi.php';

if (
    !isset($_SESSION['nama']) ||
    $_SESSION['nama'] != 'admin'
) {

    header("Location: dashboard.php");
    exit;
}

if (!isset($_GET['id'])) {

    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$id'"
);

$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {

    $nama = $_POST['nama'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    mysqli_query(
        $conn,
        "UPDATE users
         SET nama='$nama',
             password='$password'
         WHERE id='$id'"
    );

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>

    <style>

        body {
            margin: 0;
            background: #ececec;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 86%;
            height: 500px;
            margin: 35px auto;
            background: #f5f5f5;
            padding: 10px;
            box-sizing: border-box;
        }

        h2 {
            font-size: 18px;
            margin-top: 0;
        }

        label {
            font-size: 12px;
            font-weight: bold;
        }

        input {
            width: 130px;
            padding: 4px;
            margin-top: 4px;
            margin-bottom: 12px;
            font-size: 11px;
        }

        button {
            font-size: 11px;
            padding: 3px 8px;
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

    <h2>Edit Data Pengguna</h2>

    <form method="POST">

        <label>Nama Pengguna:</label>
        <br>

        <input
            type="text"
            name="nama"
            value="<?php echo $data['nama']; ?>"
            required
        >

        <br>

        <label>Password Baru:</label>
        <br>

        <input
            type="password"
            name="password"
            placeholder="Password baru"
            required
        >

        <br>

        <button
            type="submit"
            name="update"
        >
            Simpan Perubahan
        </button>

        <a href="dashboard.php">
            <button type="button">
                Batal
            </button>
        </a>

    </form>

</div>

</body>
</html>