<div id="notifications">
    <ul>
    </ul>
</div>
<div id="category_form">
    <form>
        <?php if($category->id): ?>
            <label for="id">Id:</label>
            <input type="text" id="id" name="id" maxlength="3" size="3" disabled value="<?= intval($category->id) ?>"/><br/>
        <?php endif; ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" maxlength="100" size="50" value="<?= $category->name ?>"/><br/>

        <label for="minCohort">Minimum Cohort:</label>
        <select id="minCohort" name="minCohort">
            <?php foreach($cohorts as $cohort): ?>
                <option value="<?= $cohort ?>" <?= ($category->minCohort == $cohort)? 'selected': '' ?>><?= $cohort ?></option>
            <?php endforeach ?>
        </select><br/>

        <label for="maxCohort">Maximum Cohort:</label>
        <select id="maxCohort" name="maxCohort">
            <?php foreach($cohorts as $cohort): ?>
                <option value="<?= $cohort ?>" <?= ($category->maxCohort == $cohort)? 'selected': '' ?>><?= $cohort ?></option>
            <?php endforeach ?>
        </select><br/>

        <label for="weight">Weight:</label>
        <input type="text" id="weight" name="weight" maxlength="2" size="2" value="<?= intval($category->weight) ?>"/><br/>

        <input type="button" value="Save" onclick="hmp.category.save();">
        <input type="reset" value="Reset"/>
    </form>
</div>