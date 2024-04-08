<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php 
  $title = "Apply";
  include_once('head2.inc');
  ?>
<body>
<?php include_once('header.inc');?>
<div class="apply">
  <div class="container" >
    <div class="title">Registration</div>
    <div class="content2">
      <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="firt-name" placeholder="Enter your first name" pattern="[A-Za-z]{1,20}" title="Name can be up to 20 alphabetical characters" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="last-name" placeholder="Enter your last name" pattern="[A-Za-z]{1,20}" title="Name can be up to 20 alphabetical characters" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="email" placeholder="Enter your email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phone" placeholder="Enter your number" pattern="[0-9 ]{8,12}" title="Phone number must be 8 to 12 digits or spaces" required>
          </div>
          <div class="input-box">
            <span class="details">Job Reference Number</span>
            <input type="text" name="job-num" placeholder="Enter your job reference number" pattern="[A-Za-z0-9]{5}" title="Enter exactly 5 alphanumeric characters" required>
          </div>
          <div class="input-box">
            <span class="details">Date of Birth</span>
            <input type="date" name="dob" pattern="[A-Za-z0-9]{5}" title="Enter exactly 5 alphanumeric characters" required>
          </div>
          <div class="input-box">
            <span class="details">Street Address</span>
            <input type="text" name="street-add" placeholder="Enter your street address" maxlength="40" required>
          </div>
          <div class="input-box">
            <span class="details">Suburb / town</span>
            <input type="text" name="suburb/town" placeholder="Enter your suburb / town" maxlength="40" required>
          </div>
          <div class="input-box">
            <span class="details">State</span>
            <select class="select-option" name="state" placeholder="Please select your State" required>
              <option disabled selected></option>
              <option value="VIC">VIC</option>
              <option value="NSW">NSW</option>
              <option value="QLD">QLD</option>
              <option value="NT">NT</option>
              <option value="WA">WA</option>
              <option value="SA">SA</option>
              <option value="TAS">TAS</option>
              <option value="ACT">ACT</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Postcode</span>
            <input type="text" name="postcode" placeholder="Enter your postcode" pattern="[0-9]{4}" title="Postcode must be exactly 4 digits" required>
          </div>
          <div class="input-box">
            <span class="details">Skill List</span>
            <input type="checkbox" name="skill-list1" value="analytical-skill" id="sl1">
            <label for="sl1">Analytical skill</label> 
            <input type="checkbox" name="pskill-list2" value="programming" id="sl2">
            <label for="sl2">Programming</label> 
            <input type="checkbox" name="skill-list3" value="security" id="sl3">
            <label for="sl3">Infor Security</label> 
            <input type="checkbox" name="skill-list4" value="others" id="sl4">
            <label for="sl4">Other Skills</label> 
          </div>
          <div class="input-box">
            <span class="details">Other Skill</span>
            <textarea name="other-skills" placeholder="Enter your other skills" required></textarea>
          </div>
        </div>
        <div class="gender-details">
          <fieldset>
            <legend class="gender-title">Gender</legend>
            <input type="radio" name="gender" id="dot-1" value="male">
            <input type="radio" name="gender" id="dot-2" value="female">
            <input type="radio" name="gender" id="dot-3" value="not-to-say">
            <div class="category">
              <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Male</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Female</span>
            </label>
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">Prefer not to say</span>
              </label>
            </div>
          </fieldset>
        </div>
        <div class="button1">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>
</div>
<?php include_once('footer.inc'); ?>
</body>
</html>