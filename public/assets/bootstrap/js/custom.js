function hide(event){
	event.preventDefault();
    $(document).ready(function(){ 
    	$("#frontstuff").css({
    		"z-index":"-1",
    		"visibility":"hidden"
    	});
    	$("#navBar").css("visibility","visible");
    });
}
