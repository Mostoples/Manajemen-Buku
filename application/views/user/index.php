    
    <script type="text/javascript" src="<?php echo base_url(‘assets/bootstrap-show-password.min.js’) ?>"></script>
    <script>
    
      $("#newPasswordInput").password('toggle');
      

      function enable($id,$check,$sw,$warn){
        formNode = document.getElementById("formTable");
        labelNotice =  sw = document.getElementsByClassName("toggleNotice");
        sw = document.getElementById($sw);
        warn = document.getElementById($warn);
        edit = document.getElementsByClassName($id);
        switc = document.getElementsByClassName("switch");
        check= document.getElementById($check);
        if(check.checked === true){
          for(i=0;i<edit.length;i++){
            edit[i].disabled = false;
            edit[i].style.background = "rgba(255,255,255,0.5)";
            edit[i].style.border = "0.1vw solid rgba(0,255,255,0.5)";
          }

          

          for(i=0;i<switc.length;i++){
            
            if(switc[i].id != $sw){
              switc[i].style.visibility = "hidden";
            } 
          }

          for(i=0;i<labelNotice.length;i++){
            
            if(labelNotice[i].id != $warn){
              labelNotice[i].style.visibility = "hidden";
            } 
          }

          
          warn.innerHTML = "Toggle to Update";
        }else {
          for(i=0;i<edit.length;i++){
            edit[i].disabled = true;
            edit[i].style.background = "transparent";
            edit[i].style.border = "none";
          }
         
          warn.innerHTML = "Please Wait...";

          stringArgumen = "user/edit/"+edit[0].value+"/"+edit[1].value+"/"+edit[2].value+"/"+edit[3].value+"/"+edit[4].value;
          formNode.action = stringArgumen;
          formNode.submit();
        }
        
      }

      function toggle($id){
          var x = document.getElementById($id);
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
      }

      $("#password").password('toggle');

    </script>
    

    <style>
      .switch {
  position: relative;
  display: inline-block;
  width: 38px;
  height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(15px);
  -ms-transform: translateX(15px);
  transform: translateX(15px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 17px;
}

.slider.round:before {
  border-radius: 50%;
}

.col-centered{
    float: none;
    margin: 0 auto;
}
    </style>

    

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah User</h1>
    </div>


    <form id="formTableInput" action="<?php echo site_url('user/insert'); ?>" method="post">  
    <div class="table-responsive">
        
        
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Username</th>
              <th>Password</th>
              <th>Fullname</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <tr style="background : white">
              <td>
                <div class="form-group" >
                  <input type="text" class="form-control" id="newUsernameInput" aria-describedby="usernameHelp" placeholder="Enter new username here ..." name="username" style="width: 18vw">
                  <small id="usernameHelp" class="form-text text-muted">Please input unique username</small>
                </div>
              </td>
              <td >
                <div class="form-group" >
                  <input  type="password" class="form-control" id="newPasswordInput" aria-describedby="passwordHelp" placeholder="Enter password here ..." name="password" style="width: 18vw" data-toggle="password">
                  <small id="passwordHelp" class="form-text text-muted">Use combination of symbol, number, and letter</small>
                </div>
              </td>
              <td>
                <div class="form-group" >
                  <input type="text" class="form-control" id="newFullnameInput" aria-describedby="fullnameHelp" placeholder="Enter your fullname" name="fullname" style="width: 18vw">
                  <small id="fullnameHelp" class="form-text text-muted">Put your fullname</small>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <div class="col-sm-10">
                  <select class="form-control" name="role" style="width: 18vw">
                    <option value="Admin">Administrator</option>
                    <option value="Operator">Operator</option>
                  </select>
                  </div>
                </div>
              </td>
            </tr>

           
          </tbody>
        </table>
       
        
      </div>
      <div class="form-group row">
        
        <div class="col-centered">
          <button style="width : 20vw" type="submit" class="btn btn-primary mb-2">Create New User</button>      
        </div>
      </div>
    
      </form>

    

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar User</h1>
      </div>

      <div class="table-responsive">
        
        <form id="formTable" action="edit/insert/" method="post">  
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Username</th>
              <th>Password</th>
              <th>Name</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // menampilkan data buku
            foreach ($user as $user_item): 

            ?>
            
            <tr>

            
              <?php $visible = "'edit".$user_item['username']."'"; ?>
              <?php $toggle = "'show".$user_item['username']."'"; ?>
              <?php $toggle2 = "'check".$user_item['username']."'"; ?>
              <?php $toggle3 = "'param".$user_item['username']."'"; ?>
              <?php $toggle4 = "'warn".$user_item['username']."'"; ?>
              <td><input name="username" disabled style="background : transparent; border : none;" class=<?php echo '"'; echo "edit"; echo $user_item['username']; echo '"';?> type="text" value=<?php echo '"'; echo $user_item['username']; echo '"';?>></td>
              <td ><input name="password" id=<?php echo '"'; echo "show"; echo $user_item['username']; echo '"';?> disabled style="background : transparent; border : none;" class=<?php echo '"'; echo "edit"; echo $user_item['username']; echo '"';?> type="password" value=<?php echo '"'; echo $user_item['password']; echo '"';?>>  <input type="checkbox" <?php echo'onclick="toggle('; echo $toggle; echo')">'; ?> Show Password </td>
              <td><input name="fullname" disabled style="background : transparent; border : none;" class=<?php echo '"'; echo "edit"; echo $user_item['username']; echo '"';?> type="text" value=<?php echo '"'; echo $user_item['fullname']; echo '"';?>></td>
              <td><input name="role" disabled style="width : 5vw; background : transparent; border : none;" class=<?php echo '"'; echo "edit"; echo $user_item['username']; echo '"';?> type="text" value=<?php echo '"'; echo $user_item['role']; echo '"';?>>

              <input name="oldUsername" class=<?php echo '"'; echo "edit"; echo $user_item['username']; echo '"';?> type="hidden" value=<?php echo '"'; echo $user_item['username']; echo '"';?>>
              </td>
              <td>
                
                <font class="toggleNotice" id=<?php echo '"'; echo "warn"; echo $user_item['username']; echo '"';?>>Toggle to Edit</font>
                <label class="switch" id=<?php echo '"'; echo "param"; echo $user_item['username']; echo '"';?>>
                  <input type="checkbox" id=<?php echo '"'; echo "check"; echo $user_item['username']; echo '"';?>   <?php echo' onclick="enable('; echo $visible; echo ','; echo $toggle2; echo ','; echo $toggle3; echo ','; echo $toggle4; echo')"'; ?>>
                  <span class="slider round"></span>
                </label> |
                <?php echo anchor('user/delete/'.$user_item['username'], 'Delete', 'Hapus Delete'); ?>

                </td>
                
            
          
                

             
              
            </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
        </form>
      </div>
    </main>


  