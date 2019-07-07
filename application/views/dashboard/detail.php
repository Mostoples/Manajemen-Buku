
    <input id="stateValue" type="hidden" value=<?php echo '"'; echo $_SESSION['states']; echo '"'; ?> >


    <script type="text/javascript" src=<?php echo base_url('assets/jquery.min.js') ?>></script>
    <script>

      
      


      function visible($idkategori){
        edit = document.getElementById($idkategori);
        edit.style.visibility = 'visible';
      }
    </script>

    <?php
      function vis(){
        if($_SESSION['states'] == "view"){
          echo " border : none ";
        }
      }
      function disabledFunc(){
        if($_SESSION['states'] == "view"){
          echo "readonly "; echo "disabled "; 
        }
      }
                $idbuku = $book[0]['idbuku'];
                $judul = $book[0]['judul'];
                $pengarang = $book[0]['pengarang'];
                $penerbit = $book[0]['penerbit'];
                $idkategori = $book[0]['idkategori'];
                $imgfile = $book[0]['imgfile'];
                $sinopsis = $book[0]['sinopsis'];
                $thnterbit = $book[0]['thnterbit'];

                    foreach ($kategori as $kategori_item):
                      if($kategori_item['idkategori']==$book[0]['idkategori']){
                        $kategoriFix = $kategori_item['kategori'];
                      }
                    endforeach;   
    ?>

    <style>
      #imgcover:hover {
        color : black;
        background : black;
      }
    </style>
    
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <form action=
      <?php
        if($_SESSION['states'] == "view"){
          echo site_url('book/viewDetail/'.$idbuku.'/edit');
        }else{
          echo site_url('book/edit/'.$idbuku);
        }

      ?>
      method="post" enctype='multipart/form-data'>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Detail Buku</h1>
      </div>

      <div id="detailWrapper" style="position : absolute; margin-right: 2vw; margin-left: 2vw">
      <div class="table-responsive">
      <table class="table table-striped table-sm" style="position : absolute; left : 20vw; width : 55vw">
          <thead>
            <tr>
              <th colspan="2"><center>Identitas Lengkap Buku</center></th>
            </tr>
          </thead>
          <tbody>

            		<tr style="background : white;">
              			<td><div class="form-group" >
                      <font style="margin-top : 0vw; height : 1.7vw; width: 13vw; font-size : 1.2vw; background : transparent; border : none" ><?php echo "Nomor Identitas"; ?></font>
                      </div></td>
              			<td><div class="form-group" >
                      <input readonly type="text" class="form-control" id="idbukuValInput" aria-describedby="idbukuValHelp"  name="idbuku" <?php echo 'style="margin-top : 0vw; height : 1.7vw; width: 44vw; font-size : 1.2vw; background : transparent; '; ?> <?php vis();?> <?php echo '"'; ?> value=<?php echo '"'; echo $idbuku; echo '"';?>>
                      </div></td>
            		</tr>

            		
            		<tr style="background : white;">
              			<td><div class="form-group" >
                      <font style="margin-top : 0vw; height : 1.7vw; width: 13vw; font-size : 1.2vw; background : transparent; border : none" ><?php echo "Judul"; ?></font>
                      </div></td>
                    <td><div class="form-group" >
                      <input <?php disabledFunc(); ?> type="text" class="form-control" id="newJudulInput" aria-describedby="judulHelp"  name="judul" <?php echo 'style="margin-top : 0vw; height : 1.7vw; width: 44vw; font-size : 1.2vw; background : transparent;'; ?> <?php vis();?> <?php echo '"'; ?> value=<?php echo '"'; echo $judul; echo '"';?>>
                      </div></td>
            		</tr>

            		
            		<tr style="background : white;">
              			<td><div class="form-group" >
                     <font style="margin-top : 0vw; height : 1.7vw; width: 13vw; font-size : 1.2vw; background : transparent; border : none" ><?php echo "Pengarang"; ?></font>
                      </div></td>
                    <td><div class="form-group" >
                      <input <?php disabledFunc(); ?> type="text" class="form-control" id="newPengarangInput" aria-describedby="pengarangHelp"  name="pengarang" <?php echo 'style="margin-top : 0vw; height : 1.7vw; width: 44vw; font-size : 1.2vw; background : transparent;'; ?> <?php vis();?> <?php echo '"'; ?> value=<?php echo '"'; echo $pengarang; echo '"';?>>
                      </div></td>
            		</tr>

                
            		
            		<tr style="background : white;">
              			<td><div class="form-group" >
                      <font style="margin-top : 0vw; height : 1.7vw; width: 13vw; font-size : 1.2vw; background : transparent; border : none" ><?php echo "Penerbit"; ?></font>
                      </div></td>
                    <td><div class="form-group" >
                      <input <?php disabledFunc(); ?> type="text" class="form-control" id="newPenerbitInput" aria-describedby="penerbitHelp"  name="penerbit" <?php echo 'style="margin-top : 0vw; height : 1.7vw; width: 44vw; font-size : 1.2vw; background : transparent;'; ?> <?php vis();?> <?php echo '"'; ?> value=<?php echo '"'; echo $penerbit; echo '"';?>>
                      </div></td>
            		</tr>

            		
            		<tr style="background : white;">
              			<td><div class="form-group" >
                      <font style="height : 1.7vw; width: 13vw; font-size : 1.2vw; background : transparent; border : none" ><?php echo "Kategori"; ?></font>
                      </div></td>
                    <td><div class="form-group" >
                      <select <?php echo 'style=" width : 44vw; background : transparent;'; vis(); echo' "'; ?> <?php disabledFunc(); ?> class="form-control" name="idkategori" >

                          <?php
                            foreach ($kategori as $kat_item):
                          ?>
                          
                          <option value="<?php echo $kat_item['idkategori']?>"><?php echo $kat_item['kategori']?></option>
                          <?php
                            endforeach;
                          ?>

                      </select>
                      
                      </div></td>
            		</tr>

            		
            		<tr style="background : white;">
              			<td><div class="form-group" >
                      <font style="margin-top : 0vw; height : 1.7vw; width: 13vw; font-size : 1.2vw; background : transparent; border : none" ><?php echo "Tahun Terbit"; ?></font>
                      </div></td>
                    <td><div class="form-group" >
                      <input <?php disabledFunc(); ?> type="text" class="form-control" id="newThnterbitInput" aria-describedby="thnterbitHelp"  name="thnterbit" <?php echo 'style="margin-top : 0vw; height : 1.7vw; width: 44vw; font-size : 1.2vw; background : transparent;'; ?> <?php vis();?> <?php echo '"'; ?> value=<?php echo '"'; echo $thnterbit; echo '"';?>>
                      </div></td>
            		</tr>
          </tbody>
        </table>

      <table class="table table-striped table-sm" style="position : absolute; top: 25vw; left : 0vw; width : 55vw">
          <tbody>
                <tr style="background : white;">
                    <td><div class="md-form" >
                      <font style="margin-top : 0vw; height : 1.7vw; width: 13vw; font-size : 1.2vw; background : transparent; border : none" ><?php echo "Sinopsis"; ?></font>
                      </div></td>
                    <td><div class="md-form" >
                      <textarea  <?php disabledFunc(); ?> type="text" class="md-textarea form-control" rows="3" id="newSinopsisInput" aria-describedby="sinopsisHelp"  name="sinopsis" <?php echo 'style="margin-top : 0vw; height : 5vw; width : 70vw; font-size : 1.2vw; background : transparent;'; ?> <?php vis();?> <?php echo '"'; ?>><?php echo $sinopsis;?></textarea>
                      </div></td>
                </tr>
           
          </tbody>
        </table>

        <div  style='position : absolute;  top : 0vw; width : 212px; height : 300px; '><img style='position : absolute; max-width : 100%; max-height : 100%;' src="<?php echo base_url('assets/images/'.$book[0]['imgfile']);?>" value=<?php echo'"'; echo $imgfile; echo '"'; ?> />
          <div  class="form-group row" <?php echo 'style="position : absolute;  top : 0vw; width : 212px; height : 300px;  left : 1vw;';  

                  if($_SESSION['states'] == "edit"){ 
                    echo  'background : rgba(0,0,0,0.5);'; 
                  }
         


                  echo'"'; ?>  >

                  <?php
                  if($_SESSION['states'] == "view"){ 
                    
                  }else {
                    echo '
                      <font id="imagefont" style="position : absolute; background : transparent; width : 100%;  font-weight : bold; color : rgba(255,255,255,0.5); font-size : 2vw; text-align : center; top : 40%;">Click to Change Book Cover</font>';
                  }
                  ?>
            
              <div class="col-sm-10" >
                  <?php
                  if($_SESSION['states'] == "view"){ 
                    
                  }else {
                    echo '
                    <input   id="imgcover" size="60" style="position : absolute;  top : 0vw; width : 212px; height : 300px; background : black; opacity : 0;"" type="file" name="image">';
                  }

                  ?>
                  
              </div>
          </div>
        </div><br>

      </div>
      </div>
      <input type='hidden' name='image2' value=<?php echo'"'; echo $imgfile; echo '"'; ?>></input>
      <div class="form-group row">
        
        <div class="col-centered" style="position : absolute; top : 5vw; right : 2vw;">
          
          <font>

            <?php 

              if($_SESSION['states'] == "view"){
                echo "Klik untuk mengedit informasi buku";
              }else{
                echo "Klik untuk menyelesaikan editing";
              }

            ?>

          </font>   
         
          <button id='test' type="submit" class="btn btn-primary mb-2"> 
            

            <?php 

              if($_SESSION['states'] == "view"){
                echo "Edit Data";
              }else{
                echo "Done Editing";
              }

            ?>

          </button> 


         
        </div>
      </div>
    </form>
    </main>
 

