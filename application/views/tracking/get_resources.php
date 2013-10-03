<?php $categoryId = 0 ?>
<table border="1">
    <tr>
        <th>Resource</th>
        <th>Check if Used</th>
        <th># of Times Used</th>
    </tr>
    <?php foreach($resources as $categoryId => $array): ?>
        <tr>
            <td colspan="3" style="background: #aaaaaa"><?= $categories[$categoryId]->name ?></td>
        </tr>
        <?php foreach($array as $resource): ?>
            <tr>
                <td><?= $resource->title ?></td>
                <td>
                    <input type="checkbox" id="<?= $resource->id ?>"/>
                </td>
                <td>
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
