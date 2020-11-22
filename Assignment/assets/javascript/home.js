jQuery(document).ready(function ($) {
  // Intro background carousel
  $("#intro-carousel").owlCarousel({
    autoplay: true,
    dots: false,
    loop: true,
    animateOut: 'fadeOut',
    items: 1
  });

  // Intro carousel (uses the Owl Carousel library)
  $("#intro-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 2
      },
      768: {
        items: 4
      },
      900: {
        items: 6
      }
    }
  });
});

//validate the username and password
function validationApplicant(){
	var checkName = document.getElementById("inputApplicantName").value;
	var checkPw = document.getElementById("userApplicantPw").value;

	if(checkName == ""){
		document.getElementById("inputApplicantName").style.border = "solid red";
	} else{
		document.getElementById("inputApplicantName").style.border = "solid green";
	}

	if(checkPw == ""){
		document.getElementById("userApplicantPw").style.border = "solid red";
	} else{
		document.getElementById("userApplicantPw").style.border = "solid green";
	}
}

function validationHO(){
	var checkName = document.getElementById("inputHOName").value;
	var checkPw = document.getElementById("userHOPw").value;

	if(checkName == ""){
		document.getElementById("inputHOName").style.border = "solid red";
	} else{
		document.getElementById("inputHOName").style.border = "solid green";
	}

	if(checkPw == ""){
		document.getElementById("userHOPw").style.border = "solid red";
	} else{
		document.getElementById("userHOPw").style.border = "solid green";
	}
}

function validationPatient(){
	var checkName = document.getElementById("inputPatientName").value;
	var checkPw = document.getElementById("userPatientPw").value;

	if(checkName == ""){
		document.getElementById("inputPatientName").style.border = "solid red";
	} else{
		document.getElementById("inputPatientName").style.border = "solid green";
	}

	if(checkPw == ""){
		document.getElementById("userPatientPw").style.border = "solid red";
	} else{
		document.getElementById("userPatientPw").style.border = "solid green";
	}
}
//show password
function showPasswordApplicant() {
  var y = document.getElementById("userApplicantPw");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}

function showPasswordHO() {
  var x = document.getElementById("userHOPw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function showPasswordPatient() {
  var z = document.getElementById("userPatientPw");
  if (z.type === "password") {
    z.type = "text";
  } else {
    z.type = "password";
  }
}
