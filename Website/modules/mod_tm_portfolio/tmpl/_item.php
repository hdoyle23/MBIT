<?php
/**
 * Module TM portfolio
 *
 * @author    TemplateMonster http://www.templatemonster.com
 * @copyright Copyright (C) 2012 - 2017 Jetimpex, Inc.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
 * Parts of this software are based on Articles Newsflash standard module
 * 
*/
defined('_JEXEC') or die;
require_once (JPATH_BASE.'/components/com_content/helpers/icon.php');
$item_heading = $params->get('item_heading', 'h4');
$images = json_decode($item->images);
?>

<figure class="item_img img-intro img-intro__<?php echo $params->get("intro_image_align"); ?>">
  	<img src="<?php echo JURI::base().htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>">
    <?php if ($images->image_intro_caption): ?>
    <figcaption><?php echo htmlspecialchars($images->image_intro_caption); ?></figcaption>
    <?php endif;
      if ($params->get('readmore') && $item->readmore) : ?> 
      <!-- More -->
      <div class="more_wrapper">
          <div class="vert-align">
		      <a class="btn btn-info item_more" href="<?php echo $item->link; ?>">
		      	<span>
			        <?php if ($readmore = $item->alternative_readmore) :
			        echo $readmore;
			        if ($params->get('show_readmore_title', 0) != 0) :
			        echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit'));
			        endif;
			        elseif ($params->get('show_readmore_title', 0) == 0) :
			        echo JText::sprintf('TPL_COM_CONTENT_READ_MORE');
			        else :
			        echo JText::_('TPL_COM_CONTENT_READ_MORE');
			        echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit'));
			        endif; ?>
		      	</span>
		     </a>
      	  </div>
      </div>
  <?php endif;?>
 </figure>

 <!-- Item title -->
<?php if ($params->get('item_title')) : ?>
<<?php echo $item_heading; ?> class="item_title item_title__<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php if ($params->get('link_titles') && $item->link != '') : ?>
	<a href="<?php echo $item->link;?>"><?php echo $item->title;?></a>
	<?php else :
	echo $item->title;
	endif; ?>
</<?php echo $item_heading; ?>>
<?php endif;?>

<?php if ($params->get('createdby') == 1 && !empty($item->author )) : ?>
	<div class="item_createdby">
		<?php $author = $item->author;
		$author = ($item->created_by_alias ? $item->created_by_alias : $author);
		if (!empty($item->contactid ) && $params->get('link_author') == true) :
		echo JText::sprintf('TPL_BY', JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id=' . $item->contactid), $author));
		else :
		echo JText::sprintf('TPL_BY', $author);
		endif; ?>
	</div>
<?php endif; ?>

<?php if ($params->get('show_category')) : ?>
<dd>
	<div class="item_category-name">
		<?php
		$title = $item->category_title;
		echo JText::sprintf('TPL_IN', $title);
		?>
	</div>
</dd>
<?php endif;?>

<?php if ($params->get('published')) : ?>
<dd>
	<time datetime="<?php echo JHtml::_('date', $item->publish_up, 'Y-m-d H:i'); ?>" class="item_published">
		<?php echo JText::sprintf('TPL_ON', JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
	</time>
</dd>
<?php endif;?>

<?php if ($params->get('show_modify_date')) : ?>
<dd>
	<time datetime="<?php echo JHtml::_('date', $item->modified, 'Y-m-d H:i'); ?>" class="item_modified">
		 <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
	</time>
</dd>
<?php endif;?>

<?php if ($params->get('show_create_date')) : ?>
<dd>
	<time datetime="<?php echo JHtml::_('date', $item->created, 'Y-m-d H:i'); ?>" class="item_create">
		 <?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3'))); ?>
	</time>
</dd>
<?php endif;?>

<?php if ($params->get('show_hits')) : ?>
<dd>
	<div class="item_hits">
		<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?>
	</div>
</dd>
<?php endif;?>

<?php if ($params->get('show_tags', 1) && !empty($item->tags)) :

	$item->tagLayout = new JLayoutFile('joomla.content.tags');
	echo $item->tagLayout->render($item->tags->itemTags);
	endif;
?>

<?php if ($params->get('show_introtext')) : ?>
    <!-- Introtext -->
	<div class="item_introtext">
	    <?php 
	  	if($params->get('limit_introtext') > '0'){
	  	  echo limit_words($item->introtext, $params->get('limit_introtext'));          
	  	} else {
	  	  echo $item->introtext;
	  	}
	  	?>
    </div>
<?php endif; ?>