$(function() {

	$(".modalbtn").click(function() {
        $(".modal").css("display", "block");
    });

	$(".close").click(function() {
        $(".modal").css("display", "none");
    });

	$(".cancelbtn").click(function() {
        $(".modal").css("display", "none");
    });

	$(window).click(function(event) {
		//var target = event.target;
		//if (target.className=="modal") {
			//$(".modal").css("display", "none");
		//}
		var target = $(event.target);
		if(target.is($(".modal"))) {
			$(".modal").css("display", "none");
		}
	});

	/*
		* LocalStorage (window.) - Web Storage (HTML5)
			max-size: 5mb;
			client-side;
			no expiration;
	*/

	$('#submeter').click(function(){

		if($('#lembrete').is(':checked')){
			let email64 = btoa($("#email").val());

			let emailObject = {
				email: email64,
				'data': Date.now()
			};

			localStorage.setItem('emailObject', JSON.stringify(emailObject));

		}else{
			if(localStorage.getItem('emailObject')){
				localStorage.removeItem('emailObject');
			}
		}
	});

	getItemLocalStorage();
});

function getItemLocalStorage(){
	if(localStorage.getItem('emailObject')){
		let emailObject = JSON.parse(localStorage.getItem('emailObject'));
		let diference = (Date.now() - emailObject.data) / 86400000;

		if(diference < 2){
			let email = atob(emailObject.email);
			$('#email').val(email);
		}else{
			localStorage.removeItem('emailObject');
		}
	}

}
