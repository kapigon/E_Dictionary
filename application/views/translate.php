<?php include_once('header.php');?>

<?php include_once('navbar.php');?>

<?php echo validation_errors(); ?>
<?php 
    $text_search = '';
    $text_detail = '';
    $language = 'en';
    
    if(isset($_POST['textSearch'])){
        $text_search = $_POST['textSearch'];
    }
    if(isset($_POST['language'])){
        $language = $_POST['language'];
    }
    
    if(isset($result) && count($result) > 0){
        #var_dump($result);
        foreach($result as $val){
            $text_detail .= $val . '&#13;&#10;';
        }                
    }
    
?>
<script>
    
</script>
<div class="row">
    <div class="span12 col-lg-12">
        
        <?php echo form_open('tra-tu'); ?>
            <div class="form-inline">
                <!--<div class="frmSearch">
                    <input type="text" id="txtTextSearch" name="textSearch" class="col-lg-8" value="<?php echo $text_search; ?>"/>&nbsp; 
                    <div id="suggesstion-box"></div> &nbsp; 
                </div>-->
                <div class="form-group">
                    <input type="text" class="form-control" id="txtTextSearch" name="textSearch" placeholder="Tra từ"  value="<?php echo $text_search; ?>" autocomplete="Off"> 
                </div>
                <label class="radio-inline">
                    <input type="radio"  name="AZ" value="A" checked="checked">A -> Z
                </label>
                <label class="radio-inline">
                    <input type="radio" name="AZ" value="I">A <-> Z
                </label>
                <div class="form-group">
                    <select class="form-control" name='language' id="ddlLanguage">
                       <?php if($language == 'en'){
                        echo '<option value="en" selected="selected">Anh - Việt</option>';
                        echo '<option value="vi">Việt - Anh</option>';
                    }else{
                        echo '<option value="en">Anh - Việt</option>';
                        echo '<option value="vi"  selected="selected">Việt - Anh</option>';
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                      <button type="submit" class="btn btn-primary"  value="Tra từ" name="SignUp">Tra từ</button>
                      <input onclick='responsiveVoice.speak("");' type='button' value='🔊 Play' id="speak" />
                </div>
            </div>
            <br/>
            <textarea name="detail" class="form-control" rows="6"><?php echo $text_detail; ?></textarea>
            <br/>
            
            
        </form>
    </div>
</div>
<?php include_once('footer.php');?>