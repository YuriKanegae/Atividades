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
	
	$("#f1").submit(function() {
		var senha= $("input[name='senha']").val();
        senha = $.md5(senha);
        $("input[name='senha']").val(senha);
	});
	
	$(window).click(function(event) {
		/*
		var target = event.target;
		if (target.className=="modal") {
			$(".modal").css("display", "none");
		}*/
		var target = $(event.target);
		if(target.is($(".modal"))) {
			$(".modal").css("display", "none");
		}
	});
	
});