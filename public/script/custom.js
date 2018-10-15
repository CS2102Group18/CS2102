$("#sub").click(function (){

	var data = $("#myForm :input").serializeArray();

	$.post( $("#myForm").attr("action"), data, function(info){} );
	window.location.reload();
});

$("#myForm").submit(function() {
	return false;
});
