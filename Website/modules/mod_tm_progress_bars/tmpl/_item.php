<?php
/**
 * TM Progress bars
 *
 * @author    TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2016 Jetimpex, Inc.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
 */

defined('_JEXEC') or die;
?>

<?php if($params->get('choose_type') == '0'):?>

	<div data-to="<?php echo $res[$i][1];?>" class="progress-linear <?php echo $bootclass;?>">
	  <div class="progress-header clearfix"><span class="progress-title"><?php echo $res[$i][0];?></span><span class="progress-value"><?php echo $res[$i][1];?></span></div>
	  <div class="progress-bar-linear-wrap">
	    <div class="progress-bar-linear" style="background: <?php if($res[$i][2] != ''):?><?php echo $res[$i][2];?><?php else:?>#fff<?php endif;?>"></div>
	  </div>
	</div>

<?php endif;?>

<?php if($params->get('choose_type') == '1'):?>

	<div class="progress-circle <?php echo $bootclass;?>">
		<div
		data-value="<?php echo $res[$i][1]/100;?>"
		data-gradient="<?php echo $res[$i][2];?>, <?php echo $res[$i][3];?>"
		data-empty-fill="<?php echo $res[$i][4];?>"
		data-thickness="<?php echo $params->get('thickness' , 50);?>"
		data-size="1000"
		class="progress-bar-circle"><span></span>
		</div>
		<div class="title"><?php echo $res[$i][0];?></div>
	</div>
	
<?php endif;?>