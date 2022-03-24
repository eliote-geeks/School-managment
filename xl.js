let xm = document.querySelector(".xml");

setInterval(()=>{
	let xhr = new XMLHttpRequest();
	xhr.open("GET",'autoload.php',true);
	xhr.onload = ()=>{
		if (xhr.readyState == 4) {
			if (xhr.status == 200) {
				let data = xhr.response;			
				xm.innerHTML = data;
			}
		}
	}	
	xhr.send();
},500);
