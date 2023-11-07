<?php
// Include your database connection code here
// Example: $koneksi = mysqli_connect("localhost", "username", "password", "database");

// Check if the 'aksi' parameter is not set (display the list of members)
if (!isset($_GET['aksi'])) {
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Anggota</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a type="button" class="btn btn-primary" href="index.php?page=anggota&aksi=tambah">Tambah Anggota</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID Anggota</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
                        $no = 1;
                        while ($data = mysqli_fetch_array($anggota)) {
                            ?>
                            <tr>
                                <td><?php echo $data['id_anggota']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo $data['password']; ?></td>
                                <td><?php echo $data['telp']; ?></td>
                                <td>
                                    <a href="index.php?page=anggota&aksi=edit&id=<?php echo $data['id_anggota'] ?>">Edit</a> |
                                    <a href="index.php?page=anggota&aksi=hapus&id=<?php echo $data['id_anggota'] ?>">Hapus</a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
} elseif ($_GET['aksi'] == 'tambah') {
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Anggota</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Tambah Anggota </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST" enctype='multipart/form-data'>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a">
                        <label>ID Anggota (E.g = 1)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b">
                        <label>Nama Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c">
                        <label>Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="d">
                        <label>Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="e">
                        <label>No. Telp</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-block" type="submit" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['simpan'])) {
        $id_anggota = $_POST['a'];
        $nama = $_POST['b'];
        $username = $_POST['c'];
        $password = $_POST['d'];
        $telp = $_POST['e'];

        mysqli_query($koneksi, "INSERT INTO anggota (id_anggota, nama, username, password, telp)
        VALUES('$id_anggota', '$nama', '$username', '$password', '$telp')");

        echo "<script>window.alert('Sukses Menambahkan Data Anggota.');
                window.location='anggota'</script>";
    }
} elseif ($_GET['aksi'] == 'edit') {
    $anggota = mysqli_query($koneksi, "SELECT * FROM anggota where id_anggota='$_GET[id]'");
    $data = mysqli_fetch_array($anggota);
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Anggota</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Update Anggota </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST" enctype='multipart/form-data'>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a" value="<?php echo $data['id_anggota']; ?>" readonly>
                        <label>ID Anggota (E.g = 1)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b" value="<?php echo $data['nama']; ?>">
                        <label>Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c" value="<?php echo $data['username']; ?>">
                        <label>Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="d" value="<?php echo $data['password']; ?>">
                        <label>Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="e" value="<?php echo $data['telp']; ?>">
                        <label>No. Telepon</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-block" type="submit" name="update">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['update'])) {
        $id_anggota = $_POST['a'];
        $nama = $_POST['b'];
        $username = $_POST['c'];
        $password = $_POST['d'];
        $telp = $_POST['e'];

        mysqli_query($koneksi, "UPDATE anggota SET
            nama = '$nama',
            username = '$username',
            password = '$password',
            telp = '$telp'
            WHERE id_anggota = '$_GET[id]'");
    
        echo "<script>window.alert('Sukses Update Data Anggota.');
                window.location='anggota'</script>";
    }
} elseif ($_GET['aksi'] == 'hapus') {
    // Handle the deletion of a member
    mysqli_query($koneksi, "DELETE FROM anggota WHERE id_anggota='$_GET[id]'");
    echo "<script>window.alert('Data Anggota Berhasil Di Hapus.');
                            window.location='anggota'</script>";
}
?>
