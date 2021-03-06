<div id="notifications">
    <ul>
    </ul>
</div>
<div id="resource_form">
    <form>
        <?php if($resource->id): ?>
            <label for="id">Id:</label>
            <input type="text" id="id" name="id" maxlength="3" size="3" disabled value="<?= intval($resource->id) ?>"/><br/>
        <?php endif; ?>

        <label for="categoryId">Category:</label>
        <select id="categoryId" name="categoryId">
            <?php foreach($categories as $category): ?>
                <option value="<?= $category->id ?>" <?= ($category->id == $resource->categoryId)? 'selected': '' ?>><?= $category->name ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" maxlength="100" size="50" value="<?= $resource->title ?>"/><br/>

        <label for="minutesPerUse">Minutes Per Use:</label>
        <input type="text" id="minutesPerUse" name="minutesPerUse" maxlength="3" size="3" value="<?= $resource->minutesPerUse? intval($resource->minutesPerUse): 1 ?>"/><br/>

        <label for="maximumUsesPerYear">Maximum Uses Per Year:</label>
        <input type="text" id="maximumUsesPerYear" name="maximumUsesPerYear" maxlength="2" size="2" value="<?= $resource->maximumUsesPerYear? intval($resource->maximumUsesPerYear): 1 ?>"/><br/>

        <label for="nutrition">Nutrition:</label>
        <select id="nutrition" name="nutrition">
            <option value="0" <?= ($resource->nutrition == 0)? 'selected': '' ?>>PA</option>
            <option value="1" <?= ($resource->nutrition == 1)? 'selected': '' ?>>N</option>
        </select><br/>

        <label for="minGrade">Minimum Grade:</label>
        <select id="minGrade" name="minGrade">
            <?php foreach($grades as $index => $grade): ?>
                <option value="<?= $index ?>" <?= ($resource->minGrade == $index)? 'selected': '' ?>><?= $grade ?></option>
            <?php endforeach ?>
        </select><br/>

        <label for="maxGrade">Maximum Grade:</label>
        <select id="maxGrade" name="maxGrade">
            <?php foreach($grades as $index => $grade): ?>
                <option value="<?= $index ?>" <?= ($resource->maxGrade == $index)? 'selected': '' ?>><?= $grade ?></option>
            <?php endforeach ?>
        </select><br/>

        <label for="enabled">Enabled:</label>
        <select id="enabled" name="enabled">
            <option value="0" <?= ($resource->enabled == 0)? 'selected': '' ?>>Disabled</option>
            <option value="1" <?= ($resource->enabled == 1)? 'selected': '' ?>>Enabled</option>
        </select><br/>

        <label for="weight">Weight:</label>
        <input type="text" id="weight" name="weight" maxlength="2" size="2" value="<?= intval($resource->weight) ?>"/><br/>

        <input type="button" value="Save" onclick="hmp.resource.save();">
        <input type="reset" value="Reset"/>
    </form>
</div>