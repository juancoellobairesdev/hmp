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
    <?php if(!isset($timeout) || $timeout != 0): ?>
        setTimeout(function(){
            window.location = "<?= $redirect_url ?>";
        }, <?= isset($timeout)? $timeout: 5000 ?>);
    <?php endif ?>
</script>