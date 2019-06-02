$(function() {
	/*topClock*/
	$('#jclock1').jclock({
		format: '%A, %d %B %Y %I:%M:%S %p' // 12-hour
	});
});

var openUrl = function (urlContent) {
	window.history.pushState('','',urlContent);	
					
	$.ajax({url:urlContent+'?rel=tab',success: function(data){
		$('#page-content').html(data);
		$("#page-content").find("script").each(function(i) {
			//eval($(this).text());
		});
	}});	
	return false;  
};       
	
function chooseApp(obj) {
	if (obj.checked){
		//alert("checked!");
		$(obj).parent().parent().addClass("selected");
	}else{
		//alert("unchecked!");
		if ( $(obj).parent().parent().hasClass('selected') ) {
			$(obj).parent().parent().removeClass('selected');
		}
	}
	
}	