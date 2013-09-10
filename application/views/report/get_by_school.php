<table border="1">
    <tr>
        <th>Month</th>
        <th>District</th>
        <th>School</th>
        <th>Verified</th>
        <th>Type</th>
        <th>Cohort</th>
        <th>Students</th>
        <th>Total Minutes Used</th>
        <th>Teacher Usage</th>
        <th>Student Usage</th>
        <th>Actual Time</th>
    </tr>
    <?php foreach($result as $row): ?>
        <tr>
            <td><?= Misc_helper::str_month($row->month) ?></td>
            <td><?= $row->district ?></td>
            <td><?= $row->school ?></td>
            <td><?= $row->verified? $row->verified: 'No' ?></td>
            <td><?= $row->nutrition ?></td>
            <td><?= $row->cohort ?></td>
            <td><?= $row->students ?></td>
            <td><?= $row->totalMinutesUsed ?></td>
            <td><?= $row->teacherUsage ?></td>
            <td><?= $row->studentUsage ?></td>
            <td><?= $row->actualTime ?></td>
        </tr>
    <?php endforeach ?>
</table>
