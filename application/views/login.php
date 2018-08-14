<?php include_once('header.php');?>

<?php include_once('navbar.php');?>

<?php echo validation_errors(); ?>
    <form class="form-horizontal" action="UserController/checkLogin" method="post">
        <div class="form-group">
          <label for="usr" class="col-sm-2 control-label">Tên đăng nhập</label>
          <div class="col-sm-10">
              <input type="username" class="form-control"  id="usr"  name="username" placeholder="Tên đăng nhập" autocomplete="Off">
          </div>
        </div>
        <div class="form-group">
          <label for="pwd" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="pwd"   name="password" placeholder="Mật khẩu">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Ghi nhớ
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" value="Đăng nhập" name="Login">Đăng nhập</button>
            <button type="submit" class="btn btn-warning" value="Đăng ký" name="SignUp">Đăng ký</button>
          </div>
        </div>
    </form>
<?php include_once('footer.php');?>