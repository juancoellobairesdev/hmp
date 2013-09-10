<div id="notifications">
    <ul>
    </ul>
</div>

<section class="list" id="info">
    <fieldset>
        <legend>Filters</legend>
        <label for="year">Up To Year:</label>
        <select id="year" name="year">
            <?php foreach($years as $year): ?>
                <option value="<?= $year ?>"><?= $year ?></option>
            <?php endforeach ?>
        </select><br/>

        <label for="month">Up To Month:</label>
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

        <div id="teacher_cont">
            <label for="teacher">Teacher:</label>
            <select id="teacher" name="teacher" disabled>
                <?php foreach($teachers as $teacher): ?>
                    <option value="<?= $teacher->id ?>"><?= $teacher->name ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <label for="grade">Grade:</label>
        <?php $disabled = (count($schools) <= 1)? 'disabled': '' ?>
        <select id="grade" name="grade" <?= $disabled ?>>
            <?php foreach($grades as $index => $grade): ?>
                <option value="<?= $index ?>"><?= $grade ?></option>
            <?php endforeach ?>
        </select><br/>

        <label for="group_by">Group By:</label>
        <select id="group_by" name="group_by">
            <?php foreach($group_by as $index => $value): ?>
                <option value="<?= $index ?>"><?= $value ?></option>
            <?php endforeach ?>
        </select><br/>
    </fieldset>
    
    <input type="button" value="Search" onClick="hmp.report.by_teacher.search()"/>
    <input type="button" value="Download CSV" onClick="hmp.report.by_teacher.download()"/>
</section>

<section class="list" id="report">
</section>

<script>
    $(document).ready(function(){
        hmp.report.by_teacher.search();
    });
</script>