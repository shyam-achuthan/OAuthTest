<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo 'Authorize App';
?>

<form action="" method="POST">
    <?php echo Form::token(); ?>     
    <input type="submit" name="approve" value="Approve" />
    <input type="submit" name="deny" value="Deny" />           
</form>

