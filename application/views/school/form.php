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

            <label for="startTimeOfClasses">Start Time of Classes:</label>
            <input type="time" id="startTimeOfClasses" name="startTimeOfClasses" maxlength="100" size="50" value="<?= date('H:i', strtotime($school->startTimeOfClasses)) ?>"/><br/>

            <label for="endTimeOfClasses">End Time of Classes:</label>
            <input type="time" id="endTimeOfClasses" name="endTimeOfClasses" maxlength="100" size="50" value="<?= date('H:i', strtotime($school->endTimeOfClasses)) ?>"/><br/>
        </fieldset>

        <fieldset>
            <legend>Staff</legend>
            <label for="adm">Administrator:</label>
            <input type="text" id="adm" name="adm" maxlength="100" class="input_email" value="<?= $adm->name ?>" onKeyUp="hmp.school.form.same_as_administrator()"/>
            <span class="right_email">Email:</span>
            <input type="email" id="admsEmail" name="admsEmail" maxlength="100" class="input_email" value="<?= $adm->email ?>" onKeyUp="hmp.school.form.same_as_administrator()"/>
            <span class="right_email">Same for all:</span>
            <input type="checkbox" id="same_for_all" name="same_for_all" value="1" onclick="hmp.school.form.same_for_all()">
            </br>
            <label for="ver">Verifier:</label>
            <input type="text" id="ver" name="ver" maxlength="100" class="input_name" value="<?= $ver->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="versEmail" name="versEmail" maxlength="100" class="input_email" value="<?= $ver->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_ver" name="chk_staff" value="ver" onClick="hmp.school.form.copy_administrator('ver')">
            <br/>
            <label for="lsc">Local School Coordinator:</label>
            <input type="text" id="lsc" name="lsc" maxlength="100" class="input_name" value="<?= $lsc->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="lscsEmail" name="lscsEmail" maxlength="100" class="input_email" value="<?= $lsc->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_lsc" name="chk_staff" value="lsc" onClick="hmp.school.form.copy_administrator('lsc')">
            <br/>
            <label for="fco">Family Coordinator:</label>
            <input type="text" id="fco" name="fco" maxlength="100" class="input_name" value="<?= $fco->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="fcosEmail" name="fcosEmail" maxlength="100" class="input_email" value="<?= $fco->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_fco" name="chk_staff" value="fco" onClick="hmp.school.form.copy_administrator('fco')">
            <br/>
            <label for="pet">Physical Education Teacher:</label>
            <input type="text" id="pet" name="pet" maxlength="100" class="input_name" value="<?= $pet->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="petsEmail" name="petsEmail" maxlength="100" class="input_email" value="<?= $pet->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_pet" name="chk_staff" value="pet" onClick="hmp.school.form.copy_administrator('pet')">
            <br/>
            <label for="sha">Student Health Advocate Facilitator:</label>
            <input type="text" id="sha" name="sha" maxlength="100" class="input_name" value="<?= $sha->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="shasEmail" name="shasEmail" maxlength="100" class="input_email" value="<?= $sha->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_sha" name="chk_staff" value="sha" onClick="hmp.school.form.copy_administrator('sha')">
            <br/>

        </fieldset>

        <fieldset>
            <legend>Communications</legend>

            As principal, do you want to be cc’d on all communication to the local school contact(s)?  This would include e-mails for scheduling, electronic newsletters and reminders:<br/>
            <label for="principalCarbonCopied">Allow communications:</label>
            <input type="radio" id="principalCarbonCopied" name="principalCarbonCopied" <?= $school->principalCarbonCopied? 'checked': '' ?> value="1">Yes
            <input type="radio" id="principalCarbonCopied" name="principalCarbonCopied" <?= $school->principalCarbonCopied? '': 'checked' ?> value="0">No</br>

            <label for="approveNewsletterCommunication">Newsletter Communication:</label>
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
            <input type="submit" value="Save" onClick="hmp.school.form.fill_data()">
            <?php if(!$school->id): ?>
                <input type="reset" value="Reset"/>
            <?php endif ?>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        var options = hmp.school.form.options;
        hmp.school.form.options.data.schoolId = $('#schoolId').val();
        $("#form").ajaxForm(options);
    });
</script>