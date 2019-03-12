<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!-- BREADCRUMBS -->
<?php if ($this->countModules('breadcrumbs')) : ?>
	<div id="t3-breadcrumbs" class="t3-breadcrumbs">
		
			<?php if($this->params->get('breadcrumbs_layout') == "normal"):?>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<?php endif;?>
						<jdoc:include type="modules" name="<?php $this->_p('breadcrumbs') ?>" style="raw" />
			<?php if($this->params->get('breadcrumbs_layout') == "normal"):?>	
					</div>	
				</div>
			</div>
		<?php endif;?>
	</div>
<?php endif;?>
<!-- //BREADCRUMBS -->
