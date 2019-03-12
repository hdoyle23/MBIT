<?php
/**
 * Module TM Counters
 *
 * @author    TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2016 Jetimpex, Inc.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
 */

defined('_JEXEC') or die;
?>

<div class="counter-wrapper">
	<div class="counter-wrapper-box">
		<div class="counter-wrapper-box_content">
			<div class="counter-value" data-from="0" data-to="<?php echo $res[$i][1];?>" data-speed="<?php echo $params->get('animation_speed');?>"></div>
			<div class="counter-title">
				<?php echo $res[$i][0];?>
			</div>
		</div>
	</div>
</div>