;(function($){
	$.fn.style_switcher = function(path, cookie_path){
		count = $("#color-box").attr('data-scheme-count');
		$('#style_switcher .color_scheme').click(function(){
			
			href = $(this).attr('data-scheme');
			theme_number = href.substr(href.length - 1);

			$("#color_preloader").addClass('on');
			setTimeout(function(){
				$("#color_preloader").removeClass('on');
			},1000);

			if($('link#color_scheme').length){
				$('link#color_scheme').remove();
			}

			if($(this).attr('data-scheme') != 'theme-default'){
				css_array = $(this).attr('data-css-array').split(',');
				for(i = 0; i<=css_array.length-1;i++){
					$('body').append('<link id="color_scheme" rel="stylesheet" href="'+path+href+'/'+css_array[i].replace(/\s/g, '')+'.css">');
				}
			}

			$('#style_switcher li').removeClass('active');
			$(this).closest('li').addClass('active');
			createCookie('color_scheme', href, 0, cookie_path);
			var request = {
	            'option' : 'com_ajax',
	            'module' : 'tm_style_switcher',
	            'format' : 'raw',
	            'method':'clearcache'
	        };
			$.ajax({
	            type   : 'POST',
	            data   : request
	        })
		})
	}
})(jQuery);