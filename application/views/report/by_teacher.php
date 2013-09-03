<div id="notifications">
    <ul>
    </ul>
</div>

<div id="info">
    <label for="year">Year:</label>
    <select id="year" name="year">
        <?php foreach($years as $year): ?>
            <option value="<?= $year ?>"><?= $year ?></option>
        <?php endforeach ?>
    </select><br/>

    <label for="month">Month:</label>
    <select id="month" name="month">
        <?php foreach($months as $index => $month): ?>
            <option value="<?= $index ?>"><?= $month ?></option>
        <?php endforeach ?>
    </select><br/>

    <label for="school">School:</label>
    <?php $disabled = (count($schools) <= 1)? 'disabled': '' ?>
    <select id="school" name="school" <?= $disabled ?> onChange="hmp.report.by_teacher.get_teachers()">
        <?php foreach($schools as $school): ?>
            <option value="<?= $school->id ?>"><?= $school->name ?></option>
        <?php endforeach ?>
    </select><br/>
    <?php if(count($schools) <= 1): ?>
        <script>
            hmp.report.by_teacher.get_teachers();
        </script>
    <?php endif ?>

    <label for="grade">Grade:</label>
    <?php $disabled = (count($schools) <= 1)? 'disabled': '' ?>
    <select id="grade" name="grade" <?= $disabled ?>>
        <?php foreach($grades as $index => $grade): ?>
            <option value="<?= $index ?>"><?= $grade ?></option>
        <?php endforeach ?>
    </select><br/>

    <div id="teacher_cont">
        <label for="teacher">Teacher:</label>
        <select id="teacher" name="teacher" disabled></select>
    </div><br/>

    <input type="hidden" id="order_by" value="month" side="asc"/>

    <input type="button" value="Search" onClick="hmp.report.by_teacher.search()"/>
    <input type="button" value="Download CSV" onClick="hmp.report.by_teacher.download()"/>
</div>

<div id="report">
</div>

<script>
    $(document).ready(function(){
        hmp.report.by_teacher.search();
    });
</script>