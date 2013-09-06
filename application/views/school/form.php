<div id="notifications">
    <ul>
    </ul>
</div>
<div id="school_form">
    <form action="<?= $baseUrl ?>school/save" method="post" accept-charset="utf-8" id="form" enctype="multipart/form-data">
        <fieldset>
            <legend>Basic Data</legend>
            <?php if($school->id): ?>
                <label for="schoolId">Id:</label>
                <input type="text" id="schoolId" name="schoolId" maxlength="3" size="3" disabled value="<?= intval($school->id) ?>"/><br/>
            <?php endif; ?>

            <label for="districtId">District:</label>
            <select id="districtId" name="districtId">
                <?php foreach($districts as $district): ?>
                    <option value="<?= $district->id ?>" <?= ($district->id == $school->districtId)? 'selected': '' ?>><?= $district->name ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" maxlength="100" size="50" value="<?= $school->name ?>"/><br/>

            <?php if($school->id): ?>
                <label for="startingSchoolYear">Starting School Year:</label>
                <input type="number" id="startingSchoolYear" name="startingSchoolYear" min="2000" max="<?= date('Y') ?>" maxlength="4" size="4" value="<?= $school->startingSchoolYear ?>"/><br/>
            <?php endif ?>

            <label for="classesStartDate">Start Classes Date:</label>
            <input type="date" id="classesStartDate" name="classesStartDate" maxlength="100" size="50" value="<?= $school->classesStartDate ?>"/><br/>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" maxlength="100" size="50" value="<?= $school->address ?>"/><br/>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" maxlength="100" size="50" value="<?= $school->phone ?>"/><br/>

            <label for="fax">Fax:</label>
            <input type="tel" id="fax" name="fax" maxlength="100" size="50" value="<?= $school->fax ?>"/><br/>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" maxlength="100" size="50" value="<?= $school->email ?>"/><br/>

            <label for="shippingContactInfo">Shipping Contact Info:</label>
            <input type="text" id="shippingContactInfo" name="shippingContactInfo" maxlength="100" size="50" value="<?= $school->shippingContactInfo ?>"/><br/>

            <label for="principal">Principal:</label>
            <input type="text" id="principal" name="principal" maxlength="100" size="50" value="<?= $school->principal ?>"/><br/>
        </fieldset>

        <fieldset>
            <legend>Dates and Times</legend>
            <label for="startTimeOfClasses">Start Time of Classes:</label>
            <input type="time" id="startTimeOfClasses" name="startTimeOfClasses" maxlength="100" size="50" value="<?= date('H:i', strtotime($school->startTimeOfClasses)) ?>"/><br/>

            <label for="endTimeOfClasses">End Time of Classes:</label>
            <input type="time" id="endTimeOfClasses" name="endTimeOfClasses" maxlength="100" size="50" value="<?= date('H:i', strtotime($school->endTimeOfClasses)) ?>"/><br/>

            <label for="fallBreakDates">Fall Break Dates:</label>
            <input type="text" id="fallBreakDates" name="fallBreakDates" maxlength="100" size="50" value="<?= $school->fallBreakDates ?>"/><br/>

            <label for="winterBreakDates">Winter Break Dates:</label>
            <input type="text" id="winterBreakDates" name="winterBreakDates" maxlength="100" size="50" value="<?= $school->winterBreakDates ?>"/><br/>

            <label for="springBreakDates">Spring Break Dates:</label>
            <input type="text" id="springBreakDates" name="springBreakDates" maxlength="100" size="50" value="<?= $school->springBreakDates ?>"/><br/>

            <label for="itbsTestingDates">Itbs Testing Dates:</label>
            <input type="text" id="itbsTestingDates" name="itbsTestingDates" maxlength="100" size="50" value="<?= $school->itbsTestingDates ?>"/><br/>

            <label for="writingAssessmentDates">Writing Assessment Dates:</label>
            <input type="text" id="writingAssessmentDates" name="writingAssessmentDates" maxlength="100" size="50" value="<?= $school->writingAssessmentDates ?>"/><br/>

            <label for="crctTestingDates">Crct Testing Dates:</label>
            <input type="text" id="crctTestingDates" name="crctTestingDates" maxlength="100" size="50" value="<?= $school->crctTestingDates ?>"/><br/>
        </fieldset>

        <fieldset>
            <legend>Management</legend>

            <label for="administrator">Administrator:</label>
            <input type="text" id="administrator" name="administrator" maxlength="100" size="50" value="<?= $administrator->name ?>" onKeyUp="hmp.school.form.same_as_administrator()"/><br/>

            <label for="administratorsEmail">Administrator's email:</label>
            <input type="email" id="administratorsEmail" name="administratorsEmail" maxlength="100" size="50" value="<?= $administrator->email ?>" onKeyUp="hmp.school.form.same_as_administrator()"/><br/>

            <label for="sameAsAdministrator">Administrator is verifier:</label>
            <input type="checkbox" id="sameAsAdministrator" name="sameAsAdministrator" value="1" onclick="hmp.school.form.copy_administrator()"></br>

            <label for="verifier">Verifier:</label>
            <input type="text" id="verifier" name="verifier" maxlength="100" size="50" value="<?= $verifier->name ?>"/><br/>

            <label for="verifiersEmail">Verifier's email:</label>
            <input type="email" id="verifiersEmail" name="verifiersEmail" maxlength="100" size="50" value="<?= $verifier->email ?>"/><br/>

            As principal, do you want to be cc’d on all communication to the local school contact(s)?  This would include e-mails for scheduling, electronic newsletters and reminders:<br/>
            <label for="principalCarbonCopied">Cc'd:</label>
            <input type="radio" id="principalCarbonCopied" name="principalCarbonCopied" <?= $school->principalCarbonCopied? 'checked': '' ?> value="1">Yes
            <input type="radio" id="principalCarbonCopied" name="principalCarbonCopied" <?= $school->principalCarbonCopied? '': 'checked' ?> value="0">No</br>

            <label for="approveNewsletterCommunication">News Letter Communication:</label>
            <input type="radio" id="approveNewsletterCommunication" name="approveNewsletterCommunication" <?= $school->approveNewsletterCommunication? 'checked': '' ?> value="1">Yes
            <input type="radio" id="approveNewsletterCommunication" name="approveNewsletterCommunication" <?= $school->approveNewsletterCommunication? '': 'checked' ?> value="0">No</br>

            <label for="approveReminderPrompts">Reminder Prompt:</label>
            <input type="radio" id="approveReminderPrompts" name="approveReminderPrompts" <?= $school->approveReminderPrompts? 'checked': '' ?> value="1">Yes
            <input type="radio" id="approveReminderPrompts" name="approveReminderPrompts" <?= $school->approveReminderPrompts? '': 'checked' ?> value="0">No</br>

            <label for="userfile">Teachers CSV:</label>
            <input type="file" size="60" name="userfile" onChange="hmp.school.form.check_upload()">
            <div id="check_upload">
            </div>
            <div id="progress" style="margin-left: 150px;">
                <div id="bar"></div>
                <div id="percent">0%</div >
            </div>
        </fieldset>

        <div id="form_buttons">
            <input type="submit" value="Save">
            <?php if(!$school->id): ?>
                <input type="reset" value="Reset"/>
            <?php endif ?>
        </div>
    </form>
</div>

<script>
    var options = hmp.school.form.options;
    hmp.school.form.options.data.schoolId = $('#schoolId').val();
    $("#form").ajaxForm(options);
</script>