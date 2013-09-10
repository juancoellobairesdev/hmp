<table border="1">
    <tr>
        <th>Month</th>
        <th>District</th>
        <th>School</th>
        <th>Grade Level</th>
        <th>Teacher</th>
        <th>Category</th>
        <th>Resource</th>
        <th>Minutes Per Use</th>
        <th>Times Used</th>
        <th>Maximum Uses Per Month</th>
        <th>Minutes Used</th>
        <th>Total Possible Use</th>
    </tr>
    <?php foreach($result as $row): ?>
        <tr>
            <td><?= Misc_helper::str_month($row->month) ?></td>
            <td><?= $row->district ?></td>
            <td><?= $row->school ?></td>
            <td><?= $row->gradeLevel ?></td>
            <td><?= $row->teacher ?></td>
            <td><?= $row->category ?></td>
            <td><?= $row->resource ?></td>
            <td><?= $row->minutesPerUse ?></td>
            <td><?= $row->timesUsed ?></td>
            <td><?= $row->maximumUsesPerMonth ?></td>
            <td><?= $row->minutesUsed ?></td>
            <td><?= $row->totalPossibleTime ?></td>
        </tr>
    <?php endforeach ?>
</table>
