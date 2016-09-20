$(function(){
 
    activePanel = $("#accordion div.panel-accordion:first");
    $(activePanel).addClass('active');
 
    $("#accordion").delegate('.panel-accordion', 'click', function(e){
        if( ! $(this).is('.active') ){
			$(activePanel).animate({width: "44px"}, 300);
			$(this).animate({width: "85%"}, 300);
			$('#accordion .panel-accordion').removeClass('active');
			$(this).addClass('active');
			activePanel = this;
		 };
    });
/*
    $("body").on('click',".list-group-item", function(event){
    	event.stopPropagation();
    	event.preventDefault();
    	$(this).parent().find('.active').removeClass('active');
    	$(this).addClass('active');
        panel_id = $(this).closest(".panel-accordion").attr('id');
        if($('.breadcrumb').has('#link-'+panel_id).length){
            $('.breadcrumb #link-'+panel_id).nextAll().remove();
            $('.breadcrumb #link-'+panel_id).remove();
        }
        $(".breadcrumb").append('<li id="link-'+panel_id+'"><a class="breadcrumb-link" href="#'+panel_id+'">'+$(this).html()+'</a></li>');
        next = $('.panel-accordion.active').next();
        next.find('.loading').removeClass('hide');
        $(next).find('.list-plan').html('');
        next.trigger('click'); 
        $.ajax({
            url: $(this).attr('href'),
            success: function(data){
                $(next).find('.list-plan').html(data.html);
                $(next).find('.loading').addClass('hide');
            }
        })
    })

    $("body").on('click',".breadcrumb-link", function(event){
        event.stopPropagation();
        event.preventDefault();
        $($(this).attr('href')).click();  
    })*/
});