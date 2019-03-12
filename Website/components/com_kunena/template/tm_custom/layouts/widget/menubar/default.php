<?php
/**
 * Kunena Component
 * @package     Kunena.Template.Crypsis
 * @subpackage  Layout.Widget
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>
<nav class="navbar navbar-default">
	<div class="navbar-inner">
		<div class="visible-lg">
			<?php echo $this->subRequest('Widget/Menu'); ?>
			<?php //if (KunenaFactory::getTemplate()->params->get('displayDropdownMenu')) :?>
				<?php //echo $this->subRequest('Widget/Login'); ?>
			<?php //endif; ?>
		</div>
		<div class="hidden-lg">
			<div class="">
				<!-- <div><a class="btn btn-link btn-toggler" data-toggle="collapse" data-target=".knav-collapse"><?php //echo KunenaIcons::hamburger();?></a></div> -->
				<?php echo $this->subRequest('Widget/Menu'); ?>
			</div>
			<?php //if (KunenaFactory::getTemplate()->params->get('displayDropdownMenu')) :?>
				<?php //echo $this->subRequest('Widget/Login'); ?>
			<?php //endif; ?>
		</div>
	</div>
</nav>