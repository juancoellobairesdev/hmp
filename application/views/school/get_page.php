<table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Approved</th>
        <th>Starting School Year</th>
        <th>Classes Start Date</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Fax</th>
        <th>Email</th>
        <th>Start Time of Classes</th>
        <th>End Time of Classes</th>
        <th>Fall Break Dates</th>
        <th>Winter Break Dates</th>
        <th>Spring Break Dates</th>
        <th>Itbs Testing Dates</th>
        <th>Writing Assessmen Dates</th>
        <th>Crct Testing Dates</th>
        <th>Principal</th>
        <th>Principal Carbon Copied</th>
        <th>Approve Newsletter Communication</th>
        <th>Approve Reminder Prompts</th>
        <th>Administrator</th>
        <th>Verifier</th>
    </tr>
    <?php foreach($schools as $school): ?>
        <tr class="list_row" onclick="window.location='<?= $baseUrl ?>school/edit_form/<?= $school->id?>'" style="cursor:pointer">
            <td><?= $school->id; ?></td>
            <td><?= $school->name; ?></td>
            <td><?= $school->approved? 'Yes': 'No'; ?></td>
            <td><?= $school->startingSchoolYear; ?></td>
            <td><?= $school->classesStartDate; ?></td>
            <td><?= $school->address; ?></td>
            <td><?= $school->phone; ?></td>
            <td><?= $school->fax; ?></td>
            <td><?= $school->email; ?></td>
            <td><?= $school->startTimeOfClasses; ?></td>
            <td><?= $school->endTimeOfClasses; ?></td>
            <td><?= $school->fallBreakDates; ?></td>
            <td><?= $school->winterBreakDates; ?></td>
            <td><?= $school->springBreakDates; ?></td>
            <td><?= $school->itbsTestingDates; ?></td>
            <td><?= $school->writingAssessmentDates; ?></td>
            <td><?= $school->crctTestingDates; ?></td>
            <td><?= $school->principal; ?></td>
            <td><?= $school->principalCarbonCopied; ?></td>
            <td><?= $school->approveNewsletterCommunication; ?></td>
            <td><?= $school->approveReminderPrompts; ?></td>
            <td><?= $school->administrator->name; ?></td>
            <td><?= $school->verifier->name; ?></td>
        </tr>
    <?php endforeach; ?>
</table>