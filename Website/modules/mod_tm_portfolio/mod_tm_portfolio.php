<?php
/**
 * Module TM portfolio
 *
 * @author    TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2017 Jetimpex, Inc.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
 * Parts of this software are based on Articles Newsflash standard module
 * 
*/

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$menu = JMenu::getInstance('site');

$app    = JFactory::getApplication(); 
$doc = JFactory::getDocument();
$document =& $doc;
$layout   = $app->input->getCmd('layout', '');

$list = ModPortfolioHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$columns = (int)$params->get('columns');

$document->addScript('modules/mod_tm_portfolio/js/isotope.pkgd.min.js');

require JModuleHelper::getLayoutPath('mod_tm_portfolio', $params->get('layout', 'default'));