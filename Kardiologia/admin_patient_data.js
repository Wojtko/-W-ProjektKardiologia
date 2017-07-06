$(document).ready(function()
{
	$('.data').hide();
	
	$('.btn').click(function()
    {
        var panelId = $(this).attr('data-panelid');
        $('#data' + panelId).toggle();
    }); 
});
