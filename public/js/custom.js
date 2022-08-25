$(function() {
  $('.delete-my-profile').on('click', function(e) {
    if (confirm('Are you sure you want to delete?')) {
      $('#delete-my-profile').submit();
    } else {
      return false;
    }
    e.preventDefault();
  });
  if ($('.stillinrole').is(':checked')) {
    $('.enddate').hide();
  }
  $('.stillinrole').on('click', function() {
    $('.enddate').toggle();
  });
  $('.more-option').on('click', function() {
    $('.more-search-form').slideToggle();
    $('.more-option .fa-chevron-up').toggle();
    $('.more-option .fa-chevron-down').toggle();
  });
});

function readNotification() {
  var notifid = $('a:focus').attr('data-notifid');
  console.log(notifid);
  $.get('/markAsRead', { id: notifid });
}

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName('tab');
  x[n].style.display = 'block';
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById('prevBtn').style.display = 'none';
  } else {
    document.getElementById('prevBtn').style.display = 'inline';
  }
  if (n == x.length - 1) {
    document.getElementById('nextBtn').style.display = 'none';
  } else {
    document.getElementById('nextBtn').style.display = 'inline';
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n);
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName('tab');
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = 'none';
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...

  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x,
    y,
    i,
    valid = true;
  x = document.getElementsByClassName('tab');
  y = x[currentTab].getElementsByTagName('input');
  var pitch = document.getElementById('pitch').value;
  var worktype = document.getElementById('worktype');
  var category = document.getElementById('category');
  var subcategory = document.getElementById('subcategory');
  var worktypeValue = worktype.options[worktype.selectedIndex].value;
  var categoryValue = category.options[category.selectedIndex].value;
  var subcategoryValue = subcategory.options[subcategory.selectedIndex].value;
  if (worktypeValue == '') {
    document.getElementById('worktype').classList.add('pitch-invalid');
    valid = false;
  }
  if (categoryValue == '') {
      document.getElementById('category').classList.add('pitch-invalid');
      valid = false;
  }
  if (subcategoryValue == '') {
      document.getElementById('subcategory').classList.add('pitch-invalid');
      valid = false;
  }
  if (pitch.length < 140) {
    console.log('k');
    document.getElementById('pitch').classList.add('pitch-invalid');
    valid = false;
  }
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == '') {
      // add an "invalid" class to the field:
      y[i].className += ' invalid';
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName('step')[currentTab].className += ' finish';
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i,
    x = document.getElementsByClassName('step');
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(' active', '');
  }
  //... and adds the "active" class on the current step:
  x[n].className += ' active';
}

