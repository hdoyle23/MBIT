<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// get params
$sitename  = $this->params->get('sitename');
$slogan    = $this->params->get('slogan', '');
$logotype  = $this->params->get('logotype', 'text');
$logoimage = $logotype == 'image' ? $this->params->get('logoimage', T3Path::getUrl('images/logo.png', '', true)) : '';
$logoimgsm = ($logotype == 'image' && $this->params->get('enable_logoimage_sm', 0)) ? $this->params->get('logoimage_sm', T3Path::getUrl('images/logo-sm.png', '', true)) : false;

if (!$sitename) {
	$sitename = JFactory::getConfig()->get('sitename');
}

$app  = JFactory::getApplication();
if($menu = $app->getMenu()->getActive() != NULL){
	$menu = $app->getMenu()->getActive()->title;
} else {
	$menu = "Menu";
}
$doc = JFactory::getDocument();
$doc->addScriptdeclaration('

;(function($){
	$(window).load(function() {
		$(document).on("click touchmove",function(e) {
			
	          var container = $("#t3-mainnav .t3-navbar-collapse");
	          if (!container.is(e.target)
	              && container.has(e.target).length === 0 && container.hasClass("in"))
	          {
	              $("#t3-mainnav .t3-navbar-collapse").toggleClass("in")
	          }
	      })
		// check we miss any nav
		if($(window).width() < 768){
			$(\'.t3-navbar-collapse ul.nav\').has(\'.dropdown-menu\').t3menu({
				duration : 100,
				timeout : 50,
				hidedelay : 100,
				hover : false,
				sb_width : 20
			});
		}
	});
})(jQuery);
');

?>

<!-- HEADER -->
<header id="t3-header" class="t3-header">
	<div class="t3-header-wrapper stuck-container">
		<div class="container <?php if($this->params->get('header_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
			<div class="row tb-row">
				<?php if ($this->countModules('before-logo') ) : ?>
					<jdoc:include type="modules" name="<?php $this->_p('before-logo') ?>" style="themeHtml5" />
				<?php endif;?>

				<!-- LOGO -->
				<div class="col-sm-<?php echo $this->params->get('header_logo_width', 6);?> left-tb">
					<div class="logo">
						<div class="logo-<?php echo $logotype, ($logoimgsm ? ' logo-control' : '') ?>">
							<a href="<?php echo JUri::base() ?>" title="<?php echo strip_tags($sitename) ?>">
								<?php if($logotype == 'image'): ?>
									<img class="logo-img" src="<?php echo JUri::base(true) . '/' . $logoimage ?>" alt="<?php echo strip_tags($sitename) ?>" />
								<?php endif ?>
								<?php if($logoimgsm) : ?>
									<img class="logo-img-sm" src="<?php echo JUri::base(true) . '/' . $logoimgsm ?>" alt="<?php echo strip_tags($sitename) ?>" />
								<?php endif ?>
								<span><?php echo $sitename ?></span>
							</a>
							<small class="site-slogan"><?php echo $slogan ?></small>
						</div>
					</div>
				</div>
				<!-- //LOGO -->

				<?php if ($this->countModules('before-mainnav') ) : ?>
					<jdoc:include type="modules" name="<?php $this->_p('before-mainnav') ?>" style="themeHtml5" />
				<?php endif;?>

				
				<div class="col-sm-<?php echo $this->params->get('mainmenu_width', 6);?> right-tb">
					<nav id="t3-mainnav" class="navbar navbar-mainmenu t3-mainnav">
						<div class="t3-mainnav-wrapper">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<?php if ($this->getParam('navigation_collapse_enable', 1) && $this->getParam('responsive', 1)) : ?>
									<?php $this->addScript(T3_URL.'/js/nav-collapse.js'); ?>
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".t3-navbar-collapse">
										<i class="fa fa-bars"></i><?php echo $menu;?>
									</button>
								<?php endif ?>

								<?php if ($this->getParam('addon_offcanvas_enable')) : ?>
									<?php $this->loadBlock ('off-canvas') ?>
								<?php endif ?>

							</div>

							<?php if ($this->getParam('navigation_collapse_enable')) : ?>
							<div class="t3-navbar t3-navbar-collapse navbar-collapse collapse">
								<jdoc:include type="<?php echo $this->getParam('navigation_type', 'megamenu') ?>" name="<?php echo $this->getParam('mm_type', 'mainmenu') ?>" />
							</div>
							<?php endif ?>
						</div>
					</nav>
				</div>
				

				<?php if ($this->countModules('header') ) : ?>
					<jdoc:include type="modules" name="<?php $this->_p('header') ?>" style="themeHtml5" />
				<?php endif;?>
			</div>
		</div>
	</div>
</header>
<!-- //HEADER -->