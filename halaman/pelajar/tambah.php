      <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tambah pelajar</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="?halaman=pelajar">Pelajar</a></li>
                            <li class="active">Tambah pelajar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
            <div class="content mt-3">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data pelajar</strong>
                            </div>
                            <div class="card-body card-block">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class=" form-control-label">NIS</label>
                                                <input name="nis" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Nama</label>
                                                <input name="nama" type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Surel</label>
                                                <input name="surel" type="email" class="form-control" required>
                                            </div>
                                    </div>
                                    <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class=" form-control-label">Telp</label>
                                                <input name="notelp" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Foto</label>
                                                <input name="foto" type="file" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Status</label>
                                                    <select name="status" class="form-control" required>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Nonaktif">Nonaktif</option>
                                                    </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class=" form-control-label">Kata sandi</label>
                                                <input name="pass" type="password" class="form-control">
                                            </div>
                                    </div>
                            </div>
                                    <div class="card-footer">
                                            <button name="simpan" type="submit" class="btn btn-primary btn-sm">
                                              <i class="fa fa-dot-circle-o"></i> Simpan
                                            </button>
                                          </div>
                                    </div>
                                </form>
<?php
if(isset($_POST['simpan'])){
    $nis        = $_POST['nis'];
    $nama       = $_POST['nama'];
    $surel      = $_POST['surel'];
    $telp       = $_POST['notelp'];
    $poin       = "0";
    $status     = $_POST['status'];
    $pass       = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $foto       = $_FILES['foto']['name'];
    $file       = $_FILES['foto']['tmp_name'];
    $size       = $_FILES['foto']['size'];
    $tipe       = $_FILES['foto']['type'];
    $folder     = "gambar/profil/pelajar/";
    $saring     = array('gif','png' ,'jpg');
    if (strlen($foto)){
        // Cek format foto.
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        if(in_array($ext, $saring)){
            // Cek ukurannya.
            // 5242880 = 5MB.
            if($size<5242880){
                // Encrypt nama jadi hash sha1.
                $img     = sha1($foto);
                // Mencoba upload & jika berhasil di upload
                if(move_uploaded_file($file, $folder.$img)){
                    $koneksi->query("INSERT INTO tb_pelajar (nis_pelajar, nama_pelajar, pass_pelajar,
                    telp_pelajar, surel_pelajar, foto_pelajar, status_pelajar, poin_pelajar)
                    VALUES('$nis', '$nama', '$pass', '$telp', '$surel', '$img', '$status', '$poin')");
                    ?>
                    <script type="text/javascript">
                    alert("Berhasil memperbarui data pelajar");
                    window.location.href = "?halaman=pelajar";
                    </script>
                    <?php
                }else{
                    // Jika gagal di upload.
                    ?>
                    <script type="text/javascript">
                    alert("Error!");
                    </script>
                    <?php
                }
            }else{
                // Jika gambar melebihi ukuran yang ditentukan.
                ?>
                <script type="text/javascript">
                alert("Ukuran gambar terlalu besar! (Max : 5MB)");
                </script>
                <?php
            }
        }else{
            // Jika format gambar tidak sesuai dengan $saring
            ?>
            <script type="text/javascript">
            alert("Format gambar tidak dizinkan!");
            </script>
            <?php
        }
    }else{
        // Jika tidak ada foto.
        ?>
        <script type="text/javascript">
        alert("Fotonya mana ?!");
        </script>
        <?php
    }
}
?>