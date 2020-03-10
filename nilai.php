<?php
include "config/koneksi.php";
if(isset($_POST['simpan'])) {
  $total = (40/100 * $_POST['tugas']) + (60/100 * $_POST['uts']);

  if($total>=90) {
    $mutu ="A";
  }else if ($total>=80) {
    $mutu ="B";
  }else if ($total>=70) {
    $mutu ="C";
  }else if ($total>=60) {
    $mutu ="D";
  }else {
    $mutu ="E";
  }

  $sql = "INSERT INTO tb_mahasiswa VALUES ('','$_POST[nim]', '$_POST[nama]', '$_POST[jurusan]', '$_POST[matkul]', '$_POST[tugas]', '$_POST[uts]', '$total', '$mutu');";

  $eksekusi = mysqli_query($con, $sql);
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=nilai'</script>";


}

  if (isset($_GET['hapus'])) {
      $sql = mysqli_query($con, "DELETE FROM tb_mahasiswa WHERE nim = '$_GET[id]'");
    if ($sql) {
      echo "<script>alert('Data Terhapus');document.location.href='?menu=nilai';</script>";
    }else{
         echo "<script>alert('Data Tidak Terhapus');document.location.href='?menu=nilai';</script>";
    }
  }

?>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Nilai</h6>
            </div>
            <div class="card-body">
            <form method="post">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                    <input type="number" name="nim" class="form-control" placeholder="NIM" required="">
                    </div>
                    <div class="col">
                    <input type="text" name="nama" class="form-control" placeholder="Nama">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                    <select name="jurusan" class="form-control">
                        <option>Jurusan</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informatika">Sistem Informatika</option>
                    </select>
                    </div>
                    <div class="col">
                    <input type="text" name="matkul" class="form-control" placeholder="Mata Kuliah">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                    <input type="number" name="tugas" class="form-control" placeholder="Nilai Tugas">
                    </div>
                    <div class="col">
                    <input type="number" name="uts" class="form-control" placeholder="Nlai UTS">
                    </div>
                </div>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">SIMPAN</button>
            </form>
            <br><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Jurusan</th>
                      <th>Mata Kuliah</th>
                      <th>Nilai Tugas</th>
                      <th>Nilai PTS</th>
                      <th>Toal</th>
                      <th>Kualitas</th>
                      <th>Aksi</th>
                  <tbody>
                    <?php
                    $sql = mysqli_query($con, "SELECT * FROM tb_mahasiswa");
                    while ($r=mysqli_fetch_array($sql)) {
                    ?>
                      <tr>
                      <td><?php echo $r['nim'] ?></td>
                      <td><?php echo $r['nama'] ?></td>
                      <td><?php echo $r['jurusan'] ?></td>
                      <td><?php echo $r['mata_kuliah'] ?></td>
                      <td><?php echo $r['nilai_tugas'] ?></td>
                      <td><?php echo $r['nilai_uts'] ?></td>
                      <td><?php echo $r['total'] ?></td>
                      <td><?php echo $r['huruf_mutu'] ?></td>
                      <td><a href="?menu=nilai&hapus&id=<?php echo $r['nim'] ?>" onClick="return confirm('Anda Yakin')" class="btn btn-danger">Hapus</a></td>
                    </tr>
                    <?php 
                  } 
                  ?>
                  </tbody>
                </tr>
              </thead>
                    
                </table>
              </div>
            </div>
          </div>

    