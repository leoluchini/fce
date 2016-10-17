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
  $('.bootstrapmultiselect_unfold').each(function(){
  	$(this).multiselect({
	    enableFiltering: true,
	    filterPlaceholder: 'Buscar...',
	    filterBehavior: 'text',
	    enableCaseInsensitiveFiltering: true,
	    numberDisplayed: 1,
	    maxHeight: (($(this).data('maxheight') != undefined) ? $(this).data('maxheight') : 300),
	    height: (($(this).data('height') != undefined) ? $(this).data('height') : 300),
	    buttonWidth: '100%',
	    includeSelectAllOption: true,
	    selectAllText: 'Seleccionar todos',
	    templates: {
                button: '',
                ul: '<ul class="multiselect-container dropdown-menu list_fixed_search" style="display:block;width:100%"></ul>',
                filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
                filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove-circle"></i></button></span>',
                li: '<li><a href="javascript:void(0);"><label></label></a></li>',
                divider: '<li class="multiselect-item divider"></li>',
                liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
            }
    });
  });
$('.bootstrapmultiselect_unfold_simple').each(function(){
  	$(this).multiselect({
	    enableFiltering: false,
	    numberDisplayed: 1,
	    maxHeight: (($(this).data('maxheight') != undefined) ? $(this).data('maxheight') : 300),
	    height: (($(this).data('height') != undefined) ? $(this).data('height') : 300),
	    buttonWidth: '100%',
	    includeSelectAllOption: false,
	    templates: {
                button: '',
                ul: '<ul class="multiselect-container dropdown-menu" style="display:block;width:100%"></ul>',
                filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
                filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove-circle"></i></button></span>',
                li: '<li><a href="javascript:void(0);"><label></label></a></li>',
                divider: '<li class="multiselect-item divider"></li>',
                liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
            }
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