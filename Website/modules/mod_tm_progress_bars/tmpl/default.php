<?php
/*------------------------------------------------------------------------
# mod_tm_progress_bars - TM Progress bars
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
//all parameters

$app    = JFactory::getApplication(); 
$doc = JFactory::getDocument();
$document =& $doc;

$template = $app->getTemplate();
include_once('templates/'.$template.'/tpls/includes/functions.php');

$items_data = json_decode($params->get('items_data'), true);
$items_data2 = json_decode($params->get('items_data2'), true);

if($params->get('choose_type') == '0'){
  $data_array = group_by_key($items_data);
} else {
  $data_array = group_by_key($items_data2);
}


$columns = $params->get('columns');

$bootcalc = 12;
$bootclass = 'col-sm-'.$bootcalc/$columns;



$doc->AddScriptDeclaration('
		;(function ($, undefined){

      $document = $(document),
      $window = $(window),
      $html = $("html"),
      plugins = {
        progressBar: $("#mod_tm_progress_bars_'.$module->id.' .progress-linear"),
        circleProgress: $("#mod_tm_progress_bars_'.$module->id.' .progress-bar-circle")
      };
     
      function isScrolledIntoView(elem) {
        var $window = $(window);
        elem.attr("val", elem.offset().top + elem.outerHeight() >= $window.scrollTop() && elem.offset().top <= $window.scrollTop() + $window.height());
        return elem.offset().top + elem.outerHeight() >= $window.scrollTop() && elem.offset().top <= $window.scrollTop() + $window.height();
      }

      $(window).load(function(){
        $("#mod_tm_progress_bars_'.$module->id.' .progress-linear").each(function(){
          $window.on("scroll load", $.proxy(function () {

            var bar = $(this);
            if (!bar.hasClass(\'animated-first\') && isScrolledIntoView(bar)) {
              var end = bar.attr("data-to");
              bar.find(\'.progress-bar-linear\').css({width: end + \'%\'});
              bar.find(\'.progress-value\').countTo({
                refreshInterval: 40,
                from: 0,
                to: end,
                speed: 500
              });
              bar.addClass(\'animated-first\');
            }
          }, $(this)));
        });
  
        $("#mod_tm_progress_bars_'.$module->id.' .progress-bar-circle").each(function(){
          if (!$(this).hasClass(\'animated\')) {

              var arrayGradients = $(this).attr(\'data-gradient\').split(",");

              $(this).circleProgress({
                value: $(this).attr(\'data-value\'),
                size: $(this).attr(\'data-size\') ? $(this).attr(\'data-size\') : 175,
                fill: {gradient: arrayGradients, gradientAngle: Math.PI / 4},
                startAngle: -Math.PI / 4 * 2,
                thickness: $(this).attr(\'data-thickness\') ? $(this).attr(\'data-thickness\') : auto,
                emptyFill: $(this).attr(\'data-empty-fill\') ? $(this).attr(\'data-empty-fill\') : "rgb(245,245,245)"

              }).on(\'circle-animation-progress\', function (event, progress, stepValue) {
                $(this).find(\'span\').text(String(stepValue.toFixed(2)).replace(\'0.\', \'\').replace(\'1.\', \'1\'));
              });
              $(this).addClass(\'animated\');

            }
        });

      });

      fixItemID = "#mod_tm_progress_bars_'.$module->id.'";

      function ie10HeightFix(id){
        $("body").find(id).find(".progress-bar-circle canvas").each(function(){
          width = $(this).width();
          $(this).height(width);
        });
      }

      $(window).on("load scroll", function(){
        if($(".mod_tm_progress_bars").length > 0){
          ie10HeightFix(fixItemID);
        }
      });
          
		})(jQuery);
	');
?>

<?php if ($params->get('pretext')): ?>
  <div class="pretext">
    <?php echo $params->get('pretext') ?>
  </div>
<?php endif;?>


<div id="mod_tm_progress_bars_<?php echo $module->id;?>" class="mod_tm_progress_bars mod_tm_progress_bars__<?php echo $params->get('moduleclass_sfx');?>">
  <div class="row">
    <?php
      $i = 0;
      foreach($data_array as $key=>$value){
        $res[$i] = $value;
        require JModuleHelper::getLayoutPath('mod_tm_progress_bars', '_item');
        $i++;
      }
    ?>
  </div>
</div>