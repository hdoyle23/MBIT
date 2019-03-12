<?php
// no direct access
defined( '_JEXEC' ) or die;
//all parameters
$appID = $params->get('appID' ,'');
$pageURL = $params->get('pageURL', 'https://www.facebook.com/facebook');
$name = $params->get('name', 'Facebook');
$width = $params->get('width', '');
$height = $params->get('height', '');
$show_faces = $params->get('show_faces', true);
$hide_cover = $params->get('hide_cover', false);
$lang = JFactory::getLanguage();
JFactory::getDocument()->addScriptdeclaration('(function(d,s,a){var b,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(a))return;b=d.createElement(s);b.id=a;b.src="//connect.facebook.net/'.$lang->getTag().'/sdk.js#xfbml=1&version=v2.3&appId='.$appID.'";fjs.parentNode.insertBefore(b,fjs)}(document,\'script\',\'facebook-jssdk\'));(function($){var o=$(\'.fb-page\');$(window).load(function(){o.css({\'display\':\'block\'}).find(\'span\').css({\'width\':\'100%\',\'display\':\'block\',\'text-align\':\'inherit\'}).find(\'iframe\').css({\'display\':\'inline-block\',\'position\':\'static\'})});$(window).on(\'load resize\',function(){if(o.parent().width()<o.find(\'iframe\').width()){o.find(\'iframe\').css({\'transform\':\'scale(\'+(o.width()/o.find(\'iframe\').width())+\')\',\'transform-origin\':\'0% 0%\'}).parent().css({\'height\':(o.find(\'iframe\').height()*(o.width()/o.find(\'iframe\').width()))+\'px\'})}else{o.find(\'span\').css({\'height\':o.find(\'iframe\').height()}).find(\'iframe\').css({\'transform\':\'none\'})}})})(jQuery);');
$print_facebook = '
<div id="fb-root"></div>
<div class="fb-page"
	data-href="'.$pageURL.'"
	data-tabs="timeline"
	data-small-header="false"
	data-adapt-container-width="true"
	data-hide-cover="'.$hide_cover.'"
	data-width="'.$width.'"
	data-height="'.$height.'"
	data-show-facepile="'.$show_faces.'"
>
	<blockquote cite="'.$pageURL.'" class="fb-xfbml-parse-ignore">
		<a href="'.$pageURL.'">'.$name.'</a>
	</blockquote>
</div>'; ?>
<div id="tm_facebook_page_plugin_<?php echo $module->id; ?>" class="tm_facebook_page_plugin tm_facebook_page_plugin_<?php echo $params->get('moduleclass_sfx');?>">
	<?php echo $print_facebook; ?>
</div>