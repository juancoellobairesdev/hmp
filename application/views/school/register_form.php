<form action="<?= $baseUrl ?>school/register" method="post">
    <label for="name">School Name:</label>
    <input type="text" id="name" name="name" maxlength="255"/><br/>

    <label for="grade">Grade Levels Served by School:</label>
    <input type="text" id="grade" name="grade" maxlength="255"/><br/>

    <label for="address">School Address</:label>
    <input type="text" id="address" name="address" maxlength="255"/><br/>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" maxlength="255"/><br/>

    <label for="state">State:</label>
    <input type="text" id="state" name="state" maxlength="255"/><br/>

    <label for="zip">Zip Code:</label>
    <input type="text" id="zip" name="zip" maxlength="255"/><br/>

    <label for="area">Phone Number:</label>
    (<input type="text" id="area" name="area" maxlength="3" size="3"/>)
    <input type="text" id="phone_prefix" name="phone_prefix" maxlength="3" size="3"/>
    <input type="text" id="phone_postfix" name="phone_postfix" maxlength="4" size="4"/><br/>

    <label for="county">County:</label>
    <input type="text" id="county" name="county" maxlength="255"/><br/>

    <label for="enrollment">Student Enrollment:</label>
    <input type="text" id="enrollment" name="enrollment" maxlength="255"/><br/>

    <label for="staff">Total Number of Staff:</label>
    <input type="text" id="staff" name="staff" maxlength="255"/><br/>

    <label for="lunch">Free and Reduced Lunch Rate:</label>
    <input type="text" id="lunch" name="lunch" maxlength="255"/><br/>

    <label for="your_name">Your Name:</label>
    <input type="text" id="your_name" name="your_name" maxlength="255"/><br/>

    <label for="your_email">Your Email Address:</label>
    <input type="text" id="your_email" name="your_email" maxlength="255"/><br/>

    <label for="position">Your Position in School:</label>
    <input type="text" id="position" name="position" maxlength="255"/><br/>

    <label for="comments">Comments:</label>
    <textarea id="comments" name="comments" maxlength="255"/></textarea><br>

    <input type="submit" value="Submit"/>
    <input type="reset" value="reset"/>
</form>

