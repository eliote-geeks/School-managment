const form = document.querySelector(".typing-area");
let inputField = form.querySelector(".input-field");
let sendBtn = form.querySelector("button");
let chatBox = document.querySelector(".chat-box");
let header = document.querySelector("header");

form.onsubmit = (e)=>{
	e.preventDefault();
}

chatBox.onmouseenter = ()=>{
	chatBox.classList.add('active');
}

chatBox.onmouseleave = ()=>{
	chatBox.classList.remove('active');
}


sendBtn.onclick = ()=>{
	let xhr = new XMLHttpRequest();
	xhr.open("POST","http://localhost/niceAdmin/profil/msg/chat/insert.php",true);
	xhr.onload = ()=>{
		if (xhr.readyState == 4) {
			if (xhr.status == 200) {
				inputField.value = "";
				if(!chatBox.classList.contains('active')){
					scrollToBottom();
				}
			}
			else{
				console.log('no');
			}
		}
	}
	let formData = new FormData(form);
	xhr.send(formData);
}


setInterval(()=>{
	let xhr = new XMLHttpRequest();
	xhr.open("POST",'http://localhost/niceAdmin/profil/msg/chat/chat.php',true);
	xhr.onload = ()=>{
		if (xhr.readyState == XMLHttpRequest.DONE) {
			if (xhr.status == 200) {
				let data = xhr.response;			
				chatBox.innerHTML = data;
				scrollToBottom();     			
			}
		}
	}
	let formData = new FormData(form);
	xhr.send(formData);
},500);

function scrollToBottom(){
	chatBox.scrollTop = chatBox.scrollHeight;
}



// setInterval(()=>{
// 	let xhr = new XMLHttpRequest();
// 	xhr.open("GET",'/../msg/chat/data.php',true);
// 	xhr.onload = ()=>{
// 		if (xhr.readyState == XMLHttpRequest.DONE) {
// 			if (xhr.status == 200) {
// 				let data = xhr.response;				
// 				header.innerHTML = data;
// 			}
// 		}
// 	}
// 	xhr.send();
// },500);