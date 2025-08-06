<h2>Add New User</h2>

<!-- add user Form -->
<div class="add-user-form">
    <form action="adduser.php" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <input type="submit" name="add_user" value="Add User">
    </form>
</div>

<!-- list of users -->
<h3>User List</h3>
<table class="user-table">
    <thead>
        <tr>
            
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                
                <td><?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?></td>
                <td>
                    <form action="adduser.php" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?=$user['id']?>">
                        <button type="submit" name="delete_user" class="delete-button" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>