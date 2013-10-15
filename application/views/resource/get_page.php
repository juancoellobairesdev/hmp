<table border="1">
    <tr>
        <th>Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>Minutes Per Use</th>
        <th>Maximum Uses Per Year</th>
        <th>Nutrition</th>
        <th>Minimum Grade</th>
        <th>Maximum Grade</th>
        <th>Enabled</th>
        <th>Weight</th>
    </tr>
    <?php foreach($resources as $resource): ?>
        <tr class="list_row" onclick="window.location='<?= $baseUrl ?>resource/edit_form/<?= $resource->id?>'" style="cursor:pointer">
            <td><?= $resource->id; ?></td>
            <td><?= $categories[$resource->categoryId]->name; ?></td>
            <td><?= $resource->title; ?></td>
            <td><?= $resource->minutesPerUse; ?></td>
            <td><?= $resource->maximumUsesPerYear; ?></td>
            <td><?= $resource->nutrition; ?></td>
            <td><?= $resource->minGrade; ?></td>
            <td><?= $resource->maxGrade; ?></td>
            <td><?= $resource->enabled; ?></td>
            <td><?= $resource->weight; ?></td>
        </tr>
    <?php endforeach; ?>
</table>