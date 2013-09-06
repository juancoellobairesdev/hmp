<div id="notifications">
    <ul>
    </ul>
</div>

<section class="list" id="info">
    <label for="school">School: </label>
    <?php $disabled = count($schools) <= 1? 'disabled': '' ?>
    <select id="school" name="school" <?= $disabled ?> onChange="hmp.tracking.enter.get_teachers()">
        <?php foreach($schools as $school): ?>
            <option value="<?= $school->id ?>"><?= $school->name ?></option>
        <?php endforeach ?>
    </select><br/>

    <label for="teacher">Teacher: </label>
    <?php $disabled = count($teachers) <= 1? 'disabled': '' ?>
    <select id="teacher" name="teacher" <?= $disabled ?> onChange="hmp.tracking.enter.get_grades()">
        <?php foreach($teachers as $teacher): ?>
            <option value="<?= $teacher->id ?>"><?= $teacher->name ?></option>
        <?php endforeach ?>
    </select><br/>

    <label for "month">Reporting Month</label>
    <select id="month" name="month" onChange="hmp.tracking.enter.get_resources()">
        <?php foreach($months as $index => $month): ?>
            <option value="<?= $index ?>" <?= $index==date('m')? 'selected': '' ?>><?= $month ?></option>
        <?php endforeach ?>
    </select><br/>

    <label for "week">Reporting Week</label>
    <select id="week" name="week">
        <option value="1">Week 1</option>
        <option value="2">Week 2</option>
        <option value="3">Week 3</option>
        <option value="4">Week 4</option>
        <option value="5">Week 5</option>
    </select><br/>

    <label for "grade">Grade:</label>
    <?php $disabled = count($grades) <= 1? 'disabled': '' ?>
    <select id="grade" name="grade" <?= $disabled ?>>
        <?php foreach($grades as $index => $grade): ?>
            <option value="<?= $index ?>"><?= $grade ?></option>
        <?php endforeach ?>
    </select><br/>

</section>

<section class="list columns" id="resources">
</section>

<input type="button" value="Submit" onClick="hmp.tracking.enter.submit()">

<script>
    $(document).ready(function(){
        hmp.tracking.enter.get_resources();
    });
</script>