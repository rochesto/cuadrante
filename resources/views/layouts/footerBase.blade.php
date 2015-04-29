<script type="text/javascript" >

    $(document).ready(function(){

    	$("#sidebar-mobile").hide();
    	
    	$("#menuMobile").on('click', function(event) {
    		event.preventDefault();
            
            if($('#sidebar-mobile').is(':visible')) {
                $("#sidebar-mobile").hide();
            }else{
                $("#sidebar-mobile").show();
            }
    		
    	});
    	
    });
	    
</script>