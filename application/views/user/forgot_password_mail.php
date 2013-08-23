<div id="forgot_password_mail">
    <p>
        Hello <?= $user->name ?></br>
        </br>
        We received a request to reset your password.<br/>
        In order to confirm the request, and reset your</br>
        password please copy the following web address<br/>
        <?= $baseUrl . 'user/reset_password/' . $user->id . '/' . $user->securityCode ?></br>
        into your browser address bar and then press ENTER.</br>
        We recommend not to click the link as some fraudulent</br>
        emails often misleading links, but instead, please</br>
        follow the above instructions.</br>
        </br>
        If you didn't request your password to reset, just</br>
        ignore this message.</br>
    </p>
</div>