<?php $ci = &get_instance() ?>
<script>
    if(!hmp) var hmp = {};

    hmp.config = {
        url: {
            base: "<?=$baseUrl?>",
            images: "<?=$imagesUrl?>"
        },
        session : {
            PHPSESSID: "<?=$ci->session->userdata('session_id')?>",
        }
    };

    $.ajaxSetup({
        data:{
            PHPSESSID: hmp.config.session.PHPSESSID
        }
    });
 </script>
