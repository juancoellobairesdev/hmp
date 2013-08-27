<div id="notifications">
    <ul>
    </ul>
</div>

<div id="info">
    <p><?= $user->name ?></p>
    <p><?= $school->name ?></p>

    <p>
        <label for "month">Reporting Month</label>
        <select id="month" name="month">
            <?php foreach($months as $index => $month): ?>
                <option value="<?= $index ?>"><?= $month ?></option>
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
        <select id="grades" name="grades" onChange="hmp.tracking.get_resources()">
            <?php foreach($grades as $index => $grade): ?>
                <option value="<?= $index ?>"><?= $grade ?></option>
            <?php endforeach ?>
            <option value=2>2</option>
        </select>
    </p>

    <div id="resources">
        <?php $categoryId = 0 ?>
        <table>
            <tr>
                <th>Resource</th>
                <th>Check if Used</th>
                <th># of Times Used</th>
            </tr>
            <?php foreach($resources as $resource): ?>
                <?php if($categoryId != $resource->categoryId): ?>
                    <tr>
                        <td colspan="3" style="background: #aaaaaa"><?= $resource->name ?></td>
                        <?php $categoryId = $resource->categoryId ?>
                    </tr>
                <?php endif ?>
                <tr>
                    <td><?= $resource->title ?></td>
                    <td><input type="checkbox" name="tracking_resources" value="<?= $resource->id ?>"></td>
                    <td><?= 1 ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>

    <input type="button" value="Submit" onClick="hmp.tracking.enter()">
</div>