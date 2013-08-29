<div id="headercont" class="header">
    <div id="banner">
        <center>
            <table class="banner" cellspacing="0px" cellpadding="0px" border="0">
                <tr>
                    <td><img src="<?= $imagesUrl ?>logo.jpg"/></td>
                    <td><img src="<?= $imagesUrl ?>divider1.jpg"/></td>
                    <td><img src="<?= $imagesUrl ?>banner1.jpg"/></td>
                    <td><img src="<?= $imagesUrl ?>divider2.jpg"/></td>
                    <td><img src="<?= $imagesUrl ?>banner2.jpg"/></td>
                </tr>
            </table>
        </center>
    </div>

    <?= Menu::menu_to_html($menu) ?>
</div><br>