/**
 * @author Jordan Taylor
 * @version Novemeber 7, 2015
 */

/**
 * Function reportError
 * @param element Name of the element passed into the function
 * @param error Error passed in the function associated with the element
 * Function to find an element and it's error to create a 'red' error statement
 */
function reportError(element, error){
  removeError(element);
  var elementError = document.getElementById(element.concat('-err'));
  elementError.style.color = "red";
  elementError.innerHTML += error;
}

/**
 * Function validateFirst 
 * @return boolean if called report error is true or false
 */
function validateFirst(){
  var isValid = true;
  var firstname = document.getElementById('firstname').value;
  var result = firstname.match(/[a-zA-Z]/);
        
  if(firstname==null || firstname.length > 60){
    reportError('firstname', 'First name is an invalid length!');
    isValid = false;
  }
  if(result == null){
    reportError('firstname', 'First name must contain at least one letter!');
    isValid = false;
  }
  return isValid;
}

/**
 * Function validateLast 
 * @return boolean if called report error is true or false
 */
function validateLast(){
  var isValid = true;
  var lastname = document.getElementById('lastname').value;
  var result = lastname.match(/[a-zA-Z]/);
        
  if(lastname==null || lastname.length > 60){
    reportError('lastname', 'Last name is an invalid length!');
    isValid = false;
  }
  if(result == null){
    reportError('lastname', 'Last name must contain at least one letter!');
    isValid = false;
  }
  return isValid;
}

/**
 * Function validateUsername 
 * @return boolean if called report error is true or false
 */
function validateUsername(){
  var isValid = true;
  var username = document.getElementById('username').value;
  var result = username.match(/[a-zA-Z]/);
        
  if(username==null || username.length > 60){
    reportError('username', 'Username is an invalid length!');
    isValid = false;
  }
  if(result == null){
    reportError('username', 'Username must contain at least one letter!');
    isValid = false;
  }
  return isValid;
}

/**
 * Function validatePasswords 
 * @return boolean if called report error is true or false
 */
function validatePasswords(){
  var isValid = true;
  var password = document.getElementById('password').value;
  var result = password.match(/[a-zA-Z]/);

  if(password==null || password.length > 20){
    reportError('password', 'Password is an invalid length');
    isValid = false;
  }
  if(result==null){
    reportError('password', 'Password must contain at least one letter');
  }
  if(isValid==true){
    removeError('password');
  }
  return isValid;
}

/**
 * Function validateVer_Password 
 * @return boolean if called report error is true or false
 */
function validateVer_Password(){
  var isValid = true;
  var password = document.getElementById('password').value;
  var ver_password = document.getElementById('ver_password').value;
  var result = password.match(/[a-zA-Z]/);

  if(password!==ver_password){
    reportError('ver_password', "Passwords don't match up");
    isValid = false;
  }
  if(isValid==true){
    removeError('ver_password');
  }
  return isValid;
}

/**
 * Function validateAll 
 * clears all the elements error messages (AND)
 * @return boolean if called report error is true or false for all elements
 */
function validateAll(){
  removeError('username');
  removeError('password');
  removeError('ver_password');

  var u = validateUsername();
  var p = validatePasswords();
  var v = validateVer_Password();
  var isValid = false;

  if(u && p && v){
    isValid = true;
  }
  return isValid;
}

/**
 * Function removeError
 * Function to clear the error message after each blur if it is valid or not
 */
function removeError(element){
  var id = document.getElementById(element.concat('-err'));
  id.innerHTML = " ";
}