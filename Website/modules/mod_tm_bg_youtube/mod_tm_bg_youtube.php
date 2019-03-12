<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

if ($params->def('prepare_content', 1))
{
    JPluginHelper::importPlugin('content');
    $module->content = JHtml::_('content.prepare', $module->content, '', 'mod_tm_bg_youtube.content');
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$containerClass = ModTMBGYoutubeHelper::getContainer($params);
$rowClass = ModTMBGYoutubeHelper::getRow($params);
$idVideo = ModTMBGYoutubeHelper::getIdFromUrl($params->get('youtube_url'));
require JModuleHelper::getLayoutPath('mod_tm_bg_youtube', $params->get('layout', 'default'));
