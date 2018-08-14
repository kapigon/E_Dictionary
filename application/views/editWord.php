<?php include_once('header.php');?>

<?php include_once('navbar.php');?>

<?php include_once('navbar_Word.php');?>

<?php echo validation_errors(); ?>
<?php
    $word       = '';
    $detail     = '';
    $language   = '';
    $spelling   = '';
    $id         = 0;
    $en         = '';
    $vi         = '';
    $active     = '';
    $status     = '';
    if(isset($info) && count($info) > 0){
        $wordItem   = $info[0];
        $word       = $wordItem->Word;
        $detail     = $wordItem->Detail;
        $language   = $wordItem->Language;
        $id         = $wordItem->ID;
        $spelling   = $wordItem->Spelling;
        
        if($wordItem->Active){
            $active = 'checked';
        }
        if($wordItem->StatusId == 1){
            $status = 'checked';
        }
        
        $en = ($language == 'en' ? "selected" : "");
        $vi = ($language == 'vi' ? "selected" : "");
    }
?>
<script>
    $(document).ready(function(){
        $(".active").click(function(){
            if($(this).is(":checked")) {
                $(".status").prop('checked', true);
            }
        });
    });
</script>
<div class="row">
    <div class="span12 col-lg-12">
        <?php echo form_open('TranslateController/action'); ?>
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" id="word" name="word" placeholder="Tra từ" value="<?php echo $word; ?>"> 
                </div>
               <div class="form-group">
                    <input type="text" class="form-control" id="txtSpelling" name="spelling" placeholder="Phiên âm"  value="<?php echo $spelling; ?>"> 
                </div>
                <div class="form-group">
                    <select class="form-control" name='language' id="ddlLanguage">
                       <option value="en" <?php echo $en;?>>Anh - Việt</option>
                       <option value="vi" <?php echo $vi;?>>Việt - Anh</option>
                    </select>
                </div>
                <?php
                // Chỉ có admin và Quản trị mới được kích hoạt
                if($currentUser->RoleId == 1 || $currentUser->RoleId == 2){
                ?>
                <div class="form-group">
                    Kích hoạt: 
                    <input type="checkbox" name="active" class="active" <?php echo $active;?>/>
                </div>
                <div class="form-group">
                    Duyệt: 
                    <input type="checkbox" name="status" class="status" <?php echo $status;?>/>
                </div>
                <?php } ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"  value="Sửa" name="editWord">Sửa</button>
                </div>
            </div>
            <br/>
            <textarea name="detail" class="form-control" rows="6"><?php echo $detail; ?></textarea>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <br/>
        </form>
    </div>
</div>
<?php include_once('footer.php');?>