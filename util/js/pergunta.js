$(document).ready(function()
{	
	$('#pai').hide();
	$('#tipoPerg').on('change', function(){
		var selectValor = '#'+$(this).val();
		$('#pai').children('div').hide();
		$('#pai').show();
		$('#pai').children(selectValor).show();
		

	});
	
});