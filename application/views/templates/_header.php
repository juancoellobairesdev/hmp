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
    <ul class="menu">
        <li><a href="#">Resource Categories</a>
            <ul>
                <li><a href="<?= $baseUrl . 'category/show_list' ?>">List</a></li>
                <li><a href="<?= $baseUrl . 'category/add_form' ?>">Add...</a></li>
            </ul>
        </li>
        <li><a href="#">School Resources</a>
            <ul>
                <li><a href="<?= $baseUrl . 'resource/show_list' ?>">List</a></li>
                <li><a href="<?= $baseUrl . 'resource/add_form' ?>">Add...</a></li>
            </ul>
        </li>
        <li><a href="#">Participating Schools</a>
            <ul>
                <!--li><a href="<?= $baseUrl . 'school/show_list' ?>">List</a></li-->
                <li><a href="<?= $baseUrl . 'school/add_form' ?>">Become a Participating School</a></li>
            </ul>
        </li>
        <?php if($this->session->userdata('userId')): ?>
            <li><a href="#">Profile</a>
                <ul>
                    <li><a href="<?= $baseUrl . 'user/change_password_form'?>">Change Password</a></li>
                    <li><a href="<?= $baseUrl . 'user/logout' ?>">Logout</a>
                </ul>
        <?php else: ?>
            <li><a href="<?= $baseUrl . 'user/login_form' ?>">Login</a>
        <?php endif ?>
        </li>
    </ul>
</div><br>