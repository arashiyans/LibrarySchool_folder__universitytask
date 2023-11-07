<?php
include('koneksi.php'); // Sertakan file koneksi.php atau sesuaikan dengan file koneksi Anda.

if (!isset($_GET['aksi'])) {
    // Bagian tampilan data peminjaman
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Peminjaman</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a type="button" class="btn btn-primary" href="index.php?page=peminjaman&aksi=tambah">Tambah</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>Kode Buku</th>
                            <th>ID Anggota</th>
                            <th>ID Petugas</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman");
                    $no = 1;
                    while ($data = mysqli_fetch_array($peminjaman)) {
                        ?>
                        <tr>
                            <td><?php echo $data['id_peminjaman']; ?></td>
                            <td><?php echo $data['kode_buku']; ?></td>
                            <td><?php echo $data['id_anggota']; ?></td>
                            <td><?php echo $data['id_petugas']; ?></td>
                            <td><?php echo $data['tgl_pinjam']; ?></td>
                            <td><?php echo $data['tgl_kembali']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td>
                                <a href="index.php?page=peminjaman&aksi=edit&id=<?php echo $data['id_peminjaman'] ?>">Edit</a> |
                                <a href="index.php?page=peminjaman&aksi=hapus&id=<?php echo $data['id_peminjaman'] ?>">Hapus</a>
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
    // Bagian tambah data peminjaman
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Peminjaman</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Tambah Peminjaman </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST" enctype='multipart/form-data'>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a">
                        <label>ID Peminjaman (E.g = 1)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b">
                        <label>Kode Buku</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c">
                        <label>ID Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="d">
                        <label>ID Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="e">
                        <label>Tanggal Pinjam</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="f">
                        <label>Tanggal Kembali</label>
                    </div>
                    <div class="form-floating mb-4">
                        <label for="status" class="visually-hidden">Status</label>
                        <select class="form-select" id="status" name="g">
                            <option value="" disabled selected> Pilih status </option>
                            <option value="Pengajuan">Pengajuan</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
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
        $id_peminjaman = $_POST['a'];
        $kode_buku     = $_POST['b'];
        $id_anggota    = $_POST['c'];
        $id_petugas    = $_POST['d'];
        $tgl_pinjam    = $_POST['e'];
        $tgl_kembali   = $_POST['f'];
        $status        = $_POST['g'];

        mysqli_query($koneksi, "INSERT INTO peminjaman (id_peminjaman, kode_buku, id_anggota, id_petugas, tgl_pinjam, tgl_kembali, status)
        VALUES('$id_peminjaman', '$kode_buku', '$id_anggota', '$id_petugas', '$tgl_pinjam', '$tgl_kembali', '$status')");

        echo "<script>window.alert('Sukses Menambahkan Data Peminjaman.');
            window.location='peminjaman'</script>";
    }
} elseif ($_GET['aksi'] == 'edit') {
    // Bagian edit data peminjaman
    $id_peminjaman = $_GET['id'];
    $peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman where id_peminjaman='$id_peminjaman'");
    $data = mysqli_fetch_array($peminjaman);
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Peminjaman</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Edit Peminjaman </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST" enctype='multipart/form-data'>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a" value="<?php echo $data['id_peminjaman']; ?>">
                        <label>ID Peminjaman</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b" value="<?php echo $data['kode_buku']; ?>">
                        <label>Kode Buku</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c" value="<?php echo $data['id_anggota']; ?>">
                        <label>ID Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="d" value="<?php echo $data['id_petugas']; ?>">
                        <label>ID Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="e" value="<?php echo $data['tgl_pinjam']; ?>">
                        <label>Tanggal Pinjam</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="f" value="<?php echo $data['tgl_kembali']; ?>">
                        <label>Tanggal Kembali</label>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="status" class="visually-hidden">Status</label>
                        <select class="form-select" id="status" name="g">
                            <option value="" disabled> Pilih Status </option>
                            <option value="Pengajuan" <?php if ($data['status'] === 'Pengajuan') echo 'selected'; ?>>Pengajuan</option>
                            <option value="Proses" <?php if ($data['status'] === 'Proses') echo 'selected'; ?>>Proses</option>
                            <option value="Selesai" <?php if ($data['status'] === 'Selesai') echo 'selected'; ?>>Selesai</option>
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
        $id_peminjaman = $_POST['a'];
        $kode_buku     = $_POST['b'];
        $id_anggota    = $_POST['c'];
        $id_petugas    = $_POST['d'];
        $tgl_pinjam    = $_POST['e'];
        $tgl_kembali   = $_POST['f'];
        $status        = $_POST['g'];

        mysqli_query($koneksi, "UPDATE peminjaman SET
            kode_buku = '$kode_buku',
            id_anggota = '$id_anggota',
            id_petugas = '$id_petugas',
            tgl_pinjam = '$tgl_pinjam',
            tgl_kembali = '$tgl_kembali',
            status = '$status'
            WHERE id_peminjaman = '$id_peminjaman'");

        echo "<script>window.alert('Sukses Update Data Peminjaman.');
            window.location='peminjaman'</script>";
    }
} elseif ($_GET['aksi'] == 'hapus') {
    // Bagian hapus data peminjaman
    $id_peminjaman = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM peminjaman where id_peminjaman='$id_peminjaman'");
    echo "<script>window.alert('Data Peminjaman Berhasil Dihapus.');
            window.location='peminjaman'</script>";
}
?>
