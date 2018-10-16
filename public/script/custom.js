$("#sub").click(function (){

	var data = $("#myForm :input").serializeArray();

	$.post( $("#myForm").attr("action"), data, function(info){} );
	window.location.reload();
});

$("#myForm").submit(function() {
	return false;
});

$("#deleteProj").click(function (){

	var data = $("#deleteProjForm :input").serializeArray();

	$.post( $("#deleteProjForm").attr("action"), data, function(info){} );
	window.location.reload();
});

$("#deleteProjForm").submit(function() {
	return false;
});
