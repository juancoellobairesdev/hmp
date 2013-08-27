<div id="pagination_top">
    <a name="first" href="javascript:;" onclick="hmp.category.page(<?= $pagination->first ?>);" value="<?= $pagination->first ?>">First</a>
    <a name="prev" href="javascript:;" onclick="hmp.category.page(<?= $pagination->prev ?>);" value="<?= $pagination->prev ?>">Prev</a>
    <span name="current" value="<?= $pagination->current ?>"><?= $pagination->current ?></span>
    <a name="next" href="javascript:;" onclick="hmp.category.page(<?= $pagination->next ?>);" value="<?= $pagination->next ?>">Next</a>
    <a name="last" href="javascript:;" onclick="hmp.category.page(<?= $pagination->last ?>);" value="<?= $pagination->last ?>">Last</a>
</div>
<a href="<?= $baseUrl ?>category/add_form"><input type="button" value="add"/></a>
<div id="categories">
</div>
<div id="pagination_bottom">
    <a name="first" href="javascript:;" onclick="hmp.category.page(<?= $pagination->first ?>);" value="<?= $pagination->first ?>">First</a>
    <a name="prev" href="javascript:;" onclick="hmp.category.page(<?= $pagination->prev ?>);" value="<?= $pagination->prev ?>">Prev</a>
    <span name="current" value="<?= $pagination->current ?>"><?= $pagination->current ?></span>
    <a name="next" href="javascript:;" onclick="hmp.category.page(<?= $pagination->next ?>);" value="<?= $pagination->next ?>">Next</a>
    <a name="last" href="javascript:;" onclick="hmp.category.page(<?= $pagination->last ?>);" value="<?= $pagination->last ?>">Last</a>
</div>
<script>
    $(document).ready(function(){
        hmp.category.page(<?= $pagination->current ?>);
    });
</script>