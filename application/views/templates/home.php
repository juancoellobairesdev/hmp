<!DOCTYPE html> 
<html lang="en">
    <head>
        <link rel="shortcut icon" href="<?=$imagesUrl?>favicon.ico">
        <?php include '_head.php'; ?>
        <?php include '_config.php'; ?>
    </head>
    <body>
        <br/>
        <section class="bodycont">
            <?php include "_header.php"; ?>
            <section class="maincont">
                <?php echo $rendered_content; ?>
            </section>
            <?php include "_footer.php"; ?>
        </section>
        <br/>
    </body>
</html>
