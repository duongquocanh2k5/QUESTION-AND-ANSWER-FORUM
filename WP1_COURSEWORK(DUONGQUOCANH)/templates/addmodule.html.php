<h2>Add New Module</h2>

<!-- add module Form -->
<div class="add-module-form">
    <form action="addmodule.php" method="post">
        <div>
            <label for="module_name">Module Name:</label>
            <input type="text" id="module_name" name="module_name" required>
        </div>
        <input type="submit" name="add_module" value="Add Module">
    </form>
</div>

<!-- list of module -->
<h3>Module List</h3>
<table class="user-table">
    <thead>
        <tr>
            <th>Module Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($modules as $module): ?>
            <tr>
                <td><?=htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8')?></td>
                <td>
                    <form action="addmodule.php" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?=$module['id']?>">
                        <button type="submit" name="delete_module" class="delete-button" onclick="return confirm('Are you sure you want to delete this module?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>