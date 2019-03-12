<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$client = new JApplicationWebClient();
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
$todesktop = '';
if($client->mobile){
	if($this->params->get('todesktop')){
        if($client->platform != 5){
            $doc->addScript($jspath.'desktop-mobile.js');
            $todesktop = "<div class=\"col-sm-12\" id=\"to-desktop\">\r\n
            <a href=\"#\">\r\n
                <span class=\"";
            if((isset($_COOKIE['disableMobile']) && $_COOKIE['disableMobile'] == 'false') || !isset($_COOKIE['disableMobile'])){
                $todesktop .= "to_desktop\">".$this->params->get('todesktop_text');
            }
            else{
                $todesktop .= "to_mobile\">".$this->params->get('tomobile_text');
            }
            $todesktop .= "</span>\r\n
            </a>\r\n
        </div>\r\n";
        }
        if((isset($_COOKIE['disableMobile']) && $_COOKIE['disableMobile'] == 'false') || !isset($_COOKIE['disableMobile'])){
            $bodyClass .= " mobile_mode";
            $viewport = "<meta id=\"viewport\" name=\"viewport\" content=\"width=device-width, initial-scale=1\">";
        }else{
            $bodyClass .= " desktop_mode";
        }
    }
}
$privacyMenuLink = $menu->getItem($this->params->get('privacy_link_menu'));

$privacy_link_url = JRoute::_($privacyMenuLink->link.'&Itemid='.$privacyMenuLink->id);
?>

<!-- FOOTER -->
<footer id="t3-footer" class="wrap t3-footer">

	<?php if ($this->countModules('footer-1')) : ?>
		<div class="footer-1 wrap t3-sl t3-sl-footer-1 <?php $this->_c('footer-1') ?>">
			<div class="container <?php if($this->params->get('footer-1_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('footer-1') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('footer-2')) : ?>
		<div class="footer-2 wrap t3-sl t3-sl-footer-2 <?php $this->_c('footer-2') ?>">
			<div class="container <?php if($this->params->get('footer-2_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('footer-2') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('footer-3')) : ?>
		<div class="footer-3 wrap t3-sl t3-sl-footer-3 <?php $this->_c('footer-3') ?>">
			<div class="container <?php if($this->params->get('footer-3_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('footer-3') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('footer-4')) : ?>
		<div class="footer-4 wrap t3-sl t3-sl-footer-4 <?php $this->_c('footer-4') ?>">
			<div class="container <?php if($this->params->get('footer-4_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('footer-4') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>


		
	<?php if($this->params->get('footer_layout') == "normal"):?>
	<div class="wrap t3-sl t3-sl-footer <?php $this->_c('footer') ?>">
		<div class="container">
			<div class="row">
	<?php endif;?>

	<?php if($this->params->get("enable_footer_logo")== '1'):?>
		<div class="col-sm-<?php echo $this->params->get("footer_logo_width", "3");?>">

			<?php if($this->params->get("footer_logoimage") != ''):?>	
			<div class="logo-wrapper">
				<a class="footer_logoimage" href="<?php echo $this->baseurl; ?>">
	            	<img src="<?php echo $this->params->get("footer_logoimage"); ?>" alt="<?php echo $sitename; ?>"/>
	        	</a>
			</div>
			<?php endif;?>

	        <div class="footer_title">
	        	<?php echo $this->params->get("footer_title");?>
	        </div>
	        <div class="footer_slogan">
	        	<?php echo $this->params->get("footer_slogan");?>
	        </div>
	        <div class="footer_logo_aftertext">
	        	<?php echo $this->params->get("footer_logo_aftertext");?>
	        </div>
		</div>
	<?php endif;?>

	<?php if($this->countModules('footer')):?>
		<jdoc:include type="modules" name="<?php $this->_p('footer') ?>" style="themeHtml5" />
	<?php endif;?>

	<div class="copyright col-sm-12">
		<span class="year"><?php echo date('Y')?></span>
		<span class="copy">&copy;.</span>
		<span class="siteName"><?php echo $sitename; ?>.</span>
		<span class="rights">All Rights Reserved | </span>
		<?php if($this->params->get('privacyLink')){ ?>
	        <a class="privacy_link" rel="license" href="<?php echo $privacy_link_url; ?>">
	            <?php echo $this->params->get('privacy_link_title'); ?>
	        </a>
		<?php }?>	
		<jdoc:include type="modules" name="<?php $this->_p('copyright') ?>" style="themeHtml5" />        
	</div>

	<?php if($this->params->get('footer_layout') == "normal"):?>	
			</div>
		</div>
	</div>
	<?php endif;?>
	

    <?php echo $todesktop; ?>
	

</footer>
<!-- //FOOTER -->