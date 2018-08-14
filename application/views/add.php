<?php include_once('header.php');?>

<?php include_once('navbar.php');?>

<?php include_once('navbar_Word.php');?>

<?php echo validation_errors(); ?>
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
                    <input type="text" class="form-control" id="word" name="word" placeholder="Tra từ"> 
                </div>
               <div class="form-group">
                    <input type="text" class="form-control" id="txtSpelling" name="spelling" placeholder="Phiên âm"> 
                </div>
                <div class="form-group">
                    <select class="form-control" name='language' id="ddlLanguage">
                       <option value="en" selected="selected">Anh - Việt</option>
                       <option value="vi">Việt - Anh</option>
                    </select>
                </div>
                <?php
                // Chỉ có admin và Quản trị mới được kích hoạt
                if($currentUser->RoleId == 1 || $currentUser->RoleId == 2){
                ?>
                <div class="form-group">
                    Kích hoạt: 
                    <input type="checkbox" name="active" class="active"/>
                </div>
                <div class="form-group">
                    Duyệt: 
                    <input type="checkbox" name="status" class="status"/>
                </div>
                <?php } ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"  value="Thêm từ" name="addWord">Thêm từ</button>
                </div>
            </div>
            <br/>
            <textarea name="detail" class="form-control" rows="6" placeholder="Nội dung"></textarea>
            <br/>
        </form>
    </div>
</div>
<?php include_once('footer.php');?>