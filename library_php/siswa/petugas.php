<?php 
if (!isset($_GET['aksi'])){
?>
    <div class="container-fluid px-4">
                <h1 class="mt-4">Data Petugas</h1>                      
                <div class="card mb-4">
                    <div class="card-header">
                        <a type="button" class="btn btn-primary" href="index.php?page=petugas&aksi=tambah">Tambah Anggota</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID Petuggas</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Telepon</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $petugas=mysqli_query($koneksi, "SELECT * FROM petugas");
                            $no = 1;
                            while ($data = mysqli_fetch_array($petugas)){
                            ?>
                                <tr>
                                    <td><?php echo $data['id_petugas']; ?></td>
                                    <td><?php echo $data['nama_petugas']; ?></td>
                                    <td><?php echo $data['username']; ?></td>
                                    <td><?php echo $data['password']; ?></td>
                                    <td><?php echo $data['telp']; ?></td>
                                    <td><?php echo $data['level']; ?></td>
                                    <td><a href="index.php?page=petugas&aksi=edit&id=<?php echo $data['id_petugas'] ?>">Edit</a> | 
                                        <a href="index.php?page=petugas&aksi=hapus&id=<?php echo $data['id_petugas'] ?>">Hapus</a></td>
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
}elseif ($_GET['aksi']=='tambah'){     
    ?>
    <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Petugas</h1>                      
                    <div class="card mb-4 col-md-8">
                        <div class="card-header">
                           <h5> Tambah Petugas </h5>
                        </div>
                        <div class="card-body">
                            <form action=''  method="POST" enctype='multipart/form-data'>                        
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" name="a">
                                        <label>ID Petugas (E.g = 99)</label>                                
                                    </div>                            
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" name="b">
                                        <label>Nama Petugas</label>
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
                                        <label>Telepon</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <label for="status" class="visually-hidden">Level</label>
                                        <select class="form-select" id="status" name="f">
                                            <option value="" disabled selected> Pilih Level </option>
                                            <option value="admin">Admin</option>
                                            <option value="petugas">Petugas</option>
                                        </select>
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
    $id_petugas   = $_POST['a'];
    $nama_petugas = $_POST['b'];
    $username     = $_POST['c'];
    $password     = md5($_POST['d']);
    $telp         = $_POST['e'];
    $level        = $_POST['f'];

    mysqli_query($koneksi, "INSERT INTO petugas (id_petugas, nama_petugas, username, password, telp, level)
    VALUES('$id_petugas', ' $nama_petugas', '$username', '$password', '$telp', '$level ')");

    echo "<script>window.alert('Sukses Menambahkan Data Petugas.');
            window.location='petugas'</script>";
}
}elseif ($_GET['aksi']=='edit'){
    $petugas = mysqli_query($koneksi, "SELECT * FROM petugas where id_petugas='$_GET[id]'");
    $data = mysqli_fetch_array($petugas);       
?>
<div class="container-fluid px-4">
                <h1 class="mt-4">Data Petugas</h1>                      
                <div class="card mb-4 col-md-8">
                    <div class="card-header">
                       <h5> Update Petugas </h5>
                    </div>
                    <div class="card-body">
                        <form action=''  method="POST" enctype='multipart/form-data'>      
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="a" value="<?php echo $data['id_petugas']; ?>">
                                <label>ID Petugas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="b" value="<?php echo $data['nama_petugas']; ?>">
                                <label>Nama Petugas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="c" value="<?php echo $data['username']; ?>">
                                <label>Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="d" value="<?php echo $data['password']; ?>">
                                <label>Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="e" value="<?php echo $data['telp']; ?>">
                                <label>No. Telp</label>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="status" class="visually-hidden">Level</label>
                                <select class="form-select" id="status" name="f">
                                    <option value="" disabled> Pilih Level </option>
                                    <option value="admin" <?php if ($data['level'] === 'admin') echo 'selected'; ?>>Admin</option>
                                    <option value="petugas" <?php if ($data['level'] === 'petugas') echo 'selected'; ?>>Petugas</option>
                                </select>
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
    $id_petugas   = $_POST['a'];
    $nama_petugas = $_POST['b'];
    $username     = $_POST['c'];
    $password     = md5($_POST['d']);
    $telp         = $_POST['e'];
    $level        = $_POST['f'];

    mysqli_query($koneksi, "UPDATE petugas SET
        nama_petugas = '$nama_petugas',
        username = '$username',
        password = '$password',
        telp = '$telp',
        level = '$level'
        WHERE id_petugas = '$_GET[id]'");

    echo "<script>window.alert('Sukses Update Data Petugas.');
            window.location='petugas'</script>";
}
}elseif ($_GET['aksi']=='hapus'){ 
	mysqli_query($koneksi, "DELETE FROM petugas where id_petugas='$_GET[id]'");
	echo "<script>window.alert('Data Petugas Berhasil Di Hapus.');
                                window.location='petugas'</script>";
}
?>