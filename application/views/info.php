<?php include_once('header.php');?>

<?php include_once('navbar.php');?>

<?php echo validation_errors(); ?>
<?php    
    $checked    = '';
    $fullname   = '';
    $username   = '';
    $email      = '';
    $password   = '';
    $rePassword = '';
    $id         = 0;
    if(isset($info) && count($info) > 0){
        $cUser = $info[0];
        $fullname = $cUser->FullName;
        $username = $cUser->UserName;
        $email = $cUser->Email;
        $id = $cUser->ID;
        $password = '';
        $rePassword = '';
        
        if(isset($_POST['fullname'])){
            $fullname = $_POST['fullname'];
        }

        if(isset($_POST['username'])){
            $username = $_POST['username'];
        }

        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        
        if(isset($_POST['id'])){
            $id= $_POST['id'];
        }
    }
?>

<form class="form-horizontal" action="cap-nhat-thong-tin" method="post">
    <div class="form-group">
      <label for="usr" class="col-sm-2 control-label">Tên đăng nhập</label>
      <div class="col-sm-10">
        <input type="username" class="form-control"  id="usr"  name="username" placeholder="Tên đăng nhập" value="<?php echo $username;?>" readonly>
      </div>
    </div>
    
    <div class="form-group">
      <label for="fullname" class="col-sm-2 control-label">Họ và tên</label>
      <div class="col-sm-10">
        <input type="fullname" class="form-control"  id="fullname"  name="fullname" placeholder="Họ và tên" value="<?php echo $fullname;?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control"  id="email"  name="email" placeholder="Email" value="<?php echo $email;?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="pwd" class="col-sm-2 control-label">Mật khẩu</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="pwd"   name="password" placeholder="Mật khẩu" value="<?php echo $password;?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="repwd" class="col-sm-2 control-label">Mật khẩu nhắc lại</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="repwd"   name="re-password" placeholder="Mật khẩu nhắc lại" value="<?php echo $rePassword;?>">
      </div>
    </div>
    
    <!--<div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="active"> kích hoạt
          </label>
        </div>
      </div>
    </div>-->
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-warning" value="Cập nhật" name="Update">Cập nhật</button>
        <input type="hidden" name="id" value='<?php echo $id; ?>'/>
      </div>
    </div>
</form>
<?php include_once('footer.php');?>