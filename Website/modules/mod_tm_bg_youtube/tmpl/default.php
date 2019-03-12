<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('jquery.framework');
$doc = JFactory::getDocument();
$document =& $doc;
$document->addScript('modules/mod_tm_bg_youtube/assets/js/jquery.mb.YTPlayer.js');
$document->addStyleSheet('modules/mod_tm_bg_youtube/assets/css/bg-youtube.css');
?>


<div id="bg_video_<?php echo $module->id; ?>" class="bg_video mod_tm_bg_youtube mod_tm_bg_youtube__<?php echo $params->get('moduleclass_sfx');?>" data-property="{videoURL:'<?php echo $params->get('youtube_url')?>', containment:'self', autoPlay:<?php echo ($params->get('autoplay') == '1')? '1' : '0';?>, mute:<?php if($params->get('mute') == '1'):?>1<?php else:?>0<?php endif;?>, startAt:<?php echo ($params->get('start') > '0')? $params->get('start') : '0';?>, opacity:1, loop:1, stopMovieOnBlur:0, showYTLogo:1, showControls:1, addRaster:0, quality:'hd1080'}">
    <div id="bg_video__content" class="off">
        <div class="<?php echo $containerClass; ?>">
            <div class="<?php echo $rowClass; ?>">
                <?php echo $module->content; ?>
            </div>

            <?php if($params->get('play_pause')==1):?>
            <div id="bg_video__btn" data-btn-play="<?php $params->get('play_text')?>" data-btn-pause="<?php $params->get('pause_text')?>"><?php echo $params->get('play_text');?></div>
            <?php endif;?>

        </div>
    </div>

    <div id="bg_video__overlay">
        <svg width='100px' height='100px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-default"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(0 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(30 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.08333333333333333s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(60 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.16666666666666666s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(90 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.25s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(120 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.3333333333333333s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(150 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.4166666666666667s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(180 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.5s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(210 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.5833333333333334s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(240 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.6666666666666666s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(270 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.75s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(300 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.8333333333333334s' repeatCount='indefinite'/></rect><rect  x='47.5' y='40' width='5' height='20' rx='5' ry='5' fill='#ffffff' transform='rotate(330 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.9166666666666666s' repeatCount='indefinite'/></rect></svg>
    </div>
</div>    

<?php

$document->addScriptDeclaration("
    ;(function($){


        Video_".$module->id." = function() {
                if ( $('#bg_video_".$module->id."').length ) {
                    
                    if ( !$('body').hasClass('mobile') ) {
                        
                        $('#bg_video_".$module->id."').YTPlayer();
                        $('#bg_video_".$module->id.".bg_video').css('background-image','url(\"".JURI::base(true)."/".$params->get('mobile_image')."\")');
                        $.mbYTPlayer.controls = {
                            play: \"&#xf04b;\",
                            pause: \"&#xf04c;\",
                            mute: \"&#xf028;\",
                            unmute: \"&#xf026;\",
                            onlyYT: \"O\",
                            showSite: \"R\",
                            ytLogo: \"Y\"
                        };

                        $('#bg_video_".$module->id."').on(\"YTPReady\", function() {
                            
                            $('#bg_video_".$module->id." #bg_video__content').removeClass('off');
                            $('#bg_video_".$module->id." #bg_video__overlay').addClass('off');
                            $('#bg_video_".$module->id." #controlBar_bg_video_".$module->id."').addClass('off');

                            $('<span class=\"player_close ytpicon\">&#xf00d;</span>').insertBefore('#bg_video_".$module->id." .mb_YTPUrl').on('click', function() {
                                $('#bg_video_".$module->id." #bg_video__content').removeClass('off');
                                $('#bg_video_".$module->id." #controlBar_bg_video_".$module->id."').addClass('off');
                                $('#bg_video_".$module->id."').YTPPause().YTPMute();
                                $('#bg_video_".$module->id.".bg_video #bg_video__btn').html('".$params->get('play_text')."');
                                $('#bg_video_".$module->id.".bg_video .mbYTP_wrapper').css('opacity','0');
                                $('#bg_video_".$module->id.".bg_video').css('background-image','url(\"".JURI::base(true)."/".$params->get('mobile_image')."\")');
                            });

                            $('#bg_video_".$module->id." .mb_YTPUrl').on('click', function() {
                                $('#bg_video_".$module->id."').YTPPause();
                            });

                            $('#bg_video_".$module->id." #bg_video__btn').on('click', function(e) {
                                $('#bg_video_".$module->id." #bg_video__content').addClass('off content_hidden');
                                $('#bg_video_".$module->id." #controlBar_bg_video_".$module->id."').removeClass('off');
                                $('#bg_video_".$module->id."').YTPPlay().YTPUnmute();
                                e.stopPropagation();
                                $('#bg_video_".$module->id.".bg_video .mbYTP_wrapper').css('opacity','1');
                            });

                            $(document).on('click', '#bg_video_".$module->id." .content_hidden', function(e) {
                                $('#bg_video_".$module->id." #controlBar_bg_video_".$module->id."').addClass('off');
                                $('#bg_video_".$module->id." #bg_video__content').removeClass('off content_hidden');
                                $('#bg_video_".$module->id."').YTPPause().YTPMute();
                                $('#bg_video_".$module->id.".bg_video .mbYTP_wrapper').css('opacity','0');
                                $('#bg_video_".$module->id.".bg_video').css('background-image','url(\"".JURI::base(true)."/".$params->get('mobile_image')."\")');
                                e.stopPropagation();
                            });
                        });
                    }
                    else {
                        $('#bg_video_".$module->id.".bg_video').css('background-image','url(\"".JURI::base(true)."/".$params->get('mobile_image')."\")');
                        $('#bg_video_".$module->id." #bg_video__content').removeClass('off');
                        $('#bg_video_".$module->id." #bg_video__btn, #bg_video__overlay').remove();
                    };

                };
            };

            $(window).load(function() {
                Video_".$module->id."();
            });
    })(jQuery);
    ");
?>