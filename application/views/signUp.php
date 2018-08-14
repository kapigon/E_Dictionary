<?php include_once('header.php');?>

<?php include_once('navbar.php');?>

<?php echo validation_errors(); ?>

<form class="form-horizontal" action="dang-ky" method="post">
    <div class="form-group">
      <label for="fullname" class="col-sm-2 control-label">Họ và tên</label>
      <div class="col-sm-10">
          <input type="fullname" class="form-control"  id="fullname"  name="fullname" placeholder="Họ và tên" value="<?php echo set_value('fullname', '');?>" autocomplete="Off">
      </div>
    </div>
    <div class="form-group">
      <label for="usr" class="col-sm-2 control-label">Tên đăng nhập</label>
      <div class="col-sm-10">
        <input type="username" class="form-control"  id="usr"  name="username" placeholder="Tên đăng nhập" value="<?php echo set_value('username', '');?>" autocomplete="Off">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control"  id="email"  name="email" placeholder="Email" value="<?php echo set_value('email','');?>" autocomplete="Off">
      </div>
    </div>
    <div class="form-group">
      <label for="pwd" class="col-sm-2 control-label">Mật khẩu</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="pwd"   name="password" placeholder="Mật khẩu">
      </div>
    </div>
    <div class="form-group">
      <label for="repwd" class="col-sm-2 control-label">Mật khẩu nhắc lại</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="repwd"   name="re-password" placeholder="Mật khẩu nhắc lại">
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
        <button type="submit" class="btn btn-warning" value="Đăng ký" name="SignUp">Đăng ký</button>
      </div>
    </div>
</form>
<?php include_once('footer.php');?>