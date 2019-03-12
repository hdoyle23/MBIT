<?php
/**
 * Swiper for Joomla! Module
 *
 * @author    TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2013 Jetimpex, Inc.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
 * Parts of this software are based on Camera Slideshow By Manuel Masia: http://www.pixedelic.com/plugins/camera/ & Articles Newsflash standard module
 * 
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$app 	  = JFactory::getApplication();	
$doc = JFactory::getDocument();
$document =& $doc;
$template = $app->getTemplate();
$menu = JMenu::getInstance('site');
// Include Swiper styles
switch($params->get('theme')){
	case 0:
		$document->addStyleSheet('modules/mod_swiper/css/swiper.css');
		break;
	case 1:
		$document->addStyleSheet('templates/'.$template.'/css/swiper.css');
		break;
}

// Include Swiper scripts
switch($params->get('script')){
	case 0:
		$document->addScript('modules/mod_swiper/js/swiper.min.js');
		break;
	case 1:
		$document->addScript('templates/'.$template.'/js/swiper.min.js');
		break;	
}

$document->addStyleSheet('modules/mod_swiper/css/animate.css');

$list = modSwiperHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_swiper', $params->get('layout', 'default'));
