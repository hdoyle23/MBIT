<?php
/**
 * Swiper for Joomla! Module
 *
 * @author    TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2016 Jetimpex, Inc.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
 * Parts of this software are based on Camera Slideshow By Manuel Masia: http://www.pixedelic.com/plugins/camera/ & Articles Newsflash standard module
 * 
 */

defined('_JEXEC') or die;
$images = json_decode($item->images);

$itemUrl='';
if(!empty($itemURLs)){
	$itemUrl = $itemURLs[$i];
	$itemUrl = preg_replace('/\s+/', '', $itemUrl);
}
?>
<div class="swiper-slide" style="background:url(<?php echo JURI::base(true).'/'.htmlspecialchars($images->image_intro); ?>); background-size:cover;"></div>
