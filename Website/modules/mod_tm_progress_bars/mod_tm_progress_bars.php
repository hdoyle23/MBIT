<?php
/**
 * Module TM Progress bars
 *
 * @author    TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2017 Jetimpex, Inc.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2
 * 
*/
// no direct access
defined( '_JEXEC' ) or die;

$app    = JFactory::getApplication(); 
$doc = JFactory::getDocument();
$document = $doc;
JHtml::_('jquery.framework');
$doc->addScript('modules/mod_tm_progress_bars/js/mod_tm_progress_bars.js');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_tm_progress_bars', $params->get('layout', 'default'));