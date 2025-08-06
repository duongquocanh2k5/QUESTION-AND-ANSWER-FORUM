<?php
 foreach($questions as $question): ?>
    <blockquote>
        
        <?=htmlspecialchars($question['ask'], ENT_QUOTES,'UTF-8')?>
        <br><?=htmlspecialchars($question['module_name'], ENT_QUOTES,'UTF-8')?></br>
        (by <a href="mailto:<?=htmlspecialchars($question['email'],ENT_QUOTES,'UTF-8');?>">
        <?=htmlspecialchars($question['name'], ENT_QUOTES,'UTF-8')?></a>)
        <?= date('d-m-Y', strtotime($question['date'])); ?>



        
        <?php if (!empty($question['questid'])) : ?>
            <div class="question-image">
                <img src="./upload/<?= htmlspecialchars($question['questionimg']); ?>" alt="Question Image">
            </div>
        <?php else : ?>
            <p class="no-image">No picture</p>
        <?php endif; ?>

        

        <div class="action-buttons">
            <form action="editquestion.php" method="get" style="display: inline;">
                <input type="hidden" name="id" value="<?=$question['questid']?>">
                <input type="submit" value="Edit">
            </form>

            <form action="deletequestion.php" method="post" style="display: inline;">
                <input type="hidden" name="questid" value="<?=$question['questid']?>">
                <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
            </form>
        </div>

        

        <div class="comments-section">
    <?php
    $query = 'SELECT * FROM comments WHERE question_id = :question_id ORDER BY date DESC';
    $params = [':question_id' => $question['id']];
    $comments = query($pdo, $query, $params)->fetchAll();
    
    if (!empty($comments)): ?>
        <h4>Comments:</h4>
        <?php foreach($comments as $comment): ?>
            <div class="comment">
                <p><?=htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8')?></p>
                <small>
                    By <?=htmlspecialchars($comment['name'], ENT_QUOTES, 'UTF-8')?> 
                    on <?=date('d-m-Y H:i', strtotime($comment['date']))?>
                </small>
                <!-- add delete button for comment -->
                <form action="deletecomment.php" method="post" style="display: inline;">
                    <input type="hidden" name="comment_id" value="<?=$comment['id']?>">
                    <input type="hidden" name="question_id" value="<?=$question['id']?>">
                    <button type="submit" name="delete" class="delete-btn">Delete Comment</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <h4>Add a Comment</h4>
    <form action="addcomment.php" method="post">
        <input type="hidden" name="question_id" value="<?=$question['id']?>">
        <div>
            <label for="name">Select User:</label>
    <select id="name" name="userid" required>
        <option value="">Choose a user</option>
        <?php 
        // Provide User From Database 
        $users = allUsers($pdo);
        foreach($users as $user): ?>
            <option value="<?=htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8')?>">
                <?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8')?> 
                (<?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?>)
            </option>
        <?php endforeach; ?>
    </select>
        </div>
        <div>
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment_text" required></textarea>
        </div>
        <div>
            <button type="submit" name="submit_comment">Add Comment</button>
        </div>
    </form>
</div>
    </blockquote>
<?php endforeach; ?>