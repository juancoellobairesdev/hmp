<div id="notifications">
    <ul>
    </ul>
</div>
<div id="teacher_form">
    <form>
        <?php if($teacher->id): ?>
            <label for="id">Id:</label>
            <input type="text" id="id" name="id" maxlength="3" size="3" disabled value="<?= intval($teacher->id) ?>"/><br/>
        <?php endif; ?>

        <lable for="name">Name:</label>
        <input type="text" id="name" name="name" maxlength="100" size="50" value="<?= $teacher->name ?>"/><br/>

        <lable for="email">Email:</label>
        <input type="text" id="email" name="email" maxlength="100" size="50" value="<?= $teacher->email ?>"/><br/>

        <lable for="email">Email:</label>
        <select id="email" name="email">
            <?php foreach($cohorts as $cohort): ?>
                <option value="<?= $cohort ?>" <?= ($teacher->minCohort == $cohort)? 'selected': '' ?>><?= $cohort ?></option>
            <?php endforeach ?>
        </select><br/>

        <lable for="maxCohort">Maximum Cohort:</label>
        <select id="maxCohort" name="maxCohort">
            <?php foreach($cohorts as $cohort): ?>
                <option value="<?= $cohort ?>" <?= ($teacher->maxCohort == $cohort)? 'selected': '' ?>><?= $cohort ?></option>
            <?php endforeach ?>
        </select><br/>

        <lable for="weight">Weight:</label>
        <input type="text" id="weight" name="weight" maxlength="2" size="2" value="<?= intval($teacher->weight) ?>"/><br/>

        <input type="button" value="Save" onclick="hmp.teacher.save();">
        <input type="reset" value="Reset"/>
    </form>
</div>