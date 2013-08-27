<table border="1">
    <tr>
        <th>Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>Minutes Per Use</th>
        <th>Maximum Uses Per Month</th>
        <th>Nutrition</th>
        <th>Minimum Grade</th>
        <th>Maximum Grade</th>
        <th>Enabled</th>
        <th>Weight</th>
    </tr>
    <?php foreach($resources as $resource): ?>
        <tr class="resource_row" onclick="window.location='<?= $baseUrl ?>resource/edit_form/<?= $resource->id?>'" style="cursor:pointer">
            <th><?= $resource->id; ?></th>
            <th><?= $categories[$resource->categoryId]->name; ?></th>
            <th><?= $resource->title; ?></th>
            <th><?= $resource->minutesPerUse; ?></th>
            <th><?= $resource->maximumUsesPerMonth; ?></th>
            <th><?= $resource->nutrition; ?></th>
            <th><?= $resource->minGrade; ?></th>
            <th><?= $resource->maxGrade; ?></th>
            <th><?= $resource->enabled; ?></th>
            <th><?= $resource->weight; ?></th>
        </tr>
    <?php endforeach; ?>
</table>