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
    
    if(isset($info) && count($info) > 0){
        $wordItem   = $info[0];
        $word       = $wordItem->Word;
        $detail     = $wordItem->Detail;
        $language   = $wordItem->Language;
        $id         = $wordItem->ID;
        $spelling   = $wordItem->Spelling;
      
        $en = ($language == 'en' ? "selected" : "");
        $vi = ($language == 'vi' ? "selected" : "");
    }
?>
<style>
    .br-theme-css-stars .br-widget a{
        height: 45px;
        width: 45px;
        font-size: 40px;
    }
    .title-rating{
        display: inline-block;
        float: left;
        color: #7E97AC;
    }
    
</style>
<?php
    $star_1 = 0;
    $star_2 = 0;
    $star_3 = 0;
    $star_4 = 0;
    $star_5 = 0;
    $comment = '';
    //var_dump($starList);
    $readOnly = '';
    //var_dump(($isCommented));
    if(isset($starList) && count($starList) > 0){
        if($starList[0]->total > 0){
            $star_1 = round($starList[0]->star1 / $starList[0]->total * 100,1);
            $star_2 = round($starList[0]->star2 / $starList[0]->total * 100,1);
            $star_3 = round($starList[0]->star3 / $starList[0]->total * 100,1);
            $star_4 = round($starList[0]->star4 / $starList[0]->total * 100,1);
            $star_5 = round($starList[0]->star5 / $starList[0]->total * 100,1);
        }
    }
    
    if(isset($isCommented) && count($isCommented) > 0 && $isCommented[0]->cm > 0){
        $readOnly = 'readonly';
        
        $comment = $isCommented[0]->Comment;
    }
?>
<script>
    $('#example-css').barrating({
        theme: 'css-stars',
        showSelectedRating: false,
        initialRating: 4,
        onSelect: function(value, text) {
            alert('Selected rating: ' + value);
            $("#star").val(value);
        }
    });
</script>
<div class="row">
    <div class="span12 col-lg-12">
        <?php echo form_open('CommentController/rating'); ?>
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" id="word" name="word" placeholder="Tra từ" value="<?php echo $word; ?>" readonly> 
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="txtSpelling" name="spelling" placeholder="Phiên âm"  value="<?php echo $spelling; ?>" readonly> 
                </div>
                <div class="form-group">
                    <select class="form-control" name='language' id="ddlLanguage" readonly>
                       <option value="en" <?php echo $en;?>>Anh - Việt</option>
                       <option value="vi" <?php echo $vi;?>>Việt - Anh</option>
                    </select>
                </div>
                
            </div>
            <br/>
            <textarea name="detail" class="form-control" rows="6" readonly><?php echo $detail; ?></textarea>
            
            <hr>
             <?php
            if(isset($commentList) && count($commentList) > 0){ ?>
                <div class="row" style="max-height: 400px; overflow: scroll;">
                    <h3>Danh sách Comment</h3>
                    <div class="col-sm-12">    
                         <?php
                            foreach($commentList as $cm){
                                echo '<div class="alert alert-info" role="alert">'. $cm->Comment .' <br/><hr> '. $cm->FullName . ' - '. $cm->Email .' </div>';
                            }
                        ?>
                    </div>
                </div>
                <hr>
            <?php }?>
                
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="stars stars-example-css">
                            <select id="example-css" name="rating" autocomplete="off">
                                <option value="1">1</option>
                                <option value="2" selected="selected">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <span>(ĐÁNH GIÁ)</span>
                    </div>
                    
                    <span class="title-rating">5 SAO &nbsp;&nbsp;</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $star_5;?>%;">
                            <?php echo $star_5;?>%
                        </div>
                    </div>
                    
                    <span class="title-rating">4 SAO &nbsp;&nbsp;</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $star_4;?>%;">
                            <?php echo $star_4;?>%
                        </div>
                    </div>
                    
                    <span class="title-rating">3 SAO &nbsp;&nbsp;</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $star_3;?>%;">
                            <?php echo $star_3;?>%
                        </div>
                    </div>
                    
                    <span class="title-rating">2 SAO &nbsp;&nbsp;</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $star_2;?>%;">
                            <?php echo $star_2;?>%
                        </div>
                    </div>
                    
                    <span class="title-rating">1 SAO &nbsp;&nbsp;</span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $star_1;?>%;">
                            <?php echo $star_1;?>%
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <textarea name="comment" class="form-control" rows="9" placeholder="Nội dung bình luận" <?php echo $readOnly;?>><?php echo trim($comment);?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"  value="Thêm từ" name="addRating">Bình luận</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <input type="hidden" name="star" value="1" id="star"/>
        </form>
    </div>
</div>
<?php include_once('footer.php');?>