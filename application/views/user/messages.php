<div id="messages">
    <p>
        <?= $message ?>
    </p>
    <p>
        You'll be redirected in a few seconds, 
        if you are not, please click <a href="<?= $redirect_url ?>">here</a>.
    </p>
</div>
<script>
    setTimeout(function(){
        window.location = "<?= $redirect_url ?>";
    }, 5000);
</script>