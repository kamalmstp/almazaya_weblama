<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"><?php if(isset($_GET["lang"])){echo "Ubah Kata Sandi";}else{echo "Edit Password";}?></h4>
    </div>
    <div class="modal-body">
    <div class="error-form">
        
    </div>
      <form class="form-horizontal password" role="form" action="" method="POST">
      <div class="form-group">
        <label class="col-sm-3 control-label" for="inputPassword3"><?php if(isset($_GET["lang"])){echo "Kata Sandi Lama";}else{echo "Old Password";}?></label>
        <div class="col-sm-9">
            <input type="password" name="oldpassword" class="form-control oldpassword" required="" placeholder="Old password"/>
        </div>
      </div>
      
      
      <div class="form-group">
        <label class="col-sm-3 control-label" for="inputPassword3"><?php if(isset($_GET["lang"])){echo "Kata Sandi Baru";}else{echo "New Password";}?></label>
        <div class="col-sm-9">
            <input type="password" name="password" class="form-control password" required="" placeholder="Password"/>
        </div>
      </div>
     <div class="form-group">
        <label class="col-sm-3 control-label" for="inputPassword3"><?php if(isset($_GET["lang"])){echo "Konfirmasi Kata Sandi Baru";}else{echo "Confirm New Password";}?></label>
        <div class="col-sm-9">
            <input type="password" name="confirmpassword" class="form-control confirmpassword" required="" placeholder="Confirm Password"/>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" value="<?php if(isset($_GET["lang"])){echo "Kirim";}else{echo "Submit";}?>" class="submit">
      </div>
    </div>
    
      
    
    </form>