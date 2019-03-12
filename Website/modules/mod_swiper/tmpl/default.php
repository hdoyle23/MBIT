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

$app 	  = JFactory::getApplication();	
$template = $app->getTemplate();


$effects = $params->get('items_params');

$j = 0;
$isVideo = 0;
$isParallax = 0;
if($effects != NULL){
	foreach($effects as $item){
		$item_effects[$j] = $item;
		if($item_effects[$j]->slide_effect==0){
			$isVideo = 1;
		}
		if($item_effects[$j]->slide_effect==1){
			$isParallax = 1;
		}
		$j++;
	}
}



if($isVideo == 1){
	$document->addScript('modules/mod_swiper/js/jquery.vide.min.js');
}
if($isParallax == 1){
	$document->addScript('modules/mod_swiper/js/jquery.rd-parallax.min.js');
	$document->addStyleSheet('modules/mod_swiper/css/rd-parallax.css');
}
?>

<div id="swiper-slider_<?php echo $module->id; ?>" class="swiper-container swiper-slider swiper-slider__<?php echo $moduleclass_sfx; ?>"
	data-min-height="<?php echo $params->get('minHeight');?>"
	data-height="<?php echo $params->get('height');?>"
	data-autoplay="<?php if($params->get('autoplay')==0):?>false<?php else:?><?php echo $params->get('autoplay_speed')?><?php endif;?>"
	data-loop="true"
	data-slide-effect="<?php echo $params->get('slide_animation');
	?>"
	
	>
	<div class="swiper-wrapper">
		<?php
			// Item URL
			if($params->get('item_url')){
				$itemURLs = explode(';', $params->get('item_url'));
			}	

			// Item width
			$item_width = floor(100 / count($list));


			$i=0;	
			foreach ($list as $item) :		

				require JModuleHelper::getLayoutPath('mod_swiper', '_item');

				$i++;
			endforeach;
		?>
	</div>
	<?php if($params->get('pagination')==1):?>
		<!-- Swiper Pagination -->
	    <div class="swiper-pagination"
	    data-clickable="<?php if($params->get("pagination_clickable")==0):?>false<?php endif;?>"
	    data-index-bullet="<?php if($params->get("pagination_bullet")==0):?>false<?php else:?>true<?php endif;?>"
	    ></div>
	<?php endif?>
	<?php if($params->get('navigation')==1):?>
	    <!-- Swiper Navigation -->
	    <div class="swiper-button-prev"></div>
	    <div class="swiper-button-next"></div>
	<?php endif;?>
</div>
<?php if($params->get('show_thumbs')==1):?>
<div id="slider-thumbs_<?php echo $module->id; ?>" class="swiper-container swiper-slider slider-thumbs"
	data-height="<?php echo $params->get('thumb_height');?>"
	>
	<div class="swiper-wrapper">
	    <?php
	    	$j=0;	
			foreach ($list as $item) :
				require JModuleHelper::getLayoutPath('mod_swiper', '_thumbs');
				$j++;
			endforeach;
	    ?>
	</div>
