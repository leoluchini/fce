$(function () {
	$('body').tooltip({
		selector: "[data-toggle='tooltip']"
	});

	$('body').on("click", ".confirm_modal", function(e) {
	   var link = $(this);
	   e.preventDefault();
	   modal = $("#generic_modal");

	   modal.find("#myModalLabel").empty().html(link.data('titulo'));
	   modal.find(".modal-body").empty().html(link.data('mensaje'));

	   modal.find(".modal-footer").empty().html($($('#botones_confirmacion').html()));
	   modal.find(".modal-footer").find("#button-ok").attr("href", link.attr('href'))
	   modal.modal({show:true});
	});

	$('body').on("click", ".confirm_modal", function(e) {
	   var link = $(this);
	   e.preventDefault();
	   modal = $("#generic_modal");

	   modal.find("#myModalLabel").empty().html(link.data('titulo'));
	   modal.find(".modal-body").empty().html(link.data('mensaje'));

	   modal.find(".modal-footer").empty().html($($('#botones_confirmacion').html()));
	   modal.find(".modal-footer").find("#button-ok").attr("href", link.attr('href'))
	   modal.modal({show:true});
	});
});