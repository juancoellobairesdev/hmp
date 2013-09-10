<div id="notifications">
    <ul>
        <?php foreach($errors as $error): ?>
            <li class="form_error"><?= $error ?></li>
        <?php endforeach ?>
    </ul>
</div>

<form action="<?= $baseUrl ?>user/forgot_password" method="post">
    <label for="email">E-mail</label>
    <input type="text" id="email" name="email" maxlength="128"/><br/>

    <label for="school">School</label>
    <select id="school" name="school">
        <?php foreach($schools as $school): ?>
            <option value="<?= $school->id ?>"><?= $school->name ?></option>
        <?php endforeach ?>
    </select><br/>

    <label for="iAmTeacher">I am a Teacher</label>
    <input type="checkbox" id="iAmTeacher" name="iAmTeacher" onClick="hmp.user.forgot_password.i_am_teacher()"/><br/>

    <label for="gradeLevel">Grade Level</label>
    <select id="gradeLevel" name="gradeLevel" disabled>
        <?php foreach($gradeLevels as $index => $gradeLevel): ?>
            <option value="<?= $index ?>"><?= $gradeLevel ?></option>
        <?php endforeach ?>
    </select><br/>

    <input type="submit" value="Reset Password"/>
</form>

