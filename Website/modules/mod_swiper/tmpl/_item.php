<?php
/**
 * Swiper for Joomla! Module
 *
 * @author    TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2016 Jetimpex, Inc.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
 * Parts of this software are based on Camera Slideshow By Manuel Masia: http://www.pixedelic.com/plugins/camera/ & Articles Newsflash standard module
 * 
 */

defined('_JEXEC') or die;
$images = json_decode($item->images);
$effects = $params->get('items_params');
$itemUrl='';
$has_item_url = 0;
if(!empty($itemURLs)){
	$itemUrl = $itemURLs[$i];
	$itemUrl = preg_replace('/\s+/', '', $itemUrl);
	if($itemUrl != ''){
		$has_item_url = 1;
	}
	
}
$check_effect = 3;
$c = 0;
$current_effect = 0;
if($effects != NULL){
	$j = 0;
	foreach($effects as $item2){
		$item_effects[$j] = $item2;
		$j++;
	}

	if($item_effects != NULL){
		for($c;$c<count($item_effects);$c++){
			if($item_effects[$c]->article_number == ($i+1)){
				$current_effect = $item_effects[$c];
				$check_effect = $current_effect->slide_effect;
			}
		}
	}
}
?>

<<?php if($has_item_url == 1):?>a href="<?php echo $itemUrl;?>"<?php else:?>div <?php endif;?>
class="swiper-slide <?php if($check_effect==1):?>slider-parallax-swiper<?php endif;?>"
<?php if($check_effect == 3): ?>
data-slide-bg="<?php echo JURI::base(true).'/'.htmlspecialchars($images->image_fulltext); ?>"
<?php endif;?>
<?php if($check_effect == 0):?>
	<?php 
	$str = strpos($current_effect->background_video_effect, ".");
	$result = substr($current_effect->background_video_effect, 0, $str);
	?>
	data-vide-bg="<?php echo JURI::base(true).'/'?>media/swiper-videos/<?php echo $result; ?>"
<?php endif;?>
<?php if($check_effect==1):?>
		data-url="<?php echo JURI::base(true).'/'.htmlspecialchars($current_effect->parallax_effect); ?>"
        data-speed="<?php echo $current_effect->parallax_effect_speed; ?>"
        data-direction="<?php echo ($current_effect->parallax_effect_direction == '1')? 'normal' : 'false';?>"
        data-mobile="false"
<?php endif;?>        
>
	<div class="swiper-slide-caption"
	<?php if($params->get('slide_content_animation')!='None'):?>
		data-caption-animate="<?php echo $params->get('slide_content_animation');?>"
	<?php endif;?>
	data-caption-delay="<?php echo $params->get('slide_content_animation_delay');?>">
		<?php if ($params->get('show_caption') == '1'): ?>
			<div class="camera_caption <?php echo $params->get('captionEffect'); ?>">

				<?php $item_heading = $params->get('item_heading', 'h4'); ?>
				<?php if ($params->get('item_title')) : ?>
		
					<<?php echo $item_heading; ?> class="slide-title">
					<?php if ($params->get('link_titles') && $item->link != '') : ?>
						<a href="<?php echo $item->link;?>">
							<?php echo $item->title;?></a>
					<?php else : ?>
						<?php echo $item->title; ?>
					<?php endif; ?>
					</<?php echo $item_heading; ?>>
		
				<?php endif; ?>
		
				<?php if (!$params->get('intro_only')) :
					/* echo $item->afterDisplayTitle; */
				endif; ?>
		
				<?php /* echo $item->beforeDisplayContent; */ ?>
		
				<?php if ($params->get('published')) : ?>
					<time datetime="<?php echo JHtml::_('date', $item->publish_up, 'Y-m-d H:i'); ?>" class="item_published">
						<?php echo JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC1')); ?>
					</time>
				<?php endif; ?>

				<?php echo $item->introtext; ?>
				
				<!-- Read More link -->
				<div class="btn-wrapper">
					
					<?php
						if($params->get("mod_button") == 1){
					        $menuLink = $menu->getItem($params->get('custom_link_menu'));

					        switch ($params->get('custom_link_route')) 
					        {
					          case 0:
					            $link_url = $params->get('custom_link_url');
					            break;
					          case 1:
					            $link_url = JRoute::_($menuLink->link.'&Itemid='.$menuLink->id);
					            break;            
					          default:
					            $link_url = "#";
					            break;
					        }
					        echo '<a class="btn custom-link" href="'. $link_url .'">'. $params->get('custom_link_title') .'</a>';
					    }
				    ?>
					

					<?php if ($params->get('readmore')) :
					$readMoreText = JText::_('MOD_SWIPER_READMORE');
						if ($item->alternative_readmore){
							$readMoreText = $item->alternative_readmore;
						}
						if(!empty($itemUrl)){
							echo '<a class="btn readmore" href="'.$itemUrl.'" target="_'.$params->get('target').'"><span>'. $readMoreText .'</span></a>';
						}
						else if(isset($item->link) && $item->readmore != 0){
							echo '<a class="btn btn-info readmore" href="'.$item->link.'" target="_'.$params->get('target').'"><span>'. $readMoreText .'</span></a>';
						}
					endif; ?>
				</div>

			</div>
		<?php endif; ?>
	</div>
</<?php if($has_item_url == 1):?>a<?php else:?>div<?php endif;?>>
