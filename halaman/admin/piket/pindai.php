<?php
    $pindai = (float) $_GET['nis'];
    $sql    = $koneksi->query("SELECT * FROM tb_pelajar WHERE nis_pelajar = '$pindai'");
    $x      = $sql->fetch_assoc();
    $id     = $x['id_pelajar'];
    // NIS bisa diganti dari URL nya.
    // Cek nis lagi.
    $cek    = $sql->num_rows;
    // Jika nis tidak ditemukan.
    if($cek == 0){
        ?>
        <script type="text/javascript">
        window.location.href="?halaman=piket";
        </script>
        <?php
    }
?>
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Piket</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="?halaman=piket">Piket</a></li>
                            <li class="active">Pelajar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong class="card-title">Data pelajar</strong>
                             </div>
                            <div class="card-body">
                            <div class="col-lg-3">
                                <img style="width:150px; height:150px;" src="gambar/profil/pelajar/<?php echo $x['foto_pelajar'];?>"/>
                                </div>
                                <div class="col-lg-3">
                                        <div class="form-group">
                                                <label class=" form-control-label">NIS</label>
                                                <p><?php echo $x['nis_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Nama</label>
                                                <p><?php echo $x['nama_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">No Telp</label>
                                                <p><?php echo $x['telp_pelajar'];?></p>
                                        </div>
                                </div>
                                <div class="col-lg-3">
                                        <div class="form-group">
                                                <label class=" form-control-label">Surel</label>
                                                <p><?php echo $x['surel_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Status</label>
                                                <p id="status"><?php echo $x['status_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Poin</label>
                                                <p><?php echo $x['poin_pelajar'];?></p>
                                        </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="pelanggaran" type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#pelanggaran">
                                  <i class="fa fa-plus"></i> Pelanggaran
                                </button>
                                <button name="dispen" type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dispen">
                                  <i class="fa fa-plus"></i> Dispensasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabel" class="animated fadeIn">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong class="card-title">Pelanggaran</strong>
                             </div>
                            <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Poin</th>
                                    <th>Tanggal</th>
                                    <th>Petugas</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no   = 1;
                                    $y  = $koneksi->query("SELECT * FROM tb_datapelanggar, tb_pelanggaran, tb_pengguna
                                    WHERE tb_datapelanggar.id_pelajar = '$id'
                                    AND tb_datapelanggar.id_pelanggaran = tb_pelanggaran.id_pelanggaran
                                    AND tb_datapelanggar.id_guru = tb_pengguna.id_pengguna");
                                    while ($pelanggaran = $y->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td><?php echo $no++;?></td>
                                    <td><?php echo $pelanggaran['nama_pelanggaran']?></td>
                                    <td><?php echo $pelanggaran['deskripsi_pelanggaran']?></td>
                                    <td><?php echo $pelanggaran['poin_pelanggaran']?></td>
                                    <td><?php echo $pelanggaran['tanggal_pelanggaran']?></td>
                                    <td><?php echo $pelanggaran['nama_pengguna']?></td>
                                  </tr>
                                    <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabel" class="animated fadeIn">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong class="card-title">Dispensasi</strong>
                             </div>
                            <div class="card-body">
                            <table id="bootstrap-data-table2" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Petugas</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no   = 1;
                                    $y  = $koneksi->query("SELECT * FROM tb_datadispen, tb_pengguna
                                    WHERE tb_datadispen.id_pelajar = '$id'
                                    AND tb_datadispen.id_guru = tb_pengguna.id_pengguna");
                                    while ($pelanggaran = $y->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td><?php echo $no++;?></td>
                                    <td><?php echo $pelanggaran['nama_dispen']?></td>
                                    <td><?php echo $pelanggaran['deskripsi_dispen']?></td>
                                    <td><?php echo $pelanggaran['tgl_dibuat']?></td>
                                    <td><?php echo $pelanggaran['nama_pengguna']?></td>
                                  </tr>
                                    <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 style='display:none;text-align:center;' id='tidakaktif'>TIDAK AKTIF</h1>

<!--Buat modal-->
<div class="modal fade" id="pelanggaran" tabindex="-1" role="dialog" aria-labelledby="pelanggaranLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pelanggaranLabel">Tambah Pelanggaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                            <div class="form-group">
                                                <label class=" form-control-label">Jenis Pelanggaran</label>
                                                <select name="pelanggaran2" class="form-control" onChange="cekpoin(this)">
                                                <option>Pilih jenis pelanggaran</option>
                                                    <?php
                                                     $pelanggar = $koneksi->query("SELECT * FROM tb_pelanggaran ORDER BY id_pelanggaran");
                                                     while ($pelanggaran = $pelanggar->fetch_assoc()){
                                                         echo "<option id='$pelanggaran[poin_pelanggaran]' value='$pelanggaran[id_pelanggaran]'>$pelanggaran[nama_pelanggaran]</option>";
                                                     }
                                                    ?>
						                        </select>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Poin</label>
                                                <p name='poin' id="lihatpoin"></p>
                                            </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="tambahpelanggaran" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<div class="modal fade" id="dispen" tabindex="-1" role="dialog" aria-labelledby="dispenLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="dispenLabel">Tambah Dispensasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                            <div class="form-group">
                                                <label class=" form-control-label">Nama dispen</label>
                                                <input name="nama_dispen" type="text" class="form-control" placeholder="Misalnya : Pulang ke rumah, Barang tertinggal, dsb" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Deskripsi</label>
                                                <textarea class="form-control" rows="4" cols="50" name="deskripsi_dispen" placeholder="Misalnya : Ada barang yang tertinggal dirumah." required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Dari jam</label>
                                                <input name="dari_kapan" type="time" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Sampai jam</label>
                                                <input name="sampai_kapan" type="time" class="form-control"/>
                                            </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="tambahdispen" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


<?php
    if(isset($_POST['tambahpelanggaran'])){
        $id_pelanggaran = $_POST['pelanggaran2'];
        $id_guru        = $_SESSION['id'];
        $setting        = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal        = $setting->format('Y-m-d H:i:s');
        // Cek poin.
        $lihat          = $koneksi->query("SELECT * FROM tb_pelanggaran
        WHERE id_pelanggaran = '$id_pelanggaran'");
        $data           = $lihat->fetch_assoc();
        $poin           = $data['poin_pelanggaran'];
        // Data dimasukan ke table data pelanggar.
        $koneksi->query("INSERT INTO tb_datapelanggar (id_pelajar, id_pelanggaran, poin_pelanggaran,
        id_guru, tanggal_pelanggaran) VALUES ('$id', '$id_pelanggaran', '$poin', '$id_guru', '$tanggal')");
        // Tambah poin di table pelajar.
        $koneksi->query("UPDATE tb_pelajar SET poin_pelajar=(poin_pelajar + $poin) WHERE id_pelajar='$id'");
        ?>
         <script type="text/javascript">
         alert("Data berhasil disimpan!");
         window.location.href="?halaman=piket&aksi=pindai&nis=<?php echo $pindai;?>";
         </script>
         <?php
    }
    if(isset($_POST['tambahdispen'])){
        $nama           = $_POST['nama_dispen'];
        $desk           = $_POST['deskripsi_dispen'];
        $darikapan      = $_POST['dari_kapan'];
        $sampaikapan    = $_POST['sampai_kapan'];
        $id_guru        = $_SESSION['id'];
        $setting        = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal        = $setting->format('Y-m-d H:i:s');
        // Data dimasukan ke table data dispensasi.
        $koneksi->query("INSERT INTO tb_datadispen (id_pelajar, nama_dispen, deskripsi_dispen,
        id_guru, dari_kapan, sampai_kapan, tgl_dibuat)
        VALUES ('$id', '$nama', '$desk', '$id_guru', '$darikapan', '$sampaikapan', '$tanggal')");
        $id_dispen = $koneksi->insert_id;
        ?>
         <script type="text/javascript">
         window.location.href="?halaman=piket&aksi=pindai&nis=<?php echo $pindai;?>";
         window.open('halaman/admin/piket/cetak.php?id=<?php echo $id_dispen; ?>
         &guru=<?php echo $id_guru;?>', 'mywindow', 'toolbar=0,scrollbars=1,statusbar=0,menubar=0,resizable=0,height=500,width=420');
         </script>
         <?php
    }
?>


<script type="text/javascript">
var status = document.getElementById('status').innerHTML;
if (status == "Aktif"){
 document.getElementById('status').style.color = "#2ecc71";
}
if(status == "Nonaktif"){
document.getElementById('status').style.color = "#e74c3c";
document.getElementById('tabel').style.display = "none";
document.getElementById('tidakaktif').style.display = "block";
var divsToHide = document.getElementsByClassName("card-footer");
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none";
    }
}
// Ambil poin
function cekpoin(element) {
    var text = element.options[element.selectedIndex].getAttribute("id");
    document.getElementById("lihatpoin").innerHTML = text;
}
</script><?php
    $pindai = (float) $_GET['nis'];
    $sql    = $koneksi->query("SELECT * FROM tb_pelajar WHERE nis_pelajar = '$pindai'");
    $x      = $sql->fetch_assoc();
    $id     = $x['id_pelajar'];
    // NIS bisa diganti dari URL nya.
    // Cek nis lagi.
    $cek    = $sql->num_rows;
    // Jika nis tidak ditemukan.
    if($cek == 0){
        ?>
        <script type="text/javascript">
        window.location.href="?halaman=piket";
        </script>
        <?php
    }
?>
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Piket</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="?halaman=piket">Piket</a></li>
                            <li class="active">Pelajar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong class="card-title">Data pelajar</strong>
                             </div>
                            <div class="card-body">
                            <div class="col-lg-3">
                                <img style="width:150px; height:150px;" src="gambar/profil/pelajar/<?php echo $x['foto_pelajar'];?>"/>
                                </div>
                                <div class="col-lg-3">
                                        <div class="form-group">
                                                <label class=" form-control-label">NIS</label>
                                                <p><?php echo $x['nis_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Nama</label>
                                                <p><?php echo $x['nama_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">No Telp</label>
                                                <p><?php echo $x['telp_pelajar'];?></p>
                                        </div>
                                </div>
                                <div class="col-lg-3">
                                        <div class="form-group">
                                                <label class=" form-control-label">Surel</label>
                                                <p><?php echo $x['surel_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Status</label>
                                                <p id="status"><?php echo $x['status_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Poin</label>
                                                <p><?php echo $x['poin_pelajar'];?></p>
                                        </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="pelanggaran" type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#pelanggaran">
                                  <i class="fa fa-plus"></i> Pelanggaran
                                </button>
                                <button name="dispen" type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dispen">
                                  <i class="fa fa-plus"></i> Dispensasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabel" class="animated fadeIn">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong class="card-title">Pelanggaran</strong>
                             </div>
                            <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Poin</th>
                                    <th>Tanggal</th>
                                    <th>Petugas</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no   = 1;
                                    $y  = $koneksi->query("SELECT * FROM tb_datapelanggar, tb_pelanggaran, tb_pengguna
                                    WHERE tb_datapelanggar.id_pelajar = '$id'
                                    AND tb_datapelanggar.id_pelanggaran = tb_pelanggaran.id_pelanggaran
                                    AND tb_datapelanggar.id_guru = tb_pengguna.id_pengguna");
                                    while ($pelanggaran = $y->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td><?php echo $no++;?></td>
                                    <td><?php echo $pelanggaran['nama_pelanggaran']?></td>
                                    <td><?php echo $pelanggaran['deskripsi_pelanggaran']?></td>
                                    <td><?php echo $pelanggaran['poin_pelanggaran']?></td>
                                    <td><?php echo $pelanggaran['tanggal_pelanggaran']?></td>
                                    <td><?php echo $pelanggaran['nama_pengguna']?></td>
                                  </tr>
                                    <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabel" class="animated fadeIn">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong class="card-title">Dispensasi</strong>
                             </div>
                            <div class="card-body">
                            <table id="bootstrap-data-table2" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Petugas</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no   = 1;
                                    $y  = $koneksi->query("SELECT * FROM tb_datadispen, tb_pengguna
                                    WHERE tb_datadispen.id_pelajar = '$id'
                                    AND tb_datadispen.id_guru = tb_pengguna.id_pengguna");
                                    while ($pelanggaran = $y->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td><?php echo $no++;?></td>
                                    <td><?php echo $pelanggaran['nama_dispen']?></td>
                                    <td><?php echo $pelanggaran['deskripsi_dispen']?></td>
                                    <td><?php echo $pelanggaran['tgl_dibuat']?></td>
                                    <td><?php echo $pelanggaran['nama_pengguna']?></td>
                                  </tr>
                                    <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 style='display:none;text-align:center;' id='tidakaktif'>TIDAK AKTIF</h1>

<!--Buat modal-->
<div class="modal fade" id="pelanggaran" tabindex="-1" role="dialog" aria-labelledby="pelanggaranLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pelanggaranLabel">Tambah Pelanggaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                            <div class="form-group">
                                                <label class=" form-control-label">Jenis Pelanggaran</label>
                                                <select name="pelanggaran2" class="form-control" onChange="cekpoin(this)">
                                                <option>Pilih jenis pelanggaran</option>
                                                    <?php
                                                     $pelanggar = $koneksi->query("SELECT * FROM tb_pelanggaran ORDER BY id_pelanggaran");
                                                     while ($pelanggaran = $pelanggar->fetch_assoc()){
                                                         echo "<option id='$pelanggaran[poin_pelanggaran]' value='$pelanggaran[id_pelanggaran]'>$pelanggaran[nama_pelanggaran]</option>";
                                                     }
                                                    ?>
						                        </select>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Poin</label>
                                                <p name='poin' id="lihatpoin"></p>
                                            </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="tambahpelanggaran" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<div class="modal fade" id="dispen" tabindex="-1" role="dialog" aria-labelledby="dispenLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="dispenLabel">Tambah Dispensasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                            <div class="form-group">
                                                <label class=" form-control-label">Nama dispen</label>
                                                <input name="nama_dispen" type="text" class="form-control" placeholder="Misalnya : Pulang ke rumah, Barang tertinggal, dsb" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Deskripsi</label>
                                                <textarea class="form-control" rows="4" cols="50" name="deskripsi_dispen" placeholder="Misalnya : Ada barang yang tertinggal dirumah." required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Dari jam</label>
                                                <input name="dari_kapan" type="time" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Sampai jam</label>
                                                <input name="sampai_kapan" type="time" class="form-control"/>
                                            </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="tambahdispen" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


<?php
    if(isset($_POST['tambahpelanggaran'])){
        $id_pelanggaran = $_POST['pelanggaran2'];
        $id_guru        = $_SESSION['id'];
        $setting        = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal        = $setting->format('Y-m-d H:i:s');
        // Cek poin.
        $lihat          = $koneksi->query("SELECT * FROM tb_pelanggaran
        WHERE id_pelanggaran = '$id_pelanggaran'");
        $data           = $lihat->fetch_assoc();
        $poin           = $data['poin_pelanggaran'];
        // Data dimasukan ke table data pelanggar.
        $koneksi->query("INSERT INTO tb_datapelanggar (id_pelajar, id_pelanggaran, poin_pelanggaran,
        id_guru, tanggal_pelanggaran) VALUES ('$id', '$id_pelanggaran', '$poin', '$id_guru', '$tanggal')");
        // Tambah poin di table pelajar.
        $koneksi->query("UPDATE tb_pelajar SET poin_pelajar=(poin_pelajar + $poin) WHERE id_pelajar='$id'");
        ?>
         <script type="text/javascript">
         alert("Data berhasil disimpan!");
         window.location.href="?halaman=piket&aksi=pindai&nis=<?php echo $pindai;?>";
         </script>
         <?php
    }
    if(isset($_POST['tambahdispen'])){
        $nama           = $_POST['nama_dispen'];
        $desk           = $_POST['deskripsi_dispen'];
        $darikapan      = $_POST['dari_kapan'];
        $sampaikapan    = $_POST['sampai_kapan'];
        $id_guru        = $_SESSION['id'];
        $setting        = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal        = $setting->format('Y-m-d H:i:s');
        // Data dimasukan ke table data dispensasi.
        $koneksi->query("INSERT INTO tb_datadispen (id_pelajar, nama_dispen, deskripsi_dispen,
        id_guru, dari_kapan, sampai_kapan, tgl_dibuat)
        VALUES ('$id', '$nama', '$desk', '$id_guru', '$darikapan', '$sampaikapan', '$tanggal')");
        $id_dispen = $koneksi->insert_id;
        ?>
         <script type="text/javascript">
         window.location.href="?halaman=piket&aksi=pindai&nis=<?php echo $pindai;?>";
         window.open('halaman/admin/piket/cetak.php?id=<?php echo $id_dispen; ?>
         &guru=<?php echo $id_guru;?>', 'mywindow', 'toolbar=0,scrollbars=1,statusbar=0,menubar=0,resizable=0,height=500,width=420');
         </script>
         <?php
    }
?>


<script type="text/javascript">
var status = document.getElementById('status').innerHTML;
if (status == "Aktif"){
 document.getElementById('status').style.color = "#2ecc71";
}
if(status == "Nonaktif"){
document.getElementById('status').style.color = "#e74c3c";
document.getElementById('tabel').style.display = "none";
document.getElementById('tidakaktif').style.display = "block";
var divsToHide = document.getElementsByClassName("card-footer");
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none";
    }
}
// Ambil poin
function cekpoin(element) {
    var text = element.options[element.selectedIndex].getAttribute("id");
    document.getElementById("lihatpoin").innerHTML = text;
}
</script>