<div class="editusercontainer">
    <form method="POST" action="" enctype="multipart/form-data">
        <h1>EDIT USER</h1>

        <label>ID:</label>
        <br>
        <input type="text" name="id" value="<?php echo $row['id']; ?>" readonly>
        <br>
        <br>
        <label>Username:</label>
        <br>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
        <br>
        <br>
        <label>Email:</label>
        <br>
        <input type="email" name="emailid" value="<?php echo $row['emailid']; ?>" required>
        <br>
        <br>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="user" <?php if ($product->role == 'user') echo 'selected'; ?>>User</option>
            <option value="admin" <?php if ($product->role == 'admin') echo 'selected'; ?>>Admin</option>
        </select>

        <br>
        <br>
        <label>Password:</label>
        <br>
        <input type="password" name="password" value="<?php echo $row['password']; ?>" readonly>
        <br>
        <br>
        <button type="submit" name="update">Update</button>
        <a href="<?php echo $url; ?>" name="back">Back</a>
    </form>
</div>