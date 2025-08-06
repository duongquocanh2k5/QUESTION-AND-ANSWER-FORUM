<h2>Edit Question</h2>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="questionid" value="<?=$question['id']?>">
    
    <!-- Edit Question Text -->
    <div>
        <label for="ask">Question:</label>
        <textarea name="ask" id="ask" rows="3" cols="40" required><?=htmlspecialchars($question['ask'], ENT_QUOTES, 'UTF-8')?></textarea>
    </div>

    <!-- Select User -->
    <div>
        <label for="userid">Select User:</label>
        <select name="userid" id="userid" required>
            <?php foreach($users as $user): ?>
                <option value="<?=$user['id']?>" 
                    <?php if($user['id'] == $question['userid']) echo 'selected'; ?>>
                    <?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8')?> 
                    (<?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Select Module -->
    <div>
        <label for="moduleid">Select Module:</label>
        <select name="moduleid" id="moduleid" required>
            <?php foreach($modules as $module): ?>
                <option value="<?=$module['id']?>"
                    <?php if($module['id'] == $question['moduleid']) echo 'selected'; ?>>
                    <?=htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8')?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Edit Image -->
    <div class="image-upload-section">
        <label for="questionimg">Image:</label>
        <?php if(!empty($question['questionimg'])): ?>
            <div class="current-image">
                <p>Current image:</p>
                <img src="./upload/<?=htmlspecialchars($question['questionimg'], ENT_QUOTES, 'UTF-8')?>" 
                     alt="Current question image">
                <input type="hidden" name="current_image" value="<?=htmlspecialchars($question['questionimg'], ENT_QUOTES, 'UTF-8')?>">
            </div>
        <?php endif; ?>
        <input type="file" name="questionimg" id="questionimg" accept="image/*" class="file-input">
        <small class="file-info">Supported formats: JPG, JPEG, PNG, GIF</small>
    </div>

    <input type="submit" name="submit" value="Save Changes">
</form>