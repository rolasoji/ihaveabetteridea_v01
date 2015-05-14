/*
	This is the JavaScript file for the How to Create CAPTCHA Protection using PHP and AJAX Tutorial

	You may use this code in your own projects as long as this 
	copyright is left in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	
	For the rest of the code visit http:// www.WebCheatSheet.com
	
	Copyright 2006 WebCheatSheet.com	

*/
//  gets the browser specific XmlHttpRequest Object 
function getXmlHttpRequestObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest(); // Mozilla, Safari ...
    } else if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP"); // IE
    } else {
        // display our error message
        //alert("Your browser doesn't support the XmlHttpRequest object.");
        alertify.alert("Your browser doesn't support the XmlHttpRequest object.");
    }
} // end function 

// set up XmlHttpRequest object & captcha image source
var receiveReq = getXmlHttpRequestObject();
// set up the link, adding a random function to trick the browser into thinking this is a new content ...
// ... otherwise, the browser caches the page and will only allow the first refresh ...
var captchaImgSrc = 'captchaprocessing.php?width=100&amp;height=40&amp;characters=6';

// initiate the AJAX request
function makeRequest(url, captchaParam) {
    // if our readystate is either 'not started' or 'finished', initiate a new request
    if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {
        // set up the connection to captcha_test.html; true sets the request to asyncronous(default) 
        receiveReq.open("POST", url, true);
        // set the function that will be called when the XmlHttpRequest objects state changes
        receiveReq.onreadystatechange = updatePage; 

        // specify content properties
        receiveReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        receiveReq.setRequestHeader("Content-length", captchaParam.length);
        receiveReq.setRequestHeader("Connection", "close");

        // make the request
        receiveReq.send(captchaParam);
    }   
} // end function 
// called every time our XmlHttpRequest objects state changes
function updatePage() {
    // check if response is ready
    if (receiveReq.readyState == 4) {
        // get a reference to CAPTCHA image
        var captchaImgID = getCAPTCHAimgID();
        if (!captchaImgID) {
            alertify.alert("Can't find the image element ID.");
        } else {
            img = document.getElementById(captchaImgID);
        }
        // change the image
        //img.src = 'create_image.php?' + Math.random();
        img.src = captchaImgSrc + Math.random();
    }
} // end function 
// called every time form is submitted or CAPTCHA refresh button is clicked
function getCaptchaParam(theForm, elementID) {
    // first check if captcha is the right length / format
    var formsubmitstatus = document.theForm.onsubmit();
    alertify.alert("1=ajax_captcha: " + formsubmitstatus);
    if (elementID.substr(0, 21) == "inputcaptcharefreshid" && !formsubmitstatus) {
        refreshCAPTCHA(theForm);
    } else {
        //alertify.alert("1=ajax_captcha: " + elementID);
        var captchastatus = captchaCheckALERT(theForm);
        if (captchastatus) {
            //alertify.alert("1a=ajax_captcha: ");
            // form was submitted & no errors; set URL to process captcha entry
            var url = 'http://www.balancewellness.co.uk/zNEWsite_idea/_components/phpincludes/snippet_captcha_processing.php';
            // set up the parameters of our AJAX call
            var postStr = theForm.captcha_code.name + "=" + encodeURIComponent(theForm.captcha_code.value);
            // call the function that initiate the AJAX request
            makeRequest(url, postStr);
            return true;
        } else {
            // form was submitted with errors ...
            //alertify.alert("1b=ajax_captcha: ");
            var captcha = theForm.captcha_code.value;
            //alert('Please enter the CAPTCHA code shown.');
            // prompt dialog popup
            alertify.alert("You entered " + captcha + ". Please enter the CAPTCHA code shown.");
            theForm.captcha_code.focus();
            return false;
        }
    }
} // end function 
/*========================================
=            CUSTOM FUNCTIONS            =
========================================*/
// initial check for captcha length / format
function captchaCheckALERT(form) {
    if (!form.captcha_code.value.match(/^[a-zA-Z0-9]{6}$/)) {
        return false;
    }
    return true;
} // end function 
// refreshes captcha image
function refreshCAPTCHA(form) {
    // get a reference to CAPTCHA image
    var captchaImgID = getCAPTCHAimgID();
    //alertify.alert("ajax_captcha: " + captchaImgID);
    if (!captchaImgID) {
        alertify.alert("Can't find the image element ID.");
    } else {
        //alertify.alert("ajax_captcha: " + captchaImgID + " - " + captchaImgSrc);
        // get the image and entry field elements
        imgelementID = document.getElementById(captchaImgID);
        codeentryelementID = document.getElementById("captcha_code");

        // refresh elements (captcha image and entry field)
        imgelementID.src = captchaImgSrc + Math.random();
        form.captcha_code.value = '';
        form.captcha_code.focus();
    } // if
} // end function 
// gets the ID of the captcha image element (changes depending on calling page)
function getCAPTCHAimgID() {
    var imgelements = document.images;
    var foundimgID = "";
    //alertify.aler("1-ajax_captcha: " + imgelements.length);
    for (i = 0; i < imgelements.length; i++) {
        //alertify.alert("2=ajax_captcha: " + imgelements[i].id);
        if (imgelements[i].id.substr(0, 22) == "inputcaptcharefreshimg") {
            //alert(imgelements[i].id);
            foundimgID = imgelements[i].id;
            break;
        }
    } // for loop
    if (foundimgID == "") {
        return false;
    } else {
        return foundimgID;
    } // if
} // end function 

