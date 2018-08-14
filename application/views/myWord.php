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
            <th>Hoạt động</th>
            <th>Duyệt</th>
            <th class="text-center"></th>
        </tr> 
    </thead> 
    <tbody> 
        <?php
        if(count($wordPendingList) > 0){
            $count = 1;
            foreach($wordPendingList as $word){?>
                <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td><?php echo $word->Word; ?></td> 
                    <td><?php echo $word->Detail; ?></td>
                    <td><?php echo $word->Language; ?></td>
                    <td>
                        <?php
                        if($word->Active == 1){
                            echo '<input type="checkbox" name="active" class="active" checked/>';
                        }else{
                            echo '<input type="checkbox" name="active" class="active"/>';
                        }
                        ?>
                    </td>
                     <td>
                        <?php
                        if($word->StatusId == 1){
                            echo '<input type="checkbox" name="active" class="active" checked/>';
                        }else{
                            echo '<input type="checkbox" name="active" class="active"/>';
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <a href="TranslateController/viewWord/<?php echo $word->ID; ?>" title="Xem"><img src="<?php echo base_url();?>customs/images/icons/information.png" alt="Xem" /></a>
                        <?php
                            if($word->Active == 0 || $currentUser->RoleId == 1 || $currentUser->RoleId == 2){
                                echo '<a href="TranslateController/editWord/' . $word->ID .'" title="Sửa"><img src="'. base_url() .'customs/images/icons/hammer_screwdriver.png" alt="Sửa" /></a>';
                                echo '<a href="xoa-tu/' . $word->ID .'" title="Xóa"><img src="'. base_url() .'customs/images/icons/cross.png" alt="Xóa" /></a>';
                            }
                        ?>
                        
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