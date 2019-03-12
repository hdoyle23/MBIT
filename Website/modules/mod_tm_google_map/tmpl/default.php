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

?>

<div
  id="mod_tm_google_map_<?php echo $module->id;?>"
  class="mod_tm_google_map mod_tm_google_map__<?php echo $moduleclass_sfx;?>"
>
<div class="map_preloader">
  <svg width="84" height="84" viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg" stroke="#fff">
    <g fill="none" fill-rule="evenodd" stroke-width="2">
        <circle cx="22" cy="22" r="1">
            <animate attributeName="r"
                begin="0s" dur="1.8s"
                values="1; 20"
                calcMode="spline"
                keyTimes="0; 1"
                keySplines="0.165, 0.84, 0.44, 1"
                repeatCount="indefinite" />
            <animate attributeName="stroke-opacity"
                begin="0s" dur="1.8s"
                values="1; 0"
                calcMode="spline"
                keyTimes="0; 1"
                keySplines="0.3, 0.61, 0.355, 1"
                repeatCount="indefinite" />
        </circle>
        <circle cx="22" cy="22" r="1">
            <animate attributeName="r"
                begin="-0.9s" dur="1.8s"
                values="1; 20"
                calcMode="spline"
                keyTimes="0; 1"
                keySplines="0.165, 0.84, 0.44, 1"
                repeatCount="indefinite" />
            <animate attributeName="stroke-opacity"
                begin="-0.9s" dur="1.8s"
                values="1; 0"
                calcMode="spline"
                keyTimes="0; 1"
                keySplines="0.3, 0.61, 0.355, 1"
                repeatCount="indefinite" />
        </circle>
    </g>
  </svg>
</div>
  <div
    class="rd-google-map rd-google-map__model"
    data-zoom="<?php echo $params->get('map_zoom_level', '10');?>"
    data-y="<?php echo $res[0][1];?>"
    data-x="<?php echo $res[0][0];?>"
    data-marker="<?php echo JURI::base(true).'/'.$params->get('marker-base');?>"
    data-marker-active="<?php echo JURI::base(true).'/'.$params->get('marker-active');?>"
    style="height: <?php echo $params->get('map_height', '400px');?>"
  >
    <ul class="map_locations">
      <?php for ($i = 0, $n; $i < $n; $i ++):?>
      <li data-y="<?php echo $res[$i][1];?>" data-x="<?php echo $res[$i][0];?>">
        
        <?php if($res[$i][3] != ''):?>
          <div class="image">
            <img src="<?php echo $res[$i][3];?>" alt="">
          </div>
        <?php endif;?>
        <?php if($res[$i][2] != ''):?>
        <div class="desc">
          <p>
            <?php echo $res[$i][2];?>
          </p>
        </div>
        <?php endif;?>
      </li>
      <?php endfor;?>
    </ul>
  </div>
</div>


<?php $doc->AddScriptDeclaration('
	;(function ($, undefined){

    $(document).ready(function(){

      /**
       * isScrolledIntoView
       * @description  check the element whas been scrolled into the view
       */
      function isScrolledIntoView(elem) {
        
          return elem.offset().top + elem.outerHeight() >= $(window).scrollTop() && elem.offset().top <= $(window).scrollTop() + $(window).height();
        
      }

      /**
       * initOnView
       * @description  calls a function when element has been scrolled into the view
       */
      function lazyInit(element, func) {
        var $win = jQuery(window);
        $win.on(\'load scroll\', function () {
          if ((!element.hasClass(\'lazy-loaded\') && (isScrolledIntoView(element)))) {
            func.call();
            element.addClass(\'lazy-loaded\');
          }
        });
      }

      var head = document.getElementsByTagName(\'head\')[0],
        insertBefore = head.insertBefore;

      head.insertBefore = function (newElement, referenceElement) {
        if (newElement.href && newElement.href.indexOf(\'//fonts.googleapis.com/css?family=Roboto\') != -1 || newElement.innerHTML.indexOf(\'gm-style\') != -1) {
          return;
        }
        insertBefore.call(head, newElement, referenceElement);
      };

      var $googleMapItem = $("#mod_tm_google_map_'.$module->id.' .rd-google-map");

      lazyInit($googleMapItem, $.proxy(function () {
        var $this = $(this),
          styles = $this.attr("data-styles");

        $this.googleMap({
          marker: {
            basic: $this.data(\'marker\'),
            active: $this.data(\'marker-active\')
          },
          styles: '.$params->get("map_styles").',
          onInit: function (map) {
            google.maps.event.addListener(map, \'tilesloaded\', function(evt) {
              $("#mod_tm_google_map_'.$module->id.'").addClass(\'map-loaded\');
            });
          }
        });
      }, $googleMapItem));
        
    });
        
	})(jQuery);');
?>