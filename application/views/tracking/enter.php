<div id="notifications">
    <ul>
    </ul>
</div>

<div id="info">
    <p><span id="teacher" value="<?= $teacher->id ?>"><?= $user->name ?></span></p>
    <p><span id="school" value="<?= $school->id ?>" <?= $school->name ?></p>

    <p>
        <label for "month">Reporting Month</label>
        <select id="month" name="month">
            <?php foreach($months as $index => $month): ?>
                <option value="<?= $index ?>" <?= $index==date('m')? 'selected': '' ?>><?= $month ?></option>
            <?php endforeach ?>
        </select>
    </p>

    <p>
        <label for "week">Reporting Week</label>
        <select id="week" name="week">
            <option value="1">Week 1</option>
            <option value="2">Week 2</option>
            <option value="3">Week 3</option>
            <option value="4">Week 4</option>
            <option value="5">Week 5</option>
        </select>
    </p>

    <p>
        <label for "grades">Grade:</label>
        <?php if(count($grades) > 1): ?>
            <select id="grades" name="grades" onChange="hmp.tracking.get_resources()">
                <?php foreach($grades as $index => $grade): ?>
                    <option value="<?= $index ?>"><?= $grade ?></option>
                <?php endforeach ?>
            </select>
        <?php else: ?>
            <span id="grades" name="grades"><?= $grades[0] ?></span>
        <?php endif ?>
    </p>

    <div id="resources">
    </div>

    <input type="button" value="Submit" onClick="hmp.tracking.submit()">
</div>

<script>
    $(document).ready(function(){
        hmp.tracking.get_resources();
    });
</script>