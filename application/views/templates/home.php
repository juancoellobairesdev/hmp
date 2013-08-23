<!DOCTYPE html> 
<html lang="en">
    <head>
        <link rel="shortcut icon" href="<?=$imagesUrl?>favicon.ico">
        <?php include '_head.php'; ?>
        <?php include '_config.php'; ?>
    </head>
    <body>
        <?php include "_header.php"; ?>
        <div class="maincont">
            <div class="bodycont">
                <p>
                    <?php echo $rendered_content; ?>
                </p>
            </div>

            <?php include "_footer.php"; ?>
        </div>
    </body>
</html>
