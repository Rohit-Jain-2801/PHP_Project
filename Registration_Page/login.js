const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

window.onload = function(){
	lbl = document.getElementById('em_lbl');
	const urlParams = new URLSearchParams(window.location.search);
	const myParam = urlParams.get('val');

	if(myParam==0){
		signInButton.click();
	} else if(myParam==1){
		signUpButton.click();
	}

	if(urlParams.get('mail')==1){
		lbl.style.color = "green";
		lbl.innerHTML = "New Password is sent to your email!";
	} else if(urlParams.get('mail')==0){
		lbl.style.color = "red";
		lbl.innerHTML = "Email is Invalid or NOT Registered!";
	}
}

function mail_chk(){
	email = document.getElementsByName('email')[0].value;
	if(email==''){
		lbl.style.color = "red";
		lbl.innerHTML = "Enter your Email!";
	} else{
		lbl.style.color = "green";
		lbl.innerHTML = "Please wait...!";
		location.href = "../All_Includes/mail.php?var="+email;
	}
}