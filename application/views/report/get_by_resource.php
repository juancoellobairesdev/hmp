<table border="1">
    <tr>
        <th class="list_cell" onClick="hmp.report.by_school.order_by('month')">Month</th>
        <th class="list_cell" onClick="hmp.report.by_school.order_by('district')">District</th>
        <th class="list_cell" onClick="hmp.report.by_school.order_by('school')">School</th>
        <th class="list_cell" onClick="hmp.report.by_school.order_by('verified')">Verified</th>
        <th class="list_cell" onClick="hmp.report.by_school.order_by('type')">Type</th>
        <th>Cohort</th>
        <th>Students</th>
        <th>Total Minutes Used</th>
    </tr>
    <?php foreach($result as $row): ?>
        <tr>
            <td><?= Misc_helper::str_month($row->month) ?></td>
            <td><?= $row->district ?></td>
            <td><?= $row->school ?></td>
            <td><?= $row->verified? $row->verified: 'No' ?></td>
            <td><?= $row->nutrition ?></td>
            <td><?= $row->cohort ?></td>
            <td><?= $row->numStudents ?></td>
            <td><?= $row->totalMinutesUsed ?></td>
        </tr>
    <?php endforeach ?>
</table>
