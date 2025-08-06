<?php
<?php foreach($comments as $comment): ?>
    <div class="comment">
        <p><?=htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8')?></p>
        <small>
            By <?=htmlspecialchars($comment['name'], ENT_QUOTES, 'UTF-8')?> 
            on <?=htmlspecialchars($comment['date'], ENT_QUOTES, 'UTF-8')?>
        </small>
        
        <form action="deletecomment.php" method="post" style="display: inline;">
            <input type="hidden" name="comment_id" value="<?=$comment['id']?>">
            <input type="hidden" name="question_id" value="<?=$comment['question_id']?>">
            <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?')" class="delete-btn">
                Delete Comment
            </button>
        </form>
    </div>
<?php endforeach; ?>