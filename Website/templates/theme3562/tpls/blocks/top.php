<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

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

?>

<!-- top -->
<?php if(!$hideByView):?>

	<?php if ($this->countModules('top')) : ?>
		<div id="t3-top" class="t3-top t3-sl t3-sl-top">
			<div class="container <?php if($this->params->get('top_layout') == "fullwidth"):?>container-fullwidth<?php endif;?>">
				<div class="row">
					<jdoc:include type="modules" name="<?php $this->_p('top') ?>" style="themeHtml5" />
				</div>	
			</div>
		</div>
	<?php endif;?>

<?php endif;?>	
<!-- //top -->
