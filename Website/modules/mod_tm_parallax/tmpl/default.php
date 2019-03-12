<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_tm_parallax
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$document = $doc;
$document->addScript('modules/mod_tm_parallax/js/jquery.materialize-parallax.js');

?>
<?php if ($params->get('backgroundimage')) : ?>
<div id="mod_tm_parallax_<?php echo $module->id;?>" class="parallax-container">

    <div class="mod_tm_parallax mod_tm_parallax__<?php echo $moduleclass_sfx ?>">
        <img src="<?php echo JURI::base(true) . '/' . $params->get('backgroundimage'); ?>" alt="">
    </div> 
    <div class="parallax-content">
        <div class="container">
            <div class="row">
                <?php if ($params->get('pretext')): ?>
                    <div class="pretext">
                        <?php echo $params->get('pretext') ?>
                    </div>
                <?php endif; ?>
                <?php echo $module->content; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php

$doc->AddScriptDeclaration('
    ;(function($){
        $(window).load(function(){
            userAgent = navigator.userAgent.toLowerCase();
            isIE = userAgent.indexOf("msie") != -1 ? parseInt(userAgent.split("msie")[1], 10) : userAgent.indexOf("trident") != -1 ? 11 : userAgent.indexOf("edge") != -1 ? 12 : false;

            isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);


            if (!isIE && !isMobile) {
                $("#mod_tm_parallax_'.$module->id.' .mod_tm_parallax").parallaxmat();
            } else {

                imgPath = $("#mod_tm_parallax_'.$module->id.' .mod_tm_parallax").find("img").attr("src");

                $("#mod_tm_parallax_'.$module->id.' .mod_tm_parallax").css({
                    "background-image": "url(" + imgPath + ")",
                    "background-size": "cover",
                    "background-attachment": "fixed"
                });
            }
        });
    })(jQuery);
');

?>