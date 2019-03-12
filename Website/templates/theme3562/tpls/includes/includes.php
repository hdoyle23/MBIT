<?php
defined('_JEXEC') or die;

JHtml::_('jquery.framework', true, null, true);
JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.tooltip');
JHtml::_('bootstrap.loadCss', false, $this->direction);
JHtml::_('formbehavior.chosen', 'select');

$client = new JApplicationWebClient();

include_once 'functions.php';

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
$template = $this->template;
$csspath = 'templates/'.$template.'/css/';
$jspath = 'templates/'.$template.'/js/';
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');
$menu = JMenu::getInstance('site');
$contentParams = $app->getParams('com_content');
$bodyClass = "body__".$contentParams->get('pageclass_sfx')." option-".$option." view-".$view." task-".$task." itemid-".$itemid;
$viewport = "";
$todesktop = '';
global $params;
$params = $this->params;

$themeLayout = $params->get('themeLayout');

if($themeLayout == 1) {
    $doc->addStyleSheet($csspath.'layout.css');
}
$doc->addStyleSheet($csspath.'template.css');

if(($client->platform == JApplicationWebClient::IPHONE || $client->platform == JApplicationWebClient::IPAD) && ((isset($_COOKIE['disableMobile']) && $_COOKIE['disableMobile']=='false') || !isset($_COOKIE['disableMobile']))){
    $doc->addScript($jspath.'ios-orientationchange-fix.js');
}
$doc->addScriptdeclaration('var path = "'.$jspath.'";');
$doc->addScript($jspath.'script.js');


if($client->mobile){
    $bodyClass .= ' mobile';
    if($params->get('todesktop')){
        if($client->platform != 5){
            $doc->addScript($jspath.'desktop-mobile.js');
            $todesktop = "<div class=\"col-sm-12\" id=\"to-desktop\">\r\n
            <a href=\"#\">\r\n
                <span class=\"";
            if((isset($_COOKIE['disableMobile']) && $_COOKIE['disableMobile'] == 'false') || !isset($_COOKIE['disableMobile'])){
                $todesktop .= "to_desktop\">".$params->get('todesktop_text');
            }
            else{
                $todesktop .= "to_mobile\">".$params->get('tomobile_text');
            }
            $todesktop .= "</span>\r\n
            </a>\r\n
        </div>\r\n";
        }
        if((isset($_COOKIE['disableMobile']) && $_COOKIE['disableMobile'] == 'false') || !isset($_COOKIE['disableMobile'])){
            $bodyClass .= " mobile_mode";
            $viewport = "<meta id=\"viewport\" name=\"viewport\" content=\"width=device-width, initial-scale=1\"><meta name=\"HandheldFriendly\" content=\"true\"/>
<meta name=\"apple-mobile-web-app-capable\" content=\"YES\"/>";
        }else{
            $bodyClass .= " desktop_mode";
        }
    }
} else {
    $viewport = "<meta id=\"viewport\" name=\"viewport\" content=\"width=device-width, initial-scale=1\"><meta name=\"HandheldFriendly\" content=\"true\"/>
<meta name=\"apple-mobile-web-app-capable\" content=\"YES\"/>";
}

$ie_warning = "";
if($client->browser == JApplicationWebClient::IE){
    if((int)$client->browserVersion<10){
        $ie_warning = "<div style=\"clear: both; text-align:center; position: relative;\"><a href=\"http://windows.microsoft.com/en-us/internet-explorer/download-ie\"><img src=\"templates/".$template."/images/ie.png\" border=\"0\" height=\"75\" width=\"1170\" alt=\"You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.\" /></a></div>";
    }
    if((int)$client->browserVersion<10){
        $doc->addScript($jspath.'jquery.placeholder.min.js');
    }
    $doc->addScriptdeclaration('(function($){$(document).ready(function(){var c=$("#jform_profile_dob_img");if(c.length){var h=$("body").outerHeight()+26-c.offset().top;$("head").append("<style>.calendar{top:auto !important;bottom:"+h+"px !important;}</style>")}})})(jQuery);');
}

$hideByView = false;
switch ($view){
    case 'article':
    case 'login':
    case 'search':
    case 'profile':
    case 'registration':
    case 'reset':
    case 'remind':
    case 'form':
    case 'modules':
        $hideByView = true;
        break;
}

$hideByOption = false;
if($option == 'com_users' && $option == 'com_search') $hideByOption = true;

if($option == 'com_content' && $layout == 'edit') $hideByView = true;


//TOTOP
$back_top = '';
if($this->params->get('totop') && !$client->mobile){
    $back_top = '<div id="back-top">
        <a href="#"><span></span>'.$this->params->get("totop_text").'</a>
    </div>';
} ?>