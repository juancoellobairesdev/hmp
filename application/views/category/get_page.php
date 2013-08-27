<table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Minimum Cohort</th>
        <th>Maximum Cohort</th>
        <th>Weight</th>
    </tr>
    <?php foreach($categories as $category): ?>
        <tr class="list_row" onclick="window.location='<?= $baseUrl ?>category/edit_form/<?= $category->id?>'" style="cursor:pointer">
            <th><?= $category->id; ?></th>
            <th><?= $category->name; ?></th>
            <th><?= $category->minCohort; ?></th>
            <th><?= $category->maxCohort; ?></th>
            <th><?= $category->weight; ?></th>
        </tr>
    <?php endforeach; ?>
</table>