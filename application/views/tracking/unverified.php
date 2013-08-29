<div id="notifications">
    <ul>
    </ul>
</div>

<div id="info">
    <label for="school">School:</label>
    <select id="school" name="school" onChange="hmp.tracking.unverified.get_trackings()">
        <?php foreach($schools as $school): ?>
            <option value="<?= $school->id ?>"><?= $school->name ?></option>
        <?php endforeach ?>
    </select>
</div>

<div id="trackings">
</div>

<div id="select_submit" style="display:none">
    <select>
        <option value="verify">Verify</option>
        <option value="delete">Delete</option>
    </select>
    <input type="button" value="Submit" onClick="hmp.tracking.unverified.submit()">
</div>

<script>
    $(document).ready(function(){
        hmp.tracking.unverified.get_trackings();
    });
</script>