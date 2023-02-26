$(document).ready(function () {
  $(".js-example-basic-multiple").select2();
  $.validator.addMethod(
    "date",
    function (value, element, param) {
      return value != 0 && value <= 31 && value == parseInt(value, 10);
    },
    "Please enter a valid date!"
  );
  $.validator.addMethod(
    "month",
    function (value, element, param) {
      return value != 0 && value <= 12 && value == parseInt(value, 10);
    },
    "Please enter a valid month!"
  );
  $.validator.addMethod(
    "year",
    function (value, element, param) {
      return value != 0 && value >= 1900 && value == parseInt(value, 10);
    },
    "Please enter a valid year not less than 1900!"
  );
  $.validator.addMethod(
    "username",
    function (value, element, param) {
      var nameRegex = /^[a-zA-Z0-9]+$/;
      return value.match(nameRegex);
    },
    "Only a-z, A-Z, 0-9 characters are allowed"
  );

  var val = {
    // Specify validation rules
    rules: {
      fname: "required",
      email: {
        required: true,
        email: true,
      },
      phone: {
        required: true,
        minlength: 10,
        maxlength: 10,
        digits: true,
      },
      date: {
        date: true,
        required: true,
        minlength: 2,
        maxlength: 2,
        digits: true,
      },
      month: {
        month: true,
        required: true,
        minlength: 2,
        maxlength: 2,
        digits: true,
      },
      year: {
        year: true,
        required: true,
        minlength: 4,
        maxlength: 4,
        digits: true,
      },
      username: {
        username: true,
        required: true,
        minlength: 4,
        maxlength: 16,
      },
      password: {
        required: true,
        minlength: 8,
        maxlength: 16,
      },
    },
    // Specify validation error messages
    messages: {
      fname: "First name is required",
      email: {
        required: "Email is required",
        email: "Please enter a valid e-mail",
      },
      phone: {
        required: "Phone number is requied",
        minlength: "Please enter 10 digit mobile number",
        maxlength: "Please enter 10 digit mobile number",
        digits: "Only numbers are allowed in this field",
      },
      date: {
        required: "Date is required",
        minlength: "Date should be a 2 digit number, e.i., 01 or 20",
        maxlength: "Date should be a 2 digit number, e.i., 01 or 20",
        digits: "Date should be a number",
      },
      month: {
        required: "Month is required",
        minlength: "Month should be a 2 digit number, e.i., 01 or 12",
        maxlength: "Month should be a 2 digit number, e.i., 01 or 12",
        digits: "Only numbers are allowed in this field",
      },
      year: {
        required: "Year is required",
        minlength: "Year should be a 4 digit number, e.i., 2018 or 1990",
        maxlength: "Year should be a 4 digit number, e.i., 2018 or 1990",
        digits: "Only numbers are allowed in this field",
      },
      username: {
        required: "Username is required",
        minlength: "Username should be minimum 4 characters",
        maxlength: "Username should be maximum 16 characters",
      },
      password: {
        required: "Password is required",
        minlength: "Password should be minimum 8 characters",
        maxlength: "Password should be maximum 16 characters",
      },
    },
  };
  $("#myForm")
    .multiStepForm({
      // defaultStep:0,
      beforeSubmit: function (form, submit) {
        console.log("called before submiting the form");
        console.log(form);
        console.log(submit);
      },
      validations: val,
    })
    .navigateTo(0);
});



flatpickr(".multipleDate", {
  mode: "multiple",
  dateFormat: "Y-m-d"
});
flatpickr(".singleDate", {
  enableTime: true,
  dateFormat: "Y-m-d H:i",
});
flatpickr(".rangeDate", {
  mode: "range",
  minDate: "today",
  dateFormat: "Y-m-d",
  disable: [
      function(date) {
      }
  ]
});
flatpickr(".specificDate", {
  enable: ["2021-03-30", "2025-05-21", "2025-06-08", new Date(2025, 8, 9) ]
});
flatpickr(".dismissDate",{
  altInput: true,
  dateFormat: "YYYY-MM-DD",
  altFormat: "DD-MM-YYYY",
  allowInput: true,
  parseDate: (datestr, format) => {
    return moment(datestr, format, true).toDate();
  },
  formatDate: (date, format, locale) => {
    // locale can also be used
    return moment(date).format(format);
  }
}); 