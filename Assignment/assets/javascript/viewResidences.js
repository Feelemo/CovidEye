
//search for residence (filter)
function searchFunction() {
    var input, filter, cards, cardContainer, i;
    input = document.getElementById("searchBar");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("residenceList");
    cards = cardContainer.getElementsByClassName("card");
    for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".card-box h4.card-title");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}

//Validation for date picker
(function() {
'use strict';
window.addEventListener('load', function() {
	// Get the forms we want to add validation styles to
	var forms = document.getElementsByClassName('needs-validation');
	// Loop over them and prevent submission
	var validation = Array.prototype.filter.call(forms, function(form) {
		form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
			}
			form.classList.add('was-validated')
			;
		}, false);
	});
}, false);
})();
