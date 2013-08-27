<div id="notifications">
    <ul>
        <?php foreach($errors as $error): ?>
            <li class="form_error"><?= $error ?></li>
        <?php endforeach ?>
    </ul>
</div>
<div id="change_form">
    <form action="<?= $baseUrl ?>user/change_password" method="post">
        <label for="password">Current Password</label>
        <input type="password" id="password" name="password" maxlength="25"/><br>

        <label for="newPassword">New Password</label>
        <input type="password" id="newPassword" name="newPassword" maxlength="25"/><br>

        <label for="newPassword2">Repeat New Password</label>
        <input type="password" id="newPassword2" name="newPassword2" maxlength="25"/><br>

        <input type="submit" value="Change password"/>
    </form>
</div>
