<div id="notifications">
    <ul>
    </ul>
</div>
<div id="school_form">
    <form action="<?= $baseUrl ?>school/save" method="post" accept-charset="utf-8" id="form" enctype="multipart/form-data">
        <?php if($school->id): ?>
            <label for="id">Id:</label>
            <input type="text" id="id" name="id" maxlength="3" size="3" disabled value="<?= intval($school->id) ?>"/><br/>
        <?php endif; ?>

        <lable for="name">Name:</label>
        <input type="text" id="name" name="name" maxlength="100" size="50" value="<?= $school->name ?>"/><br/>

        <lable for="startingSchoolYear">Starting School Year:</label>
        <input type="text" id="startingSchoolYear" name="startingSchoolYear" maxlength="100" size="50" value="<?= $school->startingSchoolYear ?>"/><br/>

        <lable for="classesStartDate">Start Classes Date:</label>
        <input type="text" id="classesStartDate" name="classesStartDate" maxlength="100" size="50" value="<?= $school->classesStartDate ?>"/><br/>

        <lable for="address">Address:</label>
        <input type="text" id="address" name="address" maxlength="100" size="50" value="<?= $school->address ?>"/><br/>

        <lable for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" maxlength="100" size="50" value="<?= $school->phone ?>"/><br/>

        <lable for="fax">Fax:</label>
        <input type="text" id="fax" name="fax" maxlength="100" size="50" value="<?= $school->fax ?>"/><br/>

        <lable for="email">Email:</label>
        <input type="text" id="email" name="email" maxlength="100" size="50" value="<?= $school->email ?>"/><br/>

        <lable for="startTimeOfClasses">Start Time of Classes:</label>
        <input type="text" id="startTimeOfClasses" name="startTimeOfClasses" maxlength="100" size="50" value="<?= $school->startTimeOfClasses ?>"/><br/>

        <lable for="endTimeOfClasses">End Time of Classes:</label>
        <input type="text" id="endTimeOfClasses" name="endTimeOfClasses" maxlength="100" size="50" value="<?= $school->endTimeOfClasses ?>"/><br/>

        <lable for="fallBreakDates">Fall Break Dates:</label>
        <input type="text" id="fallBreakDates" name="fallBreakDates" maxlength="100" size="50" value="<?= $school->fallBreakDates ?>"/><br/>

        <lable for="winterBreakDates">Winter Break Dates:</label>
        <input type="text" id="winterBreakDates" name="winterBreakDates" maxlength="100" size="50" value="<?= $school->winterBreakDates ?>"/><br/>

        <lable for="springBreakDates">Spring Break Dates:</label>
        <input type="text" id="springBreakDates" name="springBreakDates" maxlength="100" size="50" value="<?= $school->springBreakDates ?>"/><br/>

        <lable for="itbsTestingDates">Itbs Testing Dates:</label>
        <input type="text" id="itbsTestingDates" name="itbsTestingDates" maxlength="100" size="50" value="<?= $school->itbsTestingDates ?>"/><br/>

        <lable for="writingAssessmentDates">Writing Assessment Dates:</label>
        <input type="text" id="writingAssessmentDates" name="writingAssessmentDates" maxlength="100" size="50" value="<?= $school->writingAssessmentDates ?>"/><br/>

        <lable for="crctTestingDates">Crct Testing Dates:</label>
        <input type="text" id="crctTestingDates" name="crctTestingDates" maxlength="100" size="50" value="<?= $school->crctTestingDates ?>"/><br/>

        <lable for="shippingContactInfo">Shipping Contact Info:</label>
        <input type="text" id="shippingContactInfo" name="shippingContactInfo" maxlength="100" size="50" value="<?= $school->shippingContactInfo ?>"/><br/>

        <lable for="principal">Principal:</label>
        <input type="text" id="principal" name="principal" maxlength="100" size="50" value="<?= $school->principal ?>"/><br/>

        <lable for="principalsemail">Principal's email:</label>
        <input type="text" id="principalsemail" name="principalsemail" maxlength="100" size="50" value="<?= $principal->email ?>"/><br/>

        <lable for="principalCarbonCopied">As principal, do you want to be cc’d on all communication to the local school contact(s)?  This would include e-mails for scheduling, electronic newsletters and reminders:</label>
        <select id="principalCarbonCopied" name="principalCarbonCopied">
            <option = value="1">Yes</option>
            <option = value="0">No</option>
        </select><br/>

        <lable for="approveNewsletterCommunication">News Letter Communication:</label>
        <select id="approveNewsletterCommunication" name="approveNewsletterCommunication">
            <option = value="1">Yes</option>
            <option = value="0">No</option>
        </select><br/>

        <lable for="approveReminderPrompts">Reminder Prompt:</label>
        <select id="approveReminderPrompts" name="approveReminderPrompts">
            <option = value="1">Yes</option>
            <option = value="0">No</option>
        </select><br/>

        <label for="districtId">District:</label>
        <select id="districtId" name="districtId">
            <?php foreach($districts as $district): ?>
                <option value="<?= $district->id ?>" <?= ($district->id == $school->districtId)? 'selected': '' ?>><?= $district->name ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="userfile">Teachers CSV:</label>
        <input type="file" size="60" name="userfile">
        <!--input type="submit" value="Upload CSV"><br/-->
        <div id="progress">
            <div id="bar"></div>
            <div id="percent">0%</div >
        </div>

        <input type="submit" value="Save">
        <input type="reset" value="Reset"/>
    </form>
</div>

<script>
    var options = hmp.school.form;
    $("#form").ajaxForm(options);
</script>