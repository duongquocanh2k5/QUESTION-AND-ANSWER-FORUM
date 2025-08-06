<form action="" method="post" enctype="multipart/form-data">>
    <label for='ask'> Ask a Question</label>
    <textarea name="ask" row="3" cols="40"></textarea>  
    <input type="file" name="questionimg" id="questionimg" accept="image/*">

    <select name="userid">
        <option value="">Choose User</option>
        <?php foreach ($users as $user):?>
           <option value="<?=htmlspecialchars($user['id'], ENT_QUOTES,'UTF-8');?>">
           <?=htmlspecialchars($user['name'], ENT_QUOTES,'UTF-8'); ?>
           </option>
           <?php endforeach;?>
    </select>

    <select name="moduleid">
        <option value=""> Choose Module</option>
        <?php foreach ($modules as $module):?>
           <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES,'UTF-8');?>">
           <?=htmlspecialchars($module['module_name'], ENT_QUOTES,'UTF-8'); ?>
           </option>
           <?php endforeach;?>
    </select>
    
    
    <input type="submit" name="submit" value="Add">
</form>