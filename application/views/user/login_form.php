<form action="<?= $baseUrl ?>user/login" method="post">
    <label for="email">E-mail</label>
    <input type="text" id="email" name="email" maxlength="255"/><br/>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" maxlength="25"/><br>
    <div id="forgot_password">
        <a href="<?= $baseUrl ?>user/forgot_form">Forgot your password?</a>
    </div>
    <input type="submit" value="Submit"/>
    <input type="reset" value="reset"/>
</form>

