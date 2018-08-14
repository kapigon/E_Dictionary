<?php
//echo base_url(uri_string());
//echo $this->uri->uri_string();
//echo $this->uri->segment(1); 
// GET: URL
$uri = $this->uri->uri_string();
$tu_cho_duyet = '';
$them_tu_moi = '';
$tu_cua_toi = '';
$active = 'active';
if($uri == 'tu-cho-duyet'){
    $tu_cho_duyet = $active;
}else if($uri == 'them-tu-moi'){
    $them_tu_moi = $active;
}else if($uri == 'tu-cua-toi'){
    $tu_cua_toi = $active;
}
?>
<div class="row" style="margin-bottom: 25px;">
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="<?php echo $tu_cho_duyet;?>">
            <a href="<?php echo base_url();?>tu-cho-duyet">Từ chờ duyệt</a>
            <!--<a href="#">Home <span class="badge">42</span></a> -->
        </li>
        <li role="presentation" class="<?php echo $them_tu_moi;?>">
            <a href="<?php echo base_url();?>them-tu-moi">Thêm từ mới</a>
        </li>
        <li role="presentation" class="<?php echo $tu_cua_toi;?>">
            <a href="<?php echo base_url();?>tu-cua-toi">Từ của tôi</a>
        </li>
     </ul>
</div>