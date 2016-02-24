/**
 * @author Jordan Taylor
 * @version February 24, 2016
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
 * Function validatePhone 
 * @return boolean if called report error is true or false for the phone element
 */
function validatePhone(){
  removeError('phone');
  var isValid = true;
  var phone = document.getElementById('phone').value;
  var result = phone.match(\d{3}-\d{3}-\d{4}|\d{10});

  if(phone == null){
    reportError('phone', 'Phone must be filled out');
    document.getElementById('updateprofile').disabled = true;
    isValid = false;
  }
  if(result == null){
    reportError('phone', 'Phone is not correctly filled out');
    document.getElementById('updateprofile').disabled = true;
    isValid = false;
  }
  if(isValid == true){
    removeError('phone');
  }
  return isValid;
}

/**
 * Function validateAll 
 * clears all the elements error messages (AND)
 * @return boolean if called report error is true or false for all elements
 */
function validateInfo(){
  removeError('phone');

  var ph = validatePhone();
  var isValid = false;

  if(ph){
    document.getElementById('updateprofile').disabled = false;
    isValid = true;
  }
  else{
    isValid = false;
    //alert("You must enter valid text in selected fields");
  }
  return isValid;
}

/**
 * Function validateYear
 * @return boolean if called report error is true or false for the grad_year element
 */
function validateGradYear(){
  removeError('grad_year');
  var isValid = true;
  var year = document.getElementById('grad_year').value;
  var result = year.match(\d{4});

  if(year == null){
    reportError('grad_year', 'Graduation year must be filled out');
    document.getElementById('updateprofile').disabled = true;
    isValid = false;
  }
  if(result == null){
    reportError('grad_year', 'Graduation year is not correctly filled out');
    document.getElementById('updateprofile').disabled = true;
    isValid = false;
  }
  if(year < 1900){
    reportError('grad_year', 'Graduation year must be greater than 1900');
    document.getElementById('updateprofile').disabled = true;
    isValid = false;
  }
  if(isValid == true){
    removeError('grad_year');
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