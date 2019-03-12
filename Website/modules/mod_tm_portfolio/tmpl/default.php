<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_tm_portfolio
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

$n = count($list);

if($n<$columns){
  $columns = $n;
}
$bootcalc = 12;
$bootclass = 'col-sm-'.$bootcalc/$columns;
$rows = ceil($n/$columns);

$app    = JFactory::getApplication(); 
$doc = JFactory::getDocument();
$document = $doc;

$items_catids = array();
$items_cat_title = array();

foreach ($list as $key => $value) {
  $items_catids[] = $value->catid;
  $items_cat_title[] = $value->category_title;
}

$items_catids = array_unique($items_catids);
$items_cat_title = array_unique($items_cat_title);



JFactory::getLanguage()->load('com_content', JPATH_SITE, null, true); ?>


<div id="mod_tm_portfolio_<?php echo $module->id;?>" class="mod_tm_portfolio mod_tm_portfolio__<?php echo $moduleclass_sfx; ?>">

  <?php if ($params->get('pretext')): ?>
    <div class="pretext">
      <?php echo $params->get('pretext') ?>
    </div>
  <?php endif;?>

  <div class="clearfix"></div>

  <?php if($params->get('show_filter')): ?>

    <div class="portfolio_filters">
      <b><?php echo JText::_('TPL_COM_CONTENT_GALLERY_FILTER_BY_CATEGORY'); ?></b>
      <ul id="filters" class="btn-group">
        <li><a class="filter btn active" data-category="all"><?php echo JText::_('TPL_COM_CONTENT_GALLERY_FILTER_SHOW_ALL'); ?></a></li>
        <?php foreach ($items_cat_title as $key => $value) : ?>
        <li><a class="filter btn" data-category="<?php echo JFilterOutput::stringURLSafe($value);?>"><?php echo $value; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

  <?php endif;?>

  <?php if($params->get('show_sort')): ?>

  <div class="portfolio_sorting">
    <ul id="sort" class="nav nav-tabs">
      <li><a class="sort sort-by asc" data-order="asc" data-sort-value="name"><?php echo JText::_('TPL_COM_CONTENT_GALLERY_FILTER_NAME'); ?></a>
          <a class="sort sort-by desc" data-order="desc" data-sort-value="name"><?php echo JText::_('TPL_COM_CONTENT_GALLERY_FILTER_NAME'); ?></a>
      </li>
      <li><a class="sort sort-by asc" data-sort-value="data" data-order="asc"><?php echo JText::_('TPL_COM_CONTENT_GALLERY_FILTER_DATE'); ?></a>
          <a class="sort sort-by desc" data-sort-value="data" data-order="desc"><?php echo JText::_('TPL_COM_CONTENT_GALLERY_FILTER_DATE'); ?></a>
      </li>
      <li><a class="sort sort-by asc" data-sort-value="popularity" data-order="asc"><?php echo JText::_('TPL_COM_CONTENT_GALLERY_FILTER_POPULARITY'); ?></a>
          <a class="sort sort-by desc" data-sort-value="popularity" data-order="desc"><?php echo JText::_('TPL_COM_CONTENT_GALLERY_FILTER_POPULARITY'); ?></a>
      </li>
    </ul>
  </div>

  <?php endif;?>

  <ul id="isotopeContainer_<?php echo $module->id;?>" class="portfolio-container row cols-<?php echo $params->get('columns');?>">
    <?php
    for ($i = 0, $n; $i < $n; $i ++) :
    ?>
      <?php
        $item = $list[$i];
      ?>
    <li class="portfolio-item <?php echo $bootclass;?> <?php echo JFilterOutput::stringURLSafe($item->category_title);?> all" data-date="<?php echo JHtml::_('date', $item->publish_up, 'YmdHis'); ?>" data-name="<?php echo $item->title; ?>" data-popularity="<?php echo $item->hits; ?>" data-category="<?php echo JFilterOutput::stringURLSafe($item->category_title);?>">
      <div class="portfolio-item__content">
        <?php
          require JModuleHelper::getLayoutPath('mod_tm_portfolio', '_item');
        ?>
        <div class="clearfix"></div>
      </div>
    </li>
    <?php endfor; ?>
  </ul>

  <div class="clearfix"></div>

  <?php if($params->get('mod_button') == 1): ?>   
  <div class="module-custom-link">
    <?php 
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
        echo '<a class="btn btn-info" href="'. $link_url .'">'. $params->get('custom_link_title') .'</a>';
    ?>
  </div>
  <?php endif; ?>
</div>



<?php

if($params->get('masonry') == 1){
  $layout = 'masonry';
} else {
  $layout = 'fitRows';
}

$js="
;(function($){
  $(window).load(function(){
    var grid = $('#isotopeContainer_".$module->id."').isotope({
      itemSelector: '.portfolio-item',
      layoutMode: '".$layout."',
      getSortData: {
        name: '[data-name]',
        data: '[data-date]',
        popularity: '[data-popularity]'
      },
      sortBy: '',
      sortAscending: false
    });

    $('#mod_tm_portfolio_".$module->id." .sort-by').on( 'click', function() {
      var sortValue = $(this).attr('data-sort-value');
      // make an array of values
      sortValue = sortValue.split(',');
      if($(this).data('order') == 'desc'){
        grid.isotope({ sortBy: sortValue, sortAscending: false});
      } else if($(this).data('order') == 'asc'){
        grid.isotope({ sortBy: sortValue, sortAscending: true });
      }
    });

    $('#mod_tm_portfolio_".$module->id." .filter').on( 'click', function() {
      $('#mod_tm_portfolio_".$module->id." .filter').each(function(){
        $(this).removeClass('active');
      });
      $(this).addClass('active');
      var sortValue = $(this).attr('data-category');
      // make an array of values
      sortValue = sortValue.split(',');
      grid.isotope({ itemSelector: '.portfolio-item', filter: '.'+sortValue });
      
    });

  })
})(jQuery);
";

 ?>
<?php 
if($params->get('show_sort')){
  $js .= '
  jQuery(document).ready(function($){
    $("#mod_tm_portfolio_'.$module->id.' #sort .sort").on("click",function(){
      $("#sort .sort").removeClass("selected").removeClass("active");
      $("#sort .sort").closest("li").removeClass("active");
      if($(this).attr("data-order")=="desc"){
        $(this).removeClass("block");
        $(this).prev().removeClass("none");
      }
      else{
        $(this).addClass("none");
        $(this).next().addClass("block");
      }
    })
  });
';
}
$document->addScriptdeclaration($js);
?>


