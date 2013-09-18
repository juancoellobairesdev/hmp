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
        <th>Principal</th>
        <th>Principal Carbon Copied</th>
        <th>Approve Newsletter Communication</th>
        <th>Approve Reminder Prompts</th>
        <th>Administrator</th>
        <th>Verifier</th>
        <th>Local School Contact</th>
        <th>Family Coordinator</th>
        <th>Physical Education Teacher</th>
        <th>School Health Advocate Facilitator</th>
    </tr>
    <?php foreach($schools as $school): ?>
        <?php $employees = $school->employees ?>
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
            <td><?= $school->principal; ?></td>
            <td><?= $school->principalCarbonCopied; ?></td>
            <td><?= $school->approveNewsletterCommunication; ?></td>
            <td><?= $school->approveReminderPrompts; ?></td>
            <td><?= isset($employees[Employee_type_model::ADM])? $employees[Employee_type_model::ADM]->name: '' ?></td>
            <td><?= isset($employees[Employee_type_model::VER])? $employees[Employee_type_model::VER]->name: '' ?></td>
            <td><?= isset($employees[Employee_type_model::LSC])? $employees[Employee_type_model::LSC]->name: '' ?></td>
            <td><?= isset($employees[Employee_type_model::FCO])? $employees[Employee_type_model::FCO]->name: '' ?></td>
            <td><?= isset($employees[Employee_type_model::PET])? $employees[Employee_type_model::PET]->name: '' ?></td>
            <td><?= isset($employees[Employee_type_model::SHA])? $employees[Employee_type_model::SHA]->name: '' ?></td>
        </tr>
    <?php endforeach; ?>
</table>