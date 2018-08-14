<?php include_once('header.php');?>

<?php include_once('navbar.php');?>
<script>
    $(document).ready(function(){
        $(".active").click(function(){
            var id = $(this).attr('rel');  
            var active = 0;
            if($(this).is(":checked")) {
                active = 1;
            }
            jQuery.ajax({
                type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/UserController/activeUser",
                    dataType: 'json',
                    data: {id: id, active: active},
                    success: function(data){
                        if(data){
                            $(this).parents("tr").remove();
                        }else{
                            alert("Xử lý cập nhật bị lỗi.");
                        }
                    }
            });
        });
    });
</script>
<?php echo validation_errors(); ?>

<div class="row" style="margin-bottom: 25px;">
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active">
            <a href="dang-ky">Thêm User</a>
        </li>
       
     </ul>
</div>
<table class="table table-striped"> 
    <thead> 
        <tr> 
            <th>#</th>
            <th>Email</th>
            <th>FullName</th>
            <th>Username</th>
            <th class="text-center">Hoạt động</th>
        </tr> 
    </thead> 
    <tbody> 
        <?php
        if(count($userList) > 0){
            $count = 1;
            foreach($userList as $user){?>
                <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td><?php echo $user->Email; ?></td> 
                    <td><?php echo $user->FullName; ?></td>
                    <td><?php echo $user->UserName; ?></td>
                    <td class="text-center"><input type="checkbox" name="active" class="active" rel="<?php echo $user->ID; ?>"></td>
                </tr> 
            <?php
                $count++;
            }
        }
        ?>
    </tbody> 
</table>
<?php include_once('footer.php');?>