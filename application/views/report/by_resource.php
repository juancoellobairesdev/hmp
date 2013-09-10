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

        <label for="school">School:</label>
        <?php $disabled = (count($schools) <= 1)? 'disabled': '' ?>
        <select id="school" name="school" <?= $disabled ?> onChange="hmp.report.by_teacher.get_teachers()">
            <?php foreach($schools as $school): ?>
                <option value="<?= $school->id ?>"><?= $school->name ?></option>
            <?php endforeach ?>
        </select><br/>

        <label for="cohort">Cohort:</label>
        <select id="cohort" name="cohort">
            <?php foreach($cohorts as $index => $cohort): ?>
                <option value="<?= $index ?>"><?= $cohort ?></option>
            <?php endforeach ?>
        </select><br/>

        <label for="grade">Grade:</label>
        <?php $disabled = (count($grades) <= 1)? 'disabled': '' ?>
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

        <input type="hidden" id="order_by" value="month" side="asc"/>
    </fieldset>

    <input type="button" value="Search" onClick="hmp.report.by_resource.search()"/>
    <input type="button" value="Download CSV" onClick="hmp.report.by_resource.download()"/>
</section>

<section class="list" id="report">
</section>

<script>
    $(document).ready(function(){
        hmp.report.by_resource.search();
    });
</script>