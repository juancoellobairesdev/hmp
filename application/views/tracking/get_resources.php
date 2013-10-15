<table class="enter_tracking">
    <tr class="enter_tracking_head">
        <th class="enter_tracking">Resource</th>
        <th class="enter_tracking">Check if Used</th>
        <th class="enter_tracking"># of Times Used</th>
    </tr>
    <?php $tracking_resource_number = 0 ?>
    <?php foreach($resources as $categoryId => $array): ?>
        <?php $tracking_resource_number = ($tracking_resource_number == 3)? 1: ++$tracking_resource_number ?>
        <tr>
            <td colspan="3" class="enter_tracking_category"><?= $categories[$categoryId]->name ?></td>
        </tr>
        <?php foreach($array as $resource): ?>
            <tr class="enter_tracking_resource_<?= $tracking_resource_number ?>">
                <td class="enter_tracking_resource_<?= $tracking_resource_number ?>"><?= $resource->title ?></td>
                <td class="enter_tracking_resource_<?= $tracking_resource_number ?>">
                    <input type="checkbox" id="<?= $resource->id ?>"/>
                </td>
                <td class="enter_tracking_resource_<?= $tracking_resource_number ?>">
                    <select name="tracking_resources" resourceId="<?= $resource->id ?>">
                        <?php for($i=1; $i<=$resource->availableUses; $i++): ?>
                            <option><?= $i ?></option>
                        <?php endfor ?>
                    </select>
                </td>
            </tr>
        <?php endforeach ?>
    <?php endforeach ?>
</table>
