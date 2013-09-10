<table border="1">
    <tr>
        <th class="list_cell" onClick="hmp.report.by_teacher.order_by('month')">Month</th>
        <th class="list_cell" onClick="hmp.report.by_teacher.order_by('district')">District</th>
        <th class="list_cell" onClick="hmp.report.by_teacher.order_by('school')">School</th>
        <th class="list_cell" onClick="hmp.report.by_teacher.order_by('grade')">Grade Level</th>
        <th class="list_cell" onClick="hmp.report.by_teacher.order_by('teacher')">Teacher</th>
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
