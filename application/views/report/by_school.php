<div id="notifications">
    <ul>
    </ul>
</div>

<section class="list" id="info">
    <fieldset>
        <legend>Filters</legend>

        <label for="date">Search Date:</label>
        <input type="radio" name="date" checked value="0" onClick="hmp.report.by_school.date()">Up To
        <input type="radio" name="date" value="1" onClick="hmp.report.by_school.date()">Between<br/>

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
        </select>

        <div id="monthBetween" style="display:none">
        and Month
        <select id="andMonth" name="andMonth">
            <?php foreach($months as $index => $month): ?>
                <?php if($index): ?>
                    <option value="<?= $index ?>"><?= $month ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
        </div>
        <br/>

        <label for="late">Late:</label>
        <select id="late" name="late">
            <?php foreach($lates as $index => $late): ?>
                <option value="<?= $index ?>"><?= $late ?></option>
            <?php endforeach ?>
        </select>
        <br/>

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
                <?php foreach($schools as $school): ?>
                    <option value="<?= $school->id ?>"><?= $school->name ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div id="verified_cont" onClick="hmp.report.by_school.verified()">
            <label for="verified">Verified:</label>
            <input type="radio" name="verified" checked value="0">No
            <input type="radio" name="verified" value="1">Yes
            <input type="date" id="afterDate" name="afterDate" disabled value="">After Date (Leave blank to show all)
        </div>

        <input type="hidden" id="order_by" value="month" side="asc"/>
    </fieldset>

    <input type="button" value="Search" onClick="hmp.report.by_school.search()"/>
    <input type="button" value="Download CSV" onClick="hmp.report.by_school.download()"/>
</section>

<section class="list" id="report">
</section>

<script>
    $(document).ready(function(){
        hmp.report.by_school.search();
    });
</script>