</div>
<?php endif;?>
<?php
$js = '
	;(function ($, undefined) {
			$(window).load(function(){
				function isIE() {
				    var myNav = navigator.userAgent.toLowerCase();
				    return (myNav.indexOf(\'msie\') != -1) ? parseInt(myNav.split(\'msie\')[1]) : false;
				};
				var o = $("#swiper-slider_'.$module->id.'");';
if($params->get('show_thumbs')==1):
			$js.='
				var	gal = $("#slider-thumbs_'.$module->id.'");
			';
endif;
$js.='				
			    if (o.length) {
			        function getSwiperHeight(object, attr) {
			            var val = object.attr("data-" + attr), dim;
			            if (!val) {
			                return undefined;
			            }
			            dim = val.match(/(px)|(%)|(vh)$/i);
			            if (dim.length) {
			                switch (dim[0]) {
			                    case"px":
			                        return parseFloat(val);
			                    case"vh":
			                        return $(window).height() * (parseFloat(val) / 100);
			                    case"%":
			                        return object.width() * (parseFloat(val) / 100);
			                }
			            } else {
			                return undefined;
			            }
			        }

			        function toggleSwiperInnerVideos(swiper) {
			            var videos;
			            $.grep(swiper.slides, function (element, index) {
			                var $slide = $(element), video;
			                if (index === swiper.activeIndex) {
			                    videos = $slide.find("video");
			                    if (videos.length) {
			                        videos.get(0).play();
			                    }
			                } else {
			                    $slide.find("video").each(function () {
			                        this.pause();
			                    });
			                }
			            });
			        }

			        function toggleSwiperCaptionAnimation(swiper) {
			            if (isIE() && isIE() < 10) {
			                return;
			            }
			            var prevSlide = $(swiper.container), nextSlide = $(swiper.slides[swiper.activeIndex]);
			            prevSlide.find("[data-caption-animate]").each(function () {
			                var $this = $(this);
			                $this.removeClass("animated").removeClass($this.attr("data-caption-animate")).addClass("not-animated");
			            });
			            nextSlide.find("[data-caption-animate]").each(function () {
			                var $this = $(this), delay = $this.attr("data-caption-delay");
			                setTimeout(function () {
			                    $this.removeClass("not-animated").addClass($this.attr("data-caption-animate")).addClass("animated");
			                }, delay ? parseInt(delay) : 0);
			            });
			        }

			        $(document).ready(function () {
			            o.each(function () {
			                var s = $(this);
			                var pag = s.find(".swiper-pagination"), next = s.find(".swiper-button-next"), prev = s.find(".swiper-button-prev"), bar = s.find(".swiper-scrollbar"), h = getSwiperHeight(o, "height"), mh = getSwiperHeight(o, "min-height");
			                s.find(".swiper-slide").each(function () {
			                    var $this = $(this), url;
			                    if (url = $this.attr("data-slide-bg")) {
			                        $this.css({"background-image": "url(" + url + ")", "background-size": "cover"})
			                    }
			                }).end().find("[data-caption-animate]").addClass("not-animated").end();

								var slider = new Swiper(s,{
			                    autoplay: s.attr(\'data-autoplay\') ? s.attr(\'data-autoplay\') === "false" ? undefined : s.attr(\'data-autoplay\') : 5000,
			                    direction: s.attr(\'data-direction\') ? s.attr(\'data-direction\') : "horizontal",
			                    effect: s.attr(\'data-slide-effect\') ? s.attr(\'data-slide-effect\') : "slide",
			                    speed: s.attr(\'data-slide-speed\') ? s.attr(\'data-slide-speed\') : 600,
			                    keyboardControl: s.attr(\'data-keyboard\') === "true",
			                    mousewheelControl: s.attr(\'data-mousewheel\') === "true",
			                    mousewheelReleaseOnEdges: s.attr(\'data-mousewheel-release\') === "true",
			                    nextButton: next.length ? next.get(0) : null,
			                    prevButton: prev.length ? prev.get(0) : null,
			                    pagination: pag.length ? pag.get(0) : null,
			                    paginationClickable: pag.length ? pag.attr("data-clickable") !== "false" : false,
			                    paginationBulletRender: pag.length ? pag.attr("data-index-bullet") === "true" ? function (index, className) {
			                        return \'<span class="\' + className + \'">\' + (index + 1) + \'</span>\';
			                    } : null : null,
			                    scrollbar: bar.length ? bar.get(0) : null,
			                    scrollbarDraggable: bar.length ? bar.attr("data-draggable") !== "false" : true,
			                    scrollbarHide: bar.length ? bar.attr("data-draggable") === "false" : false,
			                    loop: s.attr(\'data-loop\') !== "false",
			                    loopedSlides: '.$i.',
			                    autoplayDisableOnInteraction: false,
			                    onTransitionStart: function (swiper) {
			                        toggleSwiperInnerVideos(swiper);
			                    },
			                    onTransitionEnd: function (swiper) {
			                        toggleSwiperCaptionAnimation(swiper);
			                    },
			                    onInit: function (swiper) {
			                        toggleSwiperInnerVideos(swiper);
			                        toggleSwiperCaptionAnimation(swiper);
			                        var o = $(swiper.container).find(\'.rd-parallax\');
			                        var p = $(swiper.container).find(\'.slider-parallax-swiper\');
			                        if(p.length){
			                        	RDParallax_autoinit(\'.slider-parallax-swiper\');
			                        }
			                    }
			                });
			                $(window).on("resize", function () {
			                    var mh = getSwiperHeight(s, "min-height"),
			                    	h = getSwiperHeight(s, "height");
			                    if (h) {
			                        s.css("height", mh ? mh > h ? mh : h : h);
			                    }';
if($params->get('show_thumbs')==1):
$js.='
			                    var galh = getSwiperHeight(gal, "height");
			                    if (galh) {
			                        gal.css("height", galh);
			                    }
	';
endif;	
$js.='			                }).load(function () {
			                    s.find("video").each(function () {
			                        if (!$(this).parents(".swiper-slide-active").length) {
			                            this.pause();		                        }
			                    });
			                }).trigger("resize");';
if($params->get('show_thumbs')==1):
	$items = 0;
	$breakpoint1 = 0;
	$breakpoint2 = 0;
	if($i<=5){
		$items = $i;
	} else {
		$items = 5;
	}
	if($i>=1){
		$breakpoint1 = $i;
		$breakpoint2 = $i;
	}

	if($i>=5){
		$breakpoint1 = 3;
		$breakpoint2 = 2;
	}

	$looped = $i;
$js.='
							var galleryThumbs = new Swiper(gal, {
						        spaceBetween: '.$params->get("thumb_space").',
						        slidesPerView: '.$items.',
						        slideToClickedSlide: true,
						        loop: true,
        						loopedSlides: '.$i.',
        						autoplayDisableOnInteraction: true,/*
        						onSliderMove(swiper, event) {
			                        slider.stopAutoplay();
			                    },
			                    onTouchEnd(swiper, event) {
			                    	slider.startAutoplay();
			                    },*/
        						breakpoints:{
								    // when window width is <= 480px
								    480:{
								      slidesPerView: '.$breakpoint2.',
								      spaceBetween: '.$params->get("thumb_space_480").'
								    },
								    // when window width is <= 640px
								    768:{
								      slidesPerView: '.$breakpoint1.',
								      spaceBetween: '.$params->get("thumb_space_768").'
								    }
								}
						    });
	
							slider.params.control = galleryThumbs;
    						galleryThumbs.params.control = slider;
';
endif;
$js.='
			            });
			        });
			    }
			});
	})(jQuery);
'; 
$document->addScriptdeclaration($js); ?>