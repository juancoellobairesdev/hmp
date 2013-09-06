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
            <td><?= $category->id; ?></td>
            <td><?= $category->name; ?></td>
            <td><?= $category->minCohort; ?></td>
            <td><?= $category->maxCohort; ?></td>
            <td><?= $category->weight; ?></td>
        </tr>
    <?php endforeach; ?>
</table>