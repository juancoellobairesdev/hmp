<?php if($trackings): ?>
    <table border="1">
        <tr>
            <th>Select</th>
            <th>Teacher</th>
            <th>Entered Date</th>
            <th>Track Date</th>
            <th>Reporting Month</th>
            <th>Reporting Week</th>
        </tr>
        <?php foreach($trackings as $tracking): ?>
            <tr>
                <td><input type="checkbox" name="tracking" value="<?= $tracking->id ?>"></td>
                <td><?= $tracking->user->name ?></td>
                <td><?= date('m-d-Y', strtotime($tracking->entered)) ?></td>
                <td><?= date('m-d-Y', strtotime($tracking->trackDate)) ?></td>
                <td><?= Misc_helper::str_month($tracking->reportingMonth) ?></td>
                <td><?= $tracking->reportingWeek ?></td>
            </tr>
        <?php endforeach ?>
            <tr>
                <td colspan="6"><input type="checkbox" id="select_all" onClick="hmp.tracking.unverified.select_all()"><span id="select_all_text">Select All</span></td>
            </tr>
    </table>
    <script>$('#select_submit').show();</script>
<?php else: ?>
    <span id="nothing">Nothing to verify.</span>
    <script>$('#select_submit').hide();</script>
<?php endif ?>

