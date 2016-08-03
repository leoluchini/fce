$(function(){
	$(document).on('click', '.input_file_image', function(){
		var input = '#'+$(this).data('inputid');
		var contenedor = '#'+$(this).data('containerid');
		$(input).on('change', function()
		{
			$(contenedor).empty();
			$(contenedor).html('<br>'+$(this).val())
		});
		$(input).click();
	});

	$('.show_preview').change(function(){
		var img = '#'+$(this).data('imgid');
		$(img).hide();
		loadImage(this, img);
	});

	function loadImage(input, img) 
	{
		if (input.files && input.files[0])
		{
		    var reader = new FileReader();

		    reader.onload = function (e) 
		    {
		        $(img).attr('src', e.target.result);
		        $(img).show();
		    }

		    reader.readAsDataURL(input.files[0]);
		}
	}
});