<?php
/**
 * @package Module TM Style Switcher for Joomla! 3.x
 * @version 2.0.0: mod_tm_style_switcher.php
 * @author TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2017 Jetimpex, Inc.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
**/

defined('_JEXEC') or die;
//T3 framework color switcher
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$template = $app->getTemplate();
$color_schemes = JPATH_SITE.'/templates/'.$template.'/local/css/themes/';
if(file_exists($color_schemes)){
$host2='livedemo00.template-help.com';
$host='cms.devoffice.com';
if($_SERVER['HTTP_HOST']==$host2 || $_SERVER['HTTP_HOST']==$host){
    $doc->addStyleSheet('modules/mod_tm_style_switcher/css/style.css');
    $doc->addScript('modules/mod_tm_style_switcher/js/jquery.cookies.js');
    $doc->addScriptDeclaration('jQuery(function($){$("#style_switcher .toggler").click(function(){$("#style_switcher").toggleClass("shown")});$("#style_switcher").style_switcher("'.JURI::base(true).'/templates/'.$template.'/local/css/themes/","' .JURI::base(true).'")});');
    $color_schemes_array = array();
    $key = 0;
    $count_schemes = 0;
    $last_item = '';
    for($i = 1; $i <= 4; $i++){
        $color_schemes = JPATH_SITE.'/templates/'.$template.'/local/css/themes/theme-'.$i;
        if(file_exists($color_schemes)){
            foreach (new DirectoryIterator($color_schemes) as $file){
                if($file->isDot()) continue;
                if($file->getExtension()=='css'){
                    if($file->getBasename('.css') === 'template'){
                         $color_schemes_array[$i][$key] = $file->getBasename('.css');
                         $key++;
                    }
                }
            }
            $count_schemes++;
        }
    }
    ?>
<div id="style_switcher">
    <div class="toggler"></div>
    <p><?php echo JText::_('MOD_TM_STYLE_SWITCHER_BOX_LABEL'); ?></p>
<?php $html = '';?>
<?php if($_SERVER['HTTP_HOST']==$host2 || $_SERVER['HTTP_HOST']==$host){
    $doc->addScript('modules/mod_tm_style_switcher/js/style_switcher_demo.js'); ?>
<?php } ?>
    <ul id="color-box" data-scheme-count="<?php echo $count_schemes;?>">
    <li>
        <div class="color_scheme color_scheme_0" data-scheme="theme-default">&nbsp;</div>
    </li>
    <?php for($i = 1; $i <= $count_schemes; $i++):?>
        <li>
            <div class="color_scheme color_scheme_<?php echo $i;?>" data-scheme="theme-<?php echo $i;?>" data-css-array="
            <?php
                $key = 0;
                foreach ($color_schemes_array[$i] as $file){
                   
                    if($key < count($color_schemes_array[$i])-1){
                        echo $file.",";
                    } else {
                        echo $file;
                    }
                    $key++;
                }
            
            ?>
            ">&nbsp;</div>
        </li>
    <?php endfor;?>
    </ul>
    <?php echo $html; ?>
</div>
<?php 
}
} ?>

