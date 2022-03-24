const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
errortext = form.querySelector(".error-txt");

form.onsubmit = function(e){
	e.preventDefault();
}


continueBtn.onclick = ()=>{
	let xhr = new XMLHttpRequest();
	xhr.open("POST",'/../msg/connexion/login.php',true);
	xhr.onload = ()=>{
		if (xhr.readyState == XMLHttpRequest.DONE) {
			if (xhr.status == 200) {
				let data = xhr.response;
				if (data == "ok") {
					location.href = 'use.php';
				}
				else{
					errortext.textContent = data;
					errortext.style.display = "block";	
				}
			}
		}
	}

	let formData = new FormData(form);
	xhr.send(formData);
}

