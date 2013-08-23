<div id="login_success">
    Thank you for using our app.

    You'll be redirected in a few seconds.
    If nothing happens, please click on <a href="<?= $baseUrl ?>">this link</a>.
</div>
<script>
    setTimeout(function(){
        window.location = "<?= $baseUrl ?>";
    }, 5000);
</script>