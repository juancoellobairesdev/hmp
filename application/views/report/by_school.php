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

    <label for="district">District:</label>
    <?php $disabled = (count($districts) <= 1)? 'disabled': '' ?>
    <select id="district" name="district" <?= $disabled ?> onChange="hmp.report.by_school.get_schools()">
        <?php foreach($districts as $district): ?>
            <option value="<?= $district->id ?>"><?= $district->name ?></option>
        <?php endforeach ?>
    </select><br/>
    <?php if(count($districts) <= 1): ?>
        <script>
            hmp.report.by_school.get_schools();
        </script>
    <?php endif ?>

    <label for="cohort">Cohort:</label>
    <select id="cohort" name="cohort">
        <?php foreach($cohorts as $index => $cohort): ?>
            <option value="<?= $index ?>"><?= $cohort ?></option>
        <?php endforeach ?>
    </select><br/>

    <div id="schools_cont">
        <label for="school">School:</label>
        <select id="school" name="school" disabled>
        </select>
    </div>

    <div id="verified_cont" onClick="hmp.report.by_school.verified()">
        <label for="verified">Verified:</label>
        No<input type="radio" name="verified" checked value="0">
        Yes<input type="radio" name="verified" value="1">
        After date<input type="text" name="verified" disabled value="">
    </div>

    <input type="hidden" id="order_by" value="month" side="asc"/>

    <input type="button" value="Search" onClick="hmp.report.by_school.search()"/>
    <input type="button" value="Download CSV" onClick="hmp.report.by_school.download()"/>
</div>

<div id="report">
</div>

<script>
    $(document).ready(function(){
        //hmp.report.by_school.search();
    });
</script>