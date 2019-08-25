//Checking if the passwords are the same
function checkPass() {
	//Store the password field objects into variables ...
	var pass1 = document.getElementById('psw');
	var pass2 = document.getElementById('pass2');
	//Store the Confimation Message Object ...
	var message = document.getElementById('confirmMessage');
	//Set the colors we will be using ...
	var goodColor = "#66cc66";
	var badColor = "#ff6666";
	//Compare the values in the password field
	//and the confirmation field
	if (pass1.value == pass2.value){
		//The passwords match.
		//Set the color to the good color and inform
		//the user that they have entered the correct password
		pass2.style.backgroundColor = goodColor;
		message.style.color = goodColor;
		message.innerHTML = "Passwords Match!"

	}
	else {
		//The passwords do not match.
		//Set the color to the bad color and
		//notify the user.
		pass2.style.backgroundColor = badColor;
		message.style.color = badColor;
		message.innerHTML = "Passwords Do Not Match!";
	}
}

//when the thing submits
var theForm = document.getElementById( 'theForm' );
var pass1 = document.getElementById('psw');
var pass2 = document.getElementById('pass2');
new stepsForm( theForm, {
	onSubmit : function( form ) {
		// hide form
		if (pass1.value == pass2.value) {
			classie.addClass( theForm.querySelector( '.simform-inner' ), 'hide' );
			var messageEl = theForm.querySelector( '.final-message' );
			messageEl.innerHTML = 'Thank you! You may register below.';
			classie.addClass( messageEl, 'show' );
			$("#submit").html("<input type = 'submit' value = 'Register'>");
		}
		else {
			//right now the whole page will reload if the passwords arent the same. Fix later.
			if(!alert('Make sure your passwords are the same')){window.location.reload();}
		}
	}
} );

//Adding in the preview display
$(document).on('keyup', '.previewable', function() {
	var previewText= $(this).val();
	switch(this.id) {
		case "firstName":
			$("#fNamePreview").text(previewText);
			break;
		case "lastName":
			$("#lNamePreview").text(previewText);
			break;
		case "email":
			$("#emailPreview").text(previewText);
			break;
		case "username":
			$("#usernamePreview").text(previewText);
			break;
	}
});

