<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_owl_carousel
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$app 	  = JFactory::getApplication();	
$doc = JFactory::getDocument();
$document =& $doc;
$template = $app->getTemplate();
$layout   = $app->input->getCmd('layout', '');

// Include Owl Carousel scripts
$document->addScript('modules/mod_owl_carousel/js/jquery.owl-carousel.js');


$list = modOwlCarouselHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_owl_carousel', $params->get('layout', 'default'));
