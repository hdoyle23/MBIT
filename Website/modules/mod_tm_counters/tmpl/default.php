<?php
/*------------------------------------------------------------------------
# Module TM Counters
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
include_once('templates/'.$template.'/tpls/includes/functions.php');
//all parameters

$app    = JFactory::getApplication(); 
$doc = JFactory::getDocument();
$document = $doc;
$template = $app->getTemplate();

$items_data = json_decode($params->get('items_data'), true);
$data_array = group_by_key($items_data);

$columns = $params->get('columns');
$n = count($data_array);

$j = 0;

foreach($data_array as $key=>$value){
  $res[$j] = $value;
  $j++;
}

if($n<$columns){
  $columns = $n;
}

$rows = ceil($n/$columns);

$bootcalc = 12;
$bootclass = "";
if($columns != 5){
  $bootclass = 'col-sm-'.$bootcalc/$columns;
}

?>

<div id="mod_tm_counters_<?php echo $module->id;?>" class="mod_tm_counters mod_tm_counters__<?php echo $moduleclass_sfx;?> cols-<?php echo $columns;?>">

  <?php if ($params->get('pretext')): ?>
    <div class="pretext">
      <?php echo $params->get('pretext') ?>
    </div>
  <?php endif;?>

  <div class="row">
    <?php
      for ($i = 0, $n; $i < $n; $i ++){

        if($rows > 1 && $i !== 0 && $i % $columns == 0){
          echo '</div><div class="row">';
        }
    ?>
    <div class="<?php echo $bootclass; ?> counter_item item_num_<?php echo $i; ?>">
      <?php require JModuleHelper::getLayoutPath('mod_tm_counters', '_item');?>
    </div>

    <?php }?>
  </div>
</div>


<?php $doc->AddScriptDeclaration('

	;(function ($, undefined){

    $(document).ready(function(){
      function isScrolledIntoView(elem) {
        var $window = $(window), $elem = $(elem);
        return $elem.offset().top + $elem.height() >= $window.scrollTop() && $elem.offset().top <= $window.scrollTop() + $window.height();
      }

      if(isScrolledIntoView("#mod_tm_counters_'.$module->id.' .counter-value") && !$("#mod_tm_counters_'.$module->id.' .counter-value").hasClass("animated")){
        $("#mod_tm_counters_'.$module->id.' .counter-value").countTo();
        $("#mod_tm_counters_'.$module->id.' .counter-value").addClass("animated");
      }
      
      $(document).on("scroll", function(){
        if(isScrolledIntoView("#mod_tm_counters_'.$module->id.' .counter-value") && !$("#mod_tm_counters_'.$module->id.' .counter-value").hasClass("animated")){
          $("#mod_tm_counters_'.$module->id.' .counter-value").countTo();
          $("#mod_tm_counters_'.$module->id.' .counter-value").addClass("animated");
        }
      });
     
    });
        
	})(jQuery);

');
?>

