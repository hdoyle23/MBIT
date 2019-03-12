<?php
/*------------------------------------------------------------------------
# mod_sw_twitterDisplay - SW Twitter DISPLAY
# ------------------------------------------------------------------------
# @author - Social Widgets
# copyright - All rights reserved by Social Widgets
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://socialwidgets.net/
# Technical Support:  admin@socialwidgets.net
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die;
//all parameters
$userName = $params->get('userName');
$width = $params->get('width');
$height = $params->get('height');
$theme = $params->get('theme');
$linkColor = $params->get('linkColor');
$borderColor = $params->get('borderColor');
$limit = $params->get('limit');
$border = $params->get('border');
$scrollbar = $params->get('scrollbar');
$footer = $params->get('footer');
$header = $params->get('header');
$uselimits = $params->get('useLimits');
?>
<div
	id="tm_twitter_timeline_<?php echo $module->id; ?>"
	class="<?php echo $params->get('moduleclass_sfx');?>">

	<a
		class="twitter-timeline"
		data-width="<?php echo $width;?>"
		data-height="<?php echo $height;?>"
		data-link-color="<?php echo $linkColor;?>"
		data-chrome="<?php echo $footer.$border.$scrollbar.$header?>"
		<?php if($uselimits == 1):?>
		data-tweet-limit="<?php echo $limit;?>"
		<?php endif;?>
		data-border-color="<?php echo $borderColor;?>"
		data-theme="<?php echo $theme;?>"
		href="https://twitter.com/<?php echo $userName;?>">Tweets by @<?php echo $userName;?></a>

	<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

</div>
