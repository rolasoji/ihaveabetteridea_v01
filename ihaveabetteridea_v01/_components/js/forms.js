function formhash(form, useremail, password) {
    // create & add a new element input for the password field
    var p = document.createElement("input");
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // make sure the plaintext password doesn't get sent
    //password.value = "";

    //var x = form.useremail;
    //alertify.alert('forms.js: formhash / ' + 'this.form=' + form.name + ' / password=' + password.value + ' / form.email=' + x.value + ' / useremail=' + useremail.value);
    // submit the form
    form.submit();
}

function regformhash(form, formid, uid, email, password, conf) {
    var formstatus = getCaptchaParam(form, formid);
    if (formstatus) {
        alertify.alert('Wrong' + uid + ', ' + email + ', ' + password + ', ' + conf);
        // Check each field has a value
        if (uid.value == '' || isnul(uid.value) ||
              email.value == '' || isnull(email.value) ||
              password.value == '' || isnull(password.value) ||
              conf.value == '' || conf.value) {

            alertify.alert('You must provide all the requested details. Please try again');
            return false;
        }

        // Check the username

        re = /^\w+$/;
        if (!re.test(form.username.value)) {
            alertify.alert("Username must contain only letters, numbers and underscores. Please try again");
            form.username.focus();
            return false;
        }

        // Check that the password is sufficiently long (min 6 chars)
        // The check is duplicated below, but this is included to give more
        // specific guidance to the user
        if (password.value.length < 6) {
            alertify.alert('Passwords must be at least 6 characters long.  Please try again');
            form.password.focus();
            return false;
        }

        // At least one number, one lowercase and one uppercase letter 
        // At least six characters 

        var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
        if (!re.test(password.value)) {
            alertify.alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
            return false;
        }

        // Check password and confirmation are the same
        if (password.value != conf.value) {
            alertify.alert('Your password and confirmation do not match. Please try again');
            form.password.focus();
            return false;
        }

        // Create a new element input, this will be our hashed password field. 
        var p = document.createElement("input");

        // Add the new element to our form. 
        form.appendChild(p);
        p.name = "p";
        p.type = "hidden";
        p.value = hex_sha512(password.value);

        // Make sure the plaintext password doesn't get sent. 
        password.value = "";
        conf.value = "";

        // Finally submit the form. 
        form.submit();
        return true;
    } else {
        alertify.alert('Wrong' + uid + ', ' + email + ', ' + password + ', ' + conf);
        return false;
    }
}
