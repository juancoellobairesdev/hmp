<?php $categoryId = 0 ?>
<table>
    <tr>
        <th>Resource</th>
        <th>Check if Used</th>
        <th># of Times Used</th>
    </tr>
    <?php foreach($resources as $resource): ?>
        <?php if($categoryId != $resource->categoryId): ?>
            <tr>
                <td colspan="3" style="background: #aaaaaa"><?= $resource->name ?></td>
                <?php $categoryId = $resource->categoryId ?>
            </tr>
        <?php endif ?>
        <tr>
            <td><?= $resource->title ?></td>
            <td>
                <?php if($resource->maximumUsesPerMonth > 1): ?>
                    <select name="tracking_resources" resourceId="<?= $resource->id ?>">
                        <?php for($i=0; $i<=$resource->availableUses; $i++): ?>
                            <option><?= $i ?></option>
                        <?php endfor ?>
                    </select>
                <?php else: ?>
                    <input type="checkbox" name="tracking_resources" value="<?= $resource->id ?>">
                <?php endif ?>
            </td>
            <td><?= $resource->timesUsed ?></td>
        </tr>
    <?php endforeach ?>
</table>
