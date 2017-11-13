
jQuery(document).ready(function($) {$('.tools a').click(function(e) { 
	
    var role = $(this).data('role');
    if (role == 'h1' || role == 'h2' || role == 'h3' || role == 'h4' || role == 'h5' || role == 'h6' || role == 'p') {
      document.execCommand('formatBlock', false, role);
	}
	if (role == 'forecolor' || role == 'backcolor') {
      document.execCommand($(this).data('role'), false, $(this).data('value'));
	}
	if (role == 'URL' || role == 'IMA') {
      url = prompt('Enter the link here: ', 'http:\/\/');
      document.execCommand($(this).data('role'), false, url);
	} else document.execCommand($(this).data('role'), false, null);
});});