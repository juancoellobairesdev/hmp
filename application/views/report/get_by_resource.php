<table border="1">
    <tr>
        <th>Category</th>
        <th>Resource</th>
        <th>Grade Level</th>
        <th>Total Teachers</th>
        <th>Total Students</th>
        <th>Teacher Usage</th>
        <th>Student Usage</th>
        <th>Minutes of Instruction</th>
    </tr>
    <?php foreach($result as $row): ?>
        <tr>
            <td><?= $row->category ?></td>
            <td><?= $row->resource ?></td>
            <td><?= $row->gradeLevel ?></td>
            <td><?= $row->teachers ?></td>
            <td><?= $row->students ?></td>
            <td><?= $row->teacherUsage ?></td>
            <td><?= $row->studentUsage ?></td>
            <td><?= $row->minutesOfInstruction ?></td>
        </tr>
    <?php endforeach ?>
</table>
