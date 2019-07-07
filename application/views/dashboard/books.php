    <script type="text/javascript" src="<?php echo base_url(‘assets/jquery.min.js’) ?>"></script>
    <script type="text/javascript" src="<?php echo base_url(‘assets/popper.min.js’) ?>"></script>
    <script>
      var dataImage = "";

      function updateDataImage($DataImage){
          dataImage = $DataImage;
      }

      $(document).ready(function(){
          $('[data-toggle="popover"]').popover({
            html: true,
            trigger: 'hover',
            content: function () {
            return '<img src='+dataImage+'/>';
            }
            }
            ); 
      });
    </script>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <form   method="post" action="<?php echo site_url('book/findbooks'); // arahkan form submit ke kontroller 'book/findbooks ?>">
    <input value=<?php echo '"'; echo $keya; echo '" ';  ?> class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search" name="key" style="border: 1px solid #cccccc; margin-top: 20px;">
    </form>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Buku</h1> <h5 class="h5"><?php echo $jumlahBuku;  ?> : Jumlah Total Buku   </h5>
      </div>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Kategori</th>
                <th>Tahun Terbit</th>
                <th>Book Cover</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $row) :?>
                <tr>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['pengarang']; ?></td>
                    <td><?php echo $row['penerbit']; ?></td>
                    <td><?php  ?>
                      
                    <?php foreach($kategori as $kategori_item){

                      if($kategori_item['idkategori'] == $row['idkategori']){
                        echo $kategori_item['kategori'];
                      }

                    }     
                    ?>

                    </td>
                    
                    <td><?php echo $row['thnterbit'] ?></td>
                    <td><button trigger="hover" onclick=<?php echo '"';  echo "updateDataImage('";  echo base_url('assets/images/'.$row['imgfile']);   echo"')";   echo '"';   ?> style="font-size : 1vw" id="pop" type="button" class="btn btn-lg btn-primary" data-toggle="popover"  data-content=<?php echo '"<div  style='."'".'position : absolute;  top : 0vw; width : 50px; height : 100px;'."'>"; echo ' <img ';   echo "width='100px' height='142px'  style=' width : 50px; height : 100px; position :  absolute; max-width : 100%; max-height : 100%;'";  echo ' src='; echo "'"; echo base_url('assets/images/'.$row['imgfile']); echo "' />";  echo '</div>"'; ?> >Show <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg></button></td>
                    <td><?php echo anchor('book/viewDetail/'.$row['idbuku'].'/view', 'View', 'View'); ?> | <?php echo anchor('book/viewDetail/'.$row['idbuku'].'/edit', 'Edit', 'Edit'); ?> |<?php echo anchor('book/delete/'.$row['idbuku'], 'Del', 'Hapus'); ?></td>
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
  