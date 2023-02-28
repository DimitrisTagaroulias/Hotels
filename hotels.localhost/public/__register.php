
<form class="modal-content animate register-form" action="" method="post">
  <span class="closeBtn close" title="Close Modal">&times;</span>
  <div class="inputs-container">
    <label for="userNameREG">
      <b>Username</b>
    </label>
    <input type="text" placeholder="Enter Username" name="userNameREG" class="reg-input input-0" id="reg-user-name">
    <p id="reg-ErrorUserName" class="par-basic-css toBeDisplayedOnSubmit-0 starts-visible">
      Username should be between 6 - 18 characters. First and last letter shouldn't be a special character. Also _. or ._ are not valid sequence.
    </p>
    <label for="emailREG">
      <b>Email</b>
    </label>
    <input type="text" placeholder="Enter Email" name="emailREG" class="reg-input input-1" id="reg-email">
    <p id="reg-ErrorEmail" class="registrationRulesError par-basic-css toBeDisplayedOnSubmit-1 starts-hidden hidden">
      Enter a valid Email
    </p>
    <label for="repeatEmailREG">
      <b>Repeat Email</b>
    </label>
    <input type="text" placeholder="Enter Enter your Email again" name="repeatEmailREG" class="reg-input input-2" id="reg-email-repeat">
    <p id="reg-ErrorEmail-repeat" class="registrationRulesError par-basic-css starts-hidden hidden">
      The Emails don't match
    </p>
    <p id="reg-ErrorEmail-repeat-2" class="registrationRulesError par-basic-css toBeDisplayedOnSubmit-2 starts-hidden hidden">
      Enter a valid email first!
    </p>
    <label for="passWordREG">
      <b>Password Dj123456</b>
    </label>
    <input type="password" placeholder="Enter Password" name="passWordREG" class="reg-input password input-3" id="reg-password">
    <label class="show-password">
      <input type="checkbox" name="show-password"> Show/Hide password
    </label>
    <p id="reg-ErrorPassword" class="par-basic-css toBeDisplayedOnSubmit-3 starts-visible">
      Password should be at least 8 characters and should contain least one digit,one upper case letter,one lower case letter.
    </p>
    <button id="final-registration-button" class="final-registration-button" type="submit">Register</button>
  </div>
  <div class="container-cancel">
    <button type="button" class="final-registration-button cancelbtn cancelbtn-REG close">Cancel</button>
    <button type="button" class="final-registration-button resetForm-btn-REG">Reset form</button>
  </div>
</form>