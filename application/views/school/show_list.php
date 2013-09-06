<div id="pagination_top">
    <?= $pagination_html ?>
</div>

<section class="list" id="school">
</section>

<div id="pagination_bottom">
    <?= $pagination_html ?>
</div>

<script>
    $(document).ready(function(){
        hmp.page('<?= $pagination->controller ?>', <?= $pagination->current ?>);
    });
</script>