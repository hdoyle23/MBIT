/*! jssocials - v1.4.0 - 2016-10-10
* http://js-socials.com
* Copyright (c) 2016 Artem Tabalin; Licensed MIT */
(function(l,e,c){var j="JSSocials",f=j;var i=function(o,n){if(e.isFunction(o)){return o.apply(n,e.makeArray(arguments).slice(2));}return o;};var a=/(\.(jpeg|png|gif|bmp|svg)$|^data:image\/(jpeg|png|gif|bmp|svg\+xml);base64)/i;var d=/(&?[a-zA-Z0-9]+=)?\{([a-zA-Z0-9]+)\}/g;var b={G:1000000000,M:1000000,K:1000};var h={};function g(p,o){var n=e(p);n.data(f,this);this._$element=n;this.shares=[];this._init(o);this._render();}g.prototype={url:"",text:"",shareIn:"blank",showLabel:function(n){return(this.showCount===false)?(n>this.smallScreenWidth):(n>=this.largeScreenWidth);},showCount:function(n){return(n<=this.smallScreenWidth)?"inside":true;},smallScreenWidth:640,largeScreenWidth:1024,resizeTimeout:200,elementClass:"jssocials",sharesClass:"jssocials-shares",shareClass:"jssocials-share",shareButtonClass:"jssocials-share-button",shareLinkClass:"jssocials-share-link",shareLogoClass:"jssocials-share-logo",shareLabelClass:"jssocials-share-label",shareLinkCountClass:"jssocials-share-link-count",shareCountBoxClass:"jssocials-share-count-box",shareCountClass:"jssocials-share-count",shareZeroCountClass:"jssocials-share-no-count",_init:function(n){this._initDefaults();e.extend(this,n);this._initShares();this._attachWindowResizeCallback();},_initDefaults:function(){this.url=l.location.href;this.text=e.trim(e("meta[name=description]").attr("content")||e("title").text());},_initShares:function(){this.shares=e.map(this.shares,e.proxy(function(o){if(typeof o==="string"){o={share:o};}var n=(o.share&&h[o.share]);if(!n&&!o.renderer){throw Error("Share '"+o.share+"' is not found");}return e.extend({url:this.url,text:this.text},n,o);},this));},_attachWindowResizeCallback:function(){e(l).on("resize",e.proxy(this._windowResizeHandler,this));},_detachWindowResizeCallback:function(){e(l).off("resize",this._windowResizeHandler);},_windowResizeHandler:function(){if(e.isFunction(this.showLabel)||e.isFunction(this.showCount)){l.clearTimeout(this._resizeTimer);this._resizeTimer=setTimeout(e.proxy(this.refresh,this),this.resizeTimeout);}},_render:function(){this._clear();this._defineOptionsByScreen();this._$element.addClass(this.elementClass);this._$shares=e("<div>").addClass(this.sharesClass).appendTo(this._$element);this._renderShares();},_defineOptionsByScreen:function(){this._screenWidth=e(l).width();this._showLabel=i(this.showLabel,this,this._screenWidth);this._showCount=i(this.showCount,this,this._screenWidth);},_renderShares:function(){e.each(this.shares,e.proxy(function(n,o){this._renderShare(o);},this));},_renderShare:function(o){var n;if(e.isFunction(o.renderer)){n=e(o.renderer());}else{n=this._createShare(o);}n.addClass(this.shareClass).addClass(o.share?"jssocials-share-"+o.share:"").addClass(o.css).appendTo(this._$shares);},_createShare:function(q){var o=e("<div>");var n=this._createShareLink(q).appendTo(o);if(this._showCount){var p=(this._showCount==="inside");var r=p?n:e("<div>").addClass(this.shareCountBoxClass).appendTo(o);r.addClass(p?this.shareLinkCountClass:this.shareCountBoxClass);this._renderShareCount(q,r);}return o;},_createShareLink:function(o){var p=this._getShareStrategy(o);var n=p.call(o,{shareUrl:this._getShareUrl(o)});n.addClass(this.shareLinkClass).append(this._createShareLogo(o));if(this._showLabel){n.append(this._createShareLabel(o));}e.each(this.on||{},function(r,q){if(e.isFunction(q)){n.on(r,e.proxy(q,o));}});return n;},_getShareStrategy:function(o){var n=k[o.shareIn||this.shareIn];if(!n){throw Error("Share strategy '"+this.shareIn+"' not found");}return n;},_getShareUrl:function(n){var o=i(n.shareUrl,n);return this._formatShareUrl(o,n);},_createShareLogo:function(o){var p=o.logo;var n=a.test(p)?e("<img>").attr("src",o.logo):e("<i>").addClass(p);n.addClass(this.shareLogoClass);return n;},_createShareLabel:function(n){return e("<span>").addClass(this.shareLabelClass).text(n.label);},_renderShareCount:function(o,p){var n=e("<span>").addClass(this.shareCountClass);p.addClass(this.shareZeroCountClass).append(n);this._loadCount(o).done(e.proxy(function(q){if(q){p.removeClass(this.shareZeroCountClass);n.text(q);}},this));},_loadCount:function(p){var o=e.Deferred();var q=this._getCountUrl(p);if(!q){return o.resolve(0).promise();}var n=e.proxy(function(r){o.resolve(this._getCountValue(r,p));},this);e.getJSON(q).done(n).fail(function(){e.get(q).done(n).fail(function(){o.resolve(0);});});return o.promise();},_getCountUrl:function(n){var o=i(n.countUrl,n);return this._formatShareUrl(o,n);},_getCountValue:function(n,p){var o=(e.isFunction(p.getCount)?p.getCount(n):n)||0;return(typeof o==="string")?o:this._formatNumber(o);},_formatNumber:function(n){e.each(b,function(o,p){if(n>=p){n=parseFloat((n/p).toFixed(2))+o;return false;}});return n;},_formatShareUrl:function(n,o){return n.replace(d,function(p,q,s){var r=o[s]||"";return r?(q||"")+l.encodeURIComponent(r):"";});},_clear:function(){l.clearTimeout(this._resizeTimer);this._$element.empty();},_passOptionToShares:function(o,p){var n=this.shares;e.each(["url","text"],function(q,r){if(r!==o){return;}e.each(n,function(s,t){t[o]=p;});});},_normalizeShare:function(n){if(e.isNumeric(n)){return this.shares[n];}if(typeof n==="string"){return e.grep(this.shares,function(o){return o.share===n;})[0];}return n;},refresh:function(){this._render();},destroy:function(){this._clear();this._detachWindowResizeCallback();this._$element.removeClass(this.elementClass).removeData(f);},option:function(n,o){if(arguments.length===1){return this[n];}this[n]=o;this._passOptionToShares(n,o);this.refresh();},shareOption:function(o,n,p){o=this._normalizeShare(o);if(arguments.length===2){return o[n];}o[n]=p;this.refresh();}};e.fn.jsSocials=function(q){var p=e.makeArray(arguments),o=p.slice(1),n=this;this.each(function(){var s=e(this),r=s.data(f),t;if(r){if(typeof q==="string"){t=r[q].apply(r,o);if(t!==c&&t!==r){n=t;return false;}}else{r._detachWindowResizeCallback();r._init(q);r._render();}}else{new g(s,q);}});return n;};var m=function(o){var n;if(e.isPlainObject(o)){n=g.prototype;}else{n=h[o];o=arguments[1]||{};}e.extend(n,o);};var k={popup:function(n){return e("<a>").attr("href","#").on("click",function(){l.open(n.shareUrl,null,"width=600, height=400, location=0, menubar=0, resizeable=0, scrollbars=0, status=0, titlebar=0, toolbar=0");return false;});},blank:function(n){return e("<a>").attr({target:"_blank",href:n.shareUrl});},self:function(n){return e("<a>").attr({target:"_self",href:n.shareUrl});}};l.jsSocials={Socials:g,shares:h,shareStrategies:k,setDefaults:m};}(window,jQuery));(function(b,c,a,d){c.extend(a.shares,{email:{label:"E-mail",logo:"fa fa-at",shareUrl:"mailto:{to}?subject={text}&body={url}",countUrl:"",shareIn:"self"},twitter:{label:"Tweet",logo:"fa fa-twitter",shareUrl:"https://twitter.com/share?url={url}&text={text}&via={via}&hashtags={hashtags}",countUrl:""},facebook:{label:"Like",logo:"fa fa-facebook",shareUrl:"https://facebook.com/sharer/sharer.php?u={url}",countUrl:"https://graph.facebook.com/?id={url}",getCount:function(e){return e.share&&e.share.share_count||0;}},vkontakte:{label:"Like",logo:"fa fa-vk",shareUrl:"https://vk.com/share.php?url={url}&title={title}&description={text}",countUrl:"https://vk.com/share.php?act=count&index=1&url={url}",getCount:function(e){return parseInt(e.slice(15,-2).split(", ")[1]);}},googleplus:{label:"+1",logo:"fa fa-google",shareUrl:"https://plus.google.com/share?url={url}",countUrl:""},linkedin:{label:"Share",logo:"fa fa-linkedin",shareUrl:"https://www.linkedin.com/shareArticle?mini=true&url={url}",countUrl:"https://www.linkedin.com/countserv/count/share?format=jsonp&url={url}&callback=?",getCount:function(e){return e.count;}},pinterest:{label:"Pin it",logo:"fa fa-pinterest",shareUrl:"https://pinterest.com/pin/create/bookmarklet/?media={media}&url={url}&description={text}",countUrl:"https://api.pinterest.com/v1/urls/count.json?&url={url}&callback=?",getCount:function(e){return e.count;}},stumbleupon:{label:"Share",logo:"fa fa-stumbleupon",shareUrl:"http://www.stumbleupon.com/submit?url={url}&title={title}",countUrl:"https://cors-anywhere.herokuapp.com/https://www.stumbleupon.com/services/1.01/badge.getinfo?url={url}",getCount:function(e){return e.result.views;}},telegram:{label:"Telegram",logo:"fa fa-paper-plane",shareUrl:"tg://msg?text={url} {text}",countUrl:"",shareIn:"self"},whatsapp:{label:"WhatsApp",logo:"fa fa-whatsapp",shareUrl:"whatsapp://send?text={url} {text}",countUrl:"",shareIn:"self"},line:{label:"LINE",logo:"fa fa-comment",shareUrl:"http://line.me/R/msg/text/?{text} {url}",countUrl:""},viber:{label:"Viber",logo:"fa fa-volume-control-phone",shareUrl:"viber://forward?text={url} {text}",countUrl:"",shareIn:"self"},pocket:{label:"Pocket",logo:"fa fa-get-pocket",shareUrl:"https://getpocket.com/save?url={url}&title={title}",countUrl:""},messenger:{label:"Share",logo:"fa fa-commenting",shareUrl:"fb-messenger://share?link={url}",countUrl:"",shareIn:"self"}});}(window,jQuery,window.jsSocials));