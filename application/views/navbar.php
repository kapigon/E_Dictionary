<?php
$uri = $this->uri->uri_string();

$tra_tu = '';
$danh_gia_tu = '';
$lien_he = '';
$danh_sach_user_cho_duyet = '';
$tu_cho_duyet = '';
$thong_tin_nguoi_dung = '';
$dang_ky = '';
$dang_nhap = '';

$active = 'active';

if($uri == 'tra-tu'){
    $tra_tu = $active;
}else if($uri == 'danh-gia-tu' || $uri == 'tu-cho-duyet'){
    $danh_gia_tu = $active;
}else if($uri == 'lien-he'){
    $lien_he = $active;
}else if($uri == 'danh-sach-user-cho-duyet'){
    $danh_sach_user_cho_duyet = $active;
}else if($uri == 'tu-cho-duyet'){
    $tu_cho_duyet = $active;
}else if($uri == 'thong-tin-nguoi-dung'){
    $thong_tin_nguoi_dung = $active;
}else if($uri == 'dang-ky'){
    $dang_ky = $active;
}else if($uri == 'dang-nhap'){
    $dang_nhap = $active;
}




?>
<div class="row" style="margin-bottom: 25px;">
    <div class="span12">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url();?>tra-tu">E-Dictionary</a>
              </div>
              <ul class="nav navbar-nav">
                <li class="<?php echo $tra_tu;?>"><a href="<?php echo base_url();?>tra-tu">Tra từ</a></li>
                <li class="<?php echo $danh_gia_tu;?>"><a href="<?php echo base_url();?>tu-cho-duyet">Đánh giá từ</a></li>
                <li class="<?php echo $lien_he;?>"><a href="<?php echo base_url();?>lien-he">Liên hệ</a></li>
                <?php 
                if(!isset($_SESSION)) 
                { 
                    session_start();
                }
                //var_dump( $_SESSION["cUser"]->FullName);
                $cUser = array();
                if(isset( $_SESSION["cUser"])){
                    $cUser = $_SESSION["cUser"];
                ?>
                <?php if($cUser->RoleId <= 1){ ?>
                    <li class="<?php echo $danh_sach_user_cho_duyet;?>"><a href="<?php echo base_url();?>danh-sach-user-cho-duyet">User chờ duyệt</a></li>
                <?php }
                    }
                ?>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if($cUser){ ?>
                        <li class="<?php echo $tu_cho_duyet;?>"><a href="<?php echo base_url();?>tu-cho-duyet"><span class="glyphicon glyphicon-book"></span> Quản lý từ</a></li>
                        <li class="<?php echo $thong_tin_nguoi_dung;?>"><a href="<?php echo base_url();?>thong-tin-nguoi-dung"><span class="glyphicon glyphicon-user"></span> <?php echo $cUser->FullName ?></a></li>
                        <li><a href="<?php echo base_url();?>dang-xuat"><span class="glyphicon glyphicon-log-out"></span> Thoát</a></li>
                    <?php    
                    }else{
                    ?>
                        <li class="<?php echo $dang_ky;?>"><a href="<?php echo base_url();?>dang-ky"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
                        <li class="<?php echo $dang_nhap;?>"><a href="<?php echo base_url();?>dang-nhap"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
                    <?php
                    }
                    ?>
                </ul>
          </div>
        </nav>
    </div>
</div>