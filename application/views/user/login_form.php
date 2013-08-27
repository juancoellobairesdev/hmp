<div id="notifications">
    <ul>
        <?php foreach($errors as $error): ?>
            <li class="form_error"><?= $error ?></li>
        <?php endforeach ?>
    </ul>
</div>
<div id="login_form">
    <form action="<?= $baseUrl ?>user/login" method="post">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" maxlength="128" value="<?= $email ?>"/><br/>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" maxlength="25"/><br>

        <div id="forgot_password">
            <a href="<?= $baseUrl ?>user/forgot_password_form">Forgot your password?</a>
        </div>

        <input type="submit" value="Log in"/>
    </form>
</div>
