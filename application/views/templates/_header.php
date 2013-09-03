<header id="headercont" class="header">
    <div id="banner">
        <table class="banner" cellspacing="0px" cellpadding="0px" border="0">
            <tr>
                <td><img src="<?= $imagesUrl ?>logo.jpg"/></td>
                <td><img src="<?= $imagesUrl ?>divider1.jpg"/></td>
                <td><img src="<?= $imagesUrl ?>banner1.jpg"/></td>
                <td><img src="<?= $imagesUrl ?>divider2.jpg"/></td>
                <td><img src="<?= $imagesUrl ?>banner2.jpg"/></td>
            </tr>
        </table>
    </div>
    <nav>
        <?= Menu::menu_to_html($menu) ?>
    </nav>
</header><br>