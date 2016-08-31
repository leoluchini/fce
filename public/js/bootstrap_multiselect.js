$(function(){
  $('.bootstrapmultiselect').each(function(){
  	$(this).multiselect({
	    enableFiltering: true,
	    filterPlaceholder: 'Buscar...',
	    filterBehavior: 'text',
	    enableCaseInsensitiveFiltering: true,
	    nonSelectedText: $(this).data('nonselectedsext'),
	    allSelectedText: $(this).data('allselectedtext'),
	    nSelectedText: $(this).data('nselectedtext'),
	    numberDisplayed: 1,
	    maxHeight: (($(this).data('maxheight') != undefined) ? $(this).data('maxheight') : 300),
	    height: (($(this).data('height') != undefined) ? $(this).data('height') : 300),
	    buttonWidth: '100%',
	    includeSelectAllOption: true,
	    selectAllText: 'Seleccionar todos',
    });
  });
  $('.bootstrapmultiselectnosearch').each(function(){
  	$(this).multiselect({
	    nonSelectedText: $(this).data('nonselectedsext'),
	    allSelectedText: $(this).data('allselectedtext'),
	    nSelectedText: $(this).data('nselectedtext'),
	    numberDisplayed: 1,
	    maxHeight: (($(this).data('maxheight') != undefined) ? $(this).data('maxheight') : 300),
	    height: (($(this).data('height') != undefined) ? $(this).data('height') : 300),
	    buttonWidth: '100%',
	   	includeSelectAllOption: true,
	    selectAllText: 'Seleccionar todos',
    });
  });
  $('.bootstrapmultidistinctgroups').each(function(){
  	var actual = $(this);
  	$(this).multiselect({
	    enableFiltering: true,
	    filterPlaceholder: 'Buscar...',
	    filterBehavior: 'text',
	    enableCaseInsensitiveFiltering: true,
	    nonSelectedText: $(this).data('nonselectedsext'),
	    allSelectedText: $(this).data('allselectedtext'),
	    nSelectedText: $(this).data('nselectedtext'),
	    numberDisplayed: 2,
	    maxHeight: 300,
	    height: 300,
	    buttonWidth: '250px',
	    includeSelectAllOption: false,
	    selectAllText: 'Seleccionar todos',
	    onChange: function(option, checked, select) {
	    	if(checked)
	    	{
	    		var group = option.parent();
	    		group.siblings().each(function(e){
	    			$(this).find('option:selected').each(function(e){
	    				$(this).prop("selected", false);
	    			});
	    		});
	    		actual.multiselect('refresh');
	    	}
          }
    });
  });
  $('.bootstrapmultiselectsingle').each(function(){
  	$(this).multiselect({
	    maxHeight: (($(this).data('maxheight') != undefined) ? $(this).data('maxheight') : 300),
	    height: (($(this).data('height') != undefined) ? $(this).data('height') : 300),
	    //width: 500,
	    nonSelectedText: (($(this).data('nonselectedsext') != undefined) ? $(this).data('nonselectedsext') : 'Elija una opci&oacute;n'),
	    width: '100%',
	    buttonWidth: '100%',
	    allSelectedText: false,
    });
  });
});