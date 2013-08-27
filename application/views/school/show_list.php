<div id="pagination_top">
    <a name="first" href="javascript:;" onclick="hmp.resource.page(<?= $pagination->first ?>);" value="<?= $pagination->first ?>">First</a>
    <a name="prev" href="javascript:;" onclick="hmp.resource.page(<?= $pagination->prev ?>);" value="<?= $pagination->prev ?>">Prev</a>
    <span name="current" value="<?= $pagination->current ?>"><?= $pagination->current ?></span>
    <a name="next" href="javascript:;" onclick="hmp.resource.page(<?= $pagination->next ?>);" value="<?= $pagination->next ?>">Next</a>
    <a name="last" href="javascript:;" onclick="hmp.resource.page(<?= $pagination->last ?>);" value="<?= $pagination->last ?>">Last</a>
</div>
<a href="<?= $baseUrl ?>resource/add_form"><input type="button" value="add"/></a>
<div id="resources">
</div>
<div id="pagination_bottom">
    <a name="first" href="javascript:;" onclick="hmp.resource.page(<?= $pagination->first ?>);" value="<?= $pagination->first ?>">First</a>
    <a name="prev" href="javascript:;" onclick="hmp.resource.page(<?= $pagination->prev ?>);" value="<?= $pagination->prev ?>">Prev</a>
    <span name="current" value="<?= $pagination->current ?>"><?= $pagination->current ?></span>
    <a name="next" href="javascript:;" onclick="hmp.resource.page(<?= $pagination->next ?>);" value="<?= $pagination->next ?>">Next</a>
    <a name="last" href="javascript:;" onclick="hmp.resource.page(<?= $pagination->last ?>);" value="<?= $pagination->last ?>">Last</a>
</div>
<script>
    $(document).ready(function(){
        hmp.resource.page(<?= $pagination->current ?>);
    });
</script>