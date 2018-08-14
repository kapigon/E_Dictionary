<?php include_once('header.php');?>

<?php include_once('navbar.php');?>

<?php include_once('navbar_Word.php');?>

<?php echo validation_errors(); ?>

<table class="table table-striped"> 
    <thead> 
        <tr> 
            <th>#</th>
            <th>Từ</th>
            <th>Nội dung</th>
            <th>Ngôn ngữ</th>
            <th class="text-center"></th>
        </tr> 
    </thead> 
    <tbody> 
        <?php 
        //echo $this->my_customs->fullurl();
        if(count($wordPendingList) > 0){
            $count = 1;
            foreach($wordPendingList as $word){?>
                <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td><?php echo $word->Word; ?></td> 
                    <td><?php echo $word->Detail; ?></td>
                    <td><?php echo $word->Language; ?></td>
                    <td class="text-center">
                        <a href="TranslateController/getWordById/<?php echo $word->ID; ?>" title="Đánh giá"><img src="<?php echo base_url();?>customs/images/icons/pencil.png" alt="Đánh giá" /></a>
                        <?php
                        // Chỉ có admin và Quản trị mới được sửa
                        if($currentUser->RoleId == 1 || $currentUser->RoleId == 2){
                            //?redirect=<?php echo base64_encode($this->my_customs->fullurl());
                        ?>
                        <a href="TranslateController/editWord/<?php echo $word->ID; ?>" title="Sửa"><img src="<?php echo base_url();?>customs/images/icons/hammer_screwdriver.png" alt="Sửa" /></a>
                        
                        <?php } ?>
                    </td>
                </tr> 
            <?php
                $count++;
            }
        }
        ?>
            
    </tbody> 
</table>

<?php include_once('footer.php');?>