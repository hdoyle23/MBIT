<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Mainbody 2 columns: sidebar - content
 */
$app = JFactory::getApplication();
$view = $app->input->getCmd('view', '');
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
$lside_width = $this->params->get('asideLeftWidth');
$content_width = 12 - $lside_width;
?>

<div id="t3-mainbody" class="t3-mainbody">

	<?php if(!$hideByView):?>
		<?php if ($this->countModules('map')) : ?>
			<div class="map wrap t3-sl t3-sl-map <?php $this->_c('map') ?>">
				<div class="container <?php if($this->params->get('map_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
					<div class="row">
						<jdoc:include type="modules" name="<?php $this->_p('map') ?>" style="themeHtml5" />
					</div>	
				</div>
			</div>
		<?php endif;?>
	<?php endif;?>

	<div class="container">
		<div class="row">

			<!-- SIDEBAR LEFT -->
			<div class="t3-sidebar t3-sidebar-left col-xs-12 col-sm-<?php echo $lside_width;?> <?php $this->_c($vars['sidebar-1']) ?>">
				<div class="t3-sidebar-content">
					<jdoc:include type="modules" name="<?php $this->_p($vars['sidebar-1']) ?>" style="themeHtml5" />
				</div>
			</div>

			<!-- //SIDEBAR LEFT -->
			<!-- MAIN CONTENT -->

			<div id="t3-content" class="t3-content col-xs-12 col-sm-<?php echo $content_width;?>">

				<?php if($this->hasMessage()) : ?>
					<jdoc:include type="message" />
				<?php endif ?>

				<?php if(!$hideByView):?>
					
					<?php if ($this->countModules('content-top')) : ?>
						<div class="row">
							<div class="content-top wrap t3-sl t3-sl-content-top <?php $this->_c('content-top') ?>">
								<jdoc:include type="modules" name="<?php $this->_p('content-top') ?>" style="themeHtml5" />
							</div>
						</div>
					<?php endif;?>
					
				<?php endif;?>
				
				<jdoc:include type="component" />

				<?php if(!$hideByView):?>

					<?php if ($this->countModules('content-bottom')) : ?>
						<div class="row">
							<div class="content-bottom wrap t3-sl t3-sl-content-bottom <?php $this->_c('content-bottom') ?>">
								<jdoc:include type="modules" name="<?php $this->_p('content-bottom') ?>" style="themeHtml5" />
							</div>
						</div>
					<?php endif;?>
					
				<?php endif;?>
				
			</div>
			<!-- //MAIN CONTENT -->
		</div>
	</div>
</div> 

<?php if(!$hideByView):?>

	<?php if ($this->countModules('position-1')) : ?>
		<div class="position-1 wrap t3-sl t3-sl-1 <?php $this->_c('position-1') ?>">
			<div class="container <?php if($this->params->get('position-1_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-1') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-2')) : ?>
		<div class="position-2 wrap t3-sl t3-sl-2 <?php $this->_c('position-2') ?>">
			<div class="container <?php if($this->params->get('position-2_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-2') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-3')) : ?>
		<div class="position-3 wrap t3-sl t3-sl-3 <?php $this->_c('position-3') ?>">
			<div class="container <?php if($this->params->get('position-3_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-3') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-4')) : ?>
		<div class="position-4 wrap t3-sl t3-sl-4 <?php $this->_c('position-4') ?>">
			<div class="container <?php if($this->params->get('position-4_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-4') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-5')) : ?>
		<div class="position-5 wrap t3-sl t3-sl-5 <?php $this->_c('position-5') ?>">
			<div class="container <?php if($this->params->get('position-5_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-5') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-6')) : ?>
		<div class="position-6 wrap t3-sl t3-sl-6 <?php $this->_c('position-6') ?>">
			<div class="container <?php if($this->params->get('position-6_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-6') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-7')) : ?>
		<div class="position-7 wrap t3-sl t3-sl-7 <?php $this->_c('position-7') ?>">
			<div class="container <?php if($this->params->get('position-7_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-7') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-8')) : ?>
		<div class="position-8 wrap t3-sl t3-sl-8 <?php $this->_c('position-8') ?>">
			<div class="container <?php if($this->params->get('position-8_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-8') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-9')) : ?>
		<div class="position-9 wrap t3-sl t3-sl-9 <?php $this->_c('position-9') ?>">
			<div class="container <?php if($this->params->get('position-9_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-9') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-10')) : ?>
		<div class="position-10 wrap t3-sl t3-sl-10 <?php $this->_c('position-10') ?>">
			<div class="container <?php if($this->params->get('position-10_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-10') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-11')) : ?>
		<div class="position-11 wrap t3-sl t3-sl-11 <?php $this->_c('position-11') ?>">
			<div class="container <?php if($this->params->get('position-11_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-11') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-12')) : ?>
		<div class="position-12 wrap t3-sl t3-sl-12 <?php $this->_c('position-12') ?>">
			<div class="container <?php if($this->params->get('position-12_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-12') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-13')) : ?>
		<div class="position-13 wrap t3-sl t3-sl-13 <?php $this->_c('position-13') ?>">
			<div class="container <?php if($this->params->get('position-13_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-13') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-14')) : ?>
		<div class="position-14 wrap t3-sl t3-sl-14 <?php $this->_c('position-14') ?>">
			<div class="container <?php if($this->params->get('position-14_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-14') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

	<?php if ($this->countModules('position-15')) : ?>
		<div class="position-15 wrap t3-sl t3-sl-15 <?php $this->_c('position-15') ?>">
			<div class="container <?php if($this->params->get('position-15_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('position-15') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

<?php endif;?>