<?php
/** 
 *------------------------------------------------------------------------------
 * @package       T3 Framework for Joomla!
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2004-2013 JoomlArt.com. All Rights Reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       JoomlArt, JoomlaBamboo, (contribute to this project at github 
 *                & Google group to become co-author)
 * @Google group: https://groups.google.com/forum/#!forum/t3fw
 * @Link:         http://t3-framework.org 
 *------------------------------------------------------------------------------
 */


defined('_JEXEC') or die;
include_once('includes/includes.php');
include_once('includes/functions.php');
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$client = new JApplicationWebClient();
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"
	  class='<jdoc:include type="pageclass" />'>

<head>
  <?php echo $viewport; ?>
  <jdoc:include type="head" />
  <?php $this->loadBlock('head') ?>
  <?php $this->addCss('template') ?>
  <link href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet"> </head>

<body class="<?php echo $bodyClass; ?>">
  <?php if($this->params->get("page-loader") == 1):?>
    <div class="page-loader">
        <div>
          <div class="page-loader-body">
            <div class="loader"><span class="block-1"></span><span class="block-2"></span><span class="block-3"></span><span class="block-4"></span><span class="block-5"></span><span class="block-6"></span><span class="block-7"></span><span class="block-8"></span><span class="block-9"></span><span class="block-10"></span><span class="block-11"></span><span class="block-12"></span><span class="block-13"></span><span class="block-14"></span><span class="block-15"></span><span class="block-16"></span></div>
          </div>
        </div>
    </div>
  <?php endif;?>
  <div id="color_preloader">
    <div class="loader_wrapper">
      <div class='uil-spin-css'><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div>
      <p>Loading color scheme</p>
    </div>
  </div>
<?php echo $ie_warning; ?>
<div class="flex-wrapper"> 
  <div class="t3-wrapper"> <!-- Need this wrapper for off-canvas menu. Remove if you don't use of-canvas -->

    <div id="header">
      <?php $this->loadBlock('top') ?>
      <?php $this->loadBlock('header2') ?>
    </div>

    <?php $this->loadBlock('breadcrumbs') ?>

    <?php $this->loadBlock('mainbody') ?>

    <?php $this->loadBlock('navhelper') ?>

    <div id="fixed-sidebar-left">
      <jdoc:include type="modules" name="<?php $this->_p('fixed-sidebar-left') ?>" style="sidebar" />
    </div>
    
    <div id="fixed-sidebar-right">
      <jdoc:include type="modules" name="<?php $this->_p('fixed-sidebar-right') ?>" style="sidebar" />
    </div>

  </div>
  <?php $this->loadBlock('footer') ?>
</div>

<?php 
if($this->params->get('totop') && !$client->mobile){
    $back_top = '<div id="back-top">
        <a href="#"><span></span>'.$this->params->get("totop_text").'</a>
    </div>';
}
?>
<?php echo $back_top;?>

<?php
if($this->params->get('blackandwhite')){
    $doc->addScript($jspath.'jquery.BlackAndWhite.min.js');
    $doc->addScriptdeclaration(';(function($,b){
      $.fn.BlackAndWhite_init=function(){
        var a=$(this);
        a.find("img").not(".slide-img").parent().BlackAndWhite({
          invertHoverEffect:'.$this->params->get("invertHoverEffect").',
          intensity:1,
          responsive:true,
          speed:{
            fadeIn:'.$this->params->get('fadeIn').',
            fadeOut:'.$this->params->get('fadeOut').'
          }
        })
    }
    $(window).load(function(){

      $(".item_img a").find("img").not(".lazy").parent().BlackAndWhite_init()
    });
  })(jQuery);');
}

if($this->countModules('modal')){
  $doc->addScriptdeclaration('
            ;(function($){
                $(document).ready(function(){
                    var o=$(\'a[href="#modal"]\');
                    if(o.length>0){
                        o.attr("data-toggle","modal").attr("data-target", "#modal");
                    }
                    o.click(function(e){
                        e.preventDefault();
                        $("#modal").addClass(\'in\');
                        setInterval(function(){
                          $("#modal #searchword").focus();
                        }, 0);
                    });

                    $(".modalClose").on("click", function(){
                      $(this).parent("#modal").removeClass("in");
                    });
                });
            })(jQuery);');
?>

    <div class="container">
        <div id="modal" class="modal search fade loginPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <button type="button" class="close modalClose" data-dismiss="modal">×</button>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <jdoc:include type="modules" name="<?php $this->_p('modal') ?>" style="modal" />
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
</body>
</html>