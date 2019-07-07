    <script>
    
      
      function visible($idkategori){
        edit = document.getElementById($idkategori);
        edit.style.visibility = 'visible';
      }
    </script>

    

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Kategori</h1>
    </div>

    <form method="post" action="<?php echo site_url('kategori/insert'); ?>">
    <font>Nama Kategori</font>
    <input class="form-control form-control-dark" type="text" placeholder="Nama Kategori Here.." name="newKategori" style="border: 1px solid #cccccc; margin-top: 5px; width : 80vw; height : 4vw; font-size : 1.5vw;">
    <br>
    <div class="form-group row">
              <div class="col-sm-5">
              </div>
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary mb-2">Submit Data Buku</button>      
              </div>
    </div>

    </form>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Kategori</h1>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>No</th>
              <th>Kategori</th>
              <th>Action</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // menampilkan data buku
            foreach ($data->result() as $row): 

            ?>
            <tr>
              <td><?php echo $row->idkategori ?></td>
              <td><?php echo $row->kategori ?></td>
              <td><?php $visible = "'edit".$row->idkategori."'";

              echo "<font style='color : blue;  cursor : pointer'"; echo' onclick="visible('; echo $visible; echo ')">Edit</font>'; ?> | <?php echo anchor('kategori/delete/'.$row->idkategori, 'Delete', 'Hapus Kategori'); ?></td>

              <td><div style="visibility : hidden;" id=<?php echo "'edit"; echo $row->idkategori; echo "'";?>><form action=  <?php echo "'"; echo site_url('/kategori/edit/'); echo $row->idkategori; echo "'"; ?> method="post"> <input type="text" name="modifiedKategori"></input><button type="submit">Modified</button></form></div></td>

            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="row">
        <div class="col">
            <!--Tampilkan pagination-->
            <?php echo $pagination; ?>
        </div>
    </div>
      </div>
    </main>


  