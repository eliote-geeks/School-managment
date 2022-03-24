const pswrdfield = document.querySelectorAll(".form input[type='password']"),
toggleBtn = document.querySelectorAll(".form .field i");

toggleBtn.onclick = ()=>{
	if (pswrdfield.type == 'password') {
			pswrdfield.type = 'text';
			toggleBtn.classList.add("active");
	 }else{
	 	pswrdfield.type = 'password';
	 	toggleBtn.classList.remove("active");
	 }
} 
