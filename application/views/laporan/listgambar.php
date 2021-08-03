<?php echo $idlaporan; ?>
<!-- <button style="margin-bottom: 20px;" type="button" class="btn btn-info" onclick="tambahfile('>')">Tambah File</button> -->
<button style="margin-bottom: 20px;" data-toggle="modal" data-target="#mymodal" onclick="prosesdata('gambar','<?php echo $idlaporan; ?>')" type="button" class="btn btn-info ">Buat Laporan</button>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col" colspan="3">File Gambar</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($menu as $key => $value) {
      ?>
      <tr>
        <td scope="row" colspan="3"><img width="20%" src="<?= base_url('berkaspendukung/'.$idlogin.'/'.$value["nama_file"]);  ?>"></td>
        <td>
          <button  onclick="prosesdata('hapusgambar','<?php echo $idlaporan; ?>')" type="button" class="btn btn-danger ">Hapus</button>

        </td>

      </tr>
      <?php 
    }
    ?>
    

  </tbody>
</table>
