const pswrdfield = document.querySelectorAll(".form input[type='password']"),
toggleBtn = document.querySelectorAll(".form .field i");

for (var i = 0; i < toggleBtn.length; i++) {
	  toggleBtn[i].onclick = ()=>{
		if (pswrdfield[i].type == 'password') {
				pswrdfield[i].type = 'text';
				toggleBtn[i].classList.add("active");
		 }else{
		 	pswrdfield[i].type = 'password';
		 	toggleBtn[i].classList.remove("active");
		 }
	} 
}