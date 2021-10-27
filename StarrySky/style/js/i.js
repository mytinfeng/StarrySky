


/**
 * 鍥剧墖鏀惧ぇ闀�
 * Author : Postbird
 * Website: http://www.ptbird.cn
 * License: MIT
 * http://www.jq22.com/jquery-info15705
 */

/*
 * Lazy Load - jQuery plugin for lazy loading images
 * Copyright (c) 2007-2013 Mika Tuupola
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 * Project home:
 *   http://www.appelsiini.net/projects/lazyload
 * Version:  1.9.3
 */



var PostbirdImgGlass = {
    init: function (objParam) {
        this.domSelector = objParam.domSelector || "img";
        this.width = objParam.width || "auto";
        this.height = objParam.height || "auto";
        this.boxClassName = objParam.boxClassName || 'postbird-img-glass-box';
        this.boxBgColor = objParam.bgColor || 'rgba(0,0,0,0.8)';
        this.animation = objParam.animation || false;
        this.startGlass();
        this.box = this.initImageClassContainer();
    },
    initImageClassContainer: function () {
        var _this = this,
            img = document.createElement('img');
        img.style.width = _this.width;
        img.style.height = _this.height;
        var box = document.createElement("div");
        box.style = _this.boxStyle;
        box.className = _this.boxClassName;
        box.appendChild(img);
        box.onclick = function () {
            _this.hideImageGlass();
        };
        document.body.insertBefore(box, document.body.childNodes[0]);
        this.initCssClass();
        return box;
    },
    startGlass: function () {
        var domList = document.querySelectorAll(this.domSelector);
        var _this = this;
        for (var i = 0, len = domList.length; i < len; i++) {
            domList[i].style.cursor = 'zoom-in';
            domList[i].addEventListener('click', function (event) {
                var target = event.target || event.srcElement;
                _this.showImageGlass(target.getAttribute('src'));
            }, false);
        }
    },
   
  
    initCssClass: function () {
        var style = document.createElement('style');
        var styleContent = '.' + this.boxClassName + '{position:fixed;top:0;left:0;width:100%;height:100%;text-align:center;cursor:zoom-out;background-color:' + this.boxBgColor + ';display:none;text-align:center;overflow:hidden;z-index:9999;}';
        styleContent += '.' + this.boxClassName + ' img {position:relative;top:50%;transform:translateY(-50%);max-width:90%;}';
        styleContent += '.postbird-img-glass-box-move{animation:postbird-img-glass .5s;-webkit-animation:postbird-img-glass .5s;-moz-animation:postbird-img-glass .5s;-o-animation:postbird-img-glass .5s;animation-fill-mode:forwards;-o-animation-fill-mode:forwards;-moz-animation-fill-mode:forwards;-webkit-animation-fill-mode:forwards}@-moz-keyframes postbird-img-glass{from{opacity:0;width:100%;height:100%;transform:translateY(-200px)}to{opacity:1;width:100%;height:100%;transform:translateY(0)}}@-webkit-keyframes postbird-img-glass{from{opacity:0;width:100%;height:100%;transform:translateY(-200px)}to{opacity:1;width:100%;height:100%;transform:translateY(0)}}@-o-keyframes postbird-img-glass{from{opacity:0;width:100%;height:100%;transform:translateY(-200px)}to{opacity:1;width:100%;height:100%;transform:translateY(0)}}@keyframes postbird-img-glass{from{opacity:0;width:100%;height:100%;transform:translateY(-200px)}to{opacity:1;width:100%;height:100%;transform:translateY(0)}}';
        style.innerHTML = styleContent;
        document.head.appendChild(style);
    }
};




//if jq error: auto load a new one
try{jQuery()}catch(e){
    let s = document.createElement('script');
    s.src='//libs.baidu.com/jquery/1.8.3/jquery.min.js';
    s.charset='UTF-8';
    document.body.append(s);
}

if ($(window).width() > 800 && $(".atcs").height() < $(".sb-left").height()) {
    $(".atcs").css("min-height", $(".sb-left").height());
}

if ($(window).width() < 500){
    $('#comments').parent('.post').css('padding', 0);
}

PostbirdImgGlass.init({
    domSelector:".post-content img:not([unzoomable])",
    animation:true
});




facenamereplace = ["：滑稽：","：喷：","：喜欢：","：阴险：","：怒：","：笑眼：",
"：黑线：","：鼓掌：","：乖：","：汗：","：惊哭：","：酷：","：狂汗：","：问号：",
"：真棒：","：不高兴：","：大哭：","：思考："];
/*
facereplace = [];
for (var i = 0; i < facenamereplace.length; i++) {
	facereplace[i] = theme_path+"/s/img/"+facenamereplace[i].replace(/：/g,"")+".png";
}
*/
facereplace = [];
for (var i=0; i<facenamereplace.length;i++){
    facereplace[i] = themeUrl+"/s/img/face_"+i+".png";
}
try{
	if (showfacenamereplace) {
		for (var i = 0; i < facenamereplace.length; i++) {
			showfacenamereplace.innerHTML += facenamereplace[i];
		}
	}
}catch(e){}
var bodyhtml = $("#comments").html();
if (bodyhtml){
    for (var i = 0; i < facereplace.length; i++) {
	    bodyhtml = bodyhtml.replace(new RegExp(facenamereplace[i],"ig"),"<img class='tbbq' draggable='false' title='"+facenamereplace[i]+"' num='"+i+"' src='"+facereplace[i]+"' />");
    }
    $("#comments").html(bodyhtml);
    $("form .tbbq").click(function(){
	    insertText($("textarea[name=text]")[0], facenamereplace[$(this).attr("num")]);
    });
}
bodyhtml = $("#rctrly").html();
if (bodyhtml){
    for (var i = 0; i < facereplace.length; i++) {
	    bodyhtml = bodyhtml.replace(new RegExp(facenamereplace[i],"ig"),"<img class='tbbq tiny' draggable='false' alt='😀' src='"+facereplace[i]+"' />");
    }
    $("#rctrly").html(bodyhtml);
}


$(".backtotop").click(function () {
        var speed = 200;
        $('body,html').animate({ scrollTop: 0 }, speed);
        return false;
});

function insertText(obj,str){
	var m = obj.value.match(/：.*?：/g);
	if (m) {
		if (m.length > 9) {
			alert("最多添加10个表情！");
			return false;
		}
	}
	obj.value += str;
}



$("pre code").each(function(){
    this.innerHTML = this.innerHTML.replace(/((["'])(?:\\.|[^\\\n])*?\2)/ig,"<span class='hl-str'>$1</span>").replace(/(\\[\s\S])/ig,"<span class='hl-warn'>$1</span>").replace(/(\/\*[\s\S]+\*\/)/g,"<span class='hl-note'>$1</span>").replace(/(~\/| -{1,2}[a-z&;]{1,}[ :\n\r]|!|\^|\+|\*|%|\||&amp;|===|==|-&gt;|=&gt;|=&lt;|&lt;=|&gt;=|&gt;|&lt;)/ig,"<span class='hl-fh'>$1</span>").replace(/([^a-z0-9]|^)([\d\.]+)([^a-z0-9]|$)/ig,"$1<span class='hl-num'>$2</span>$3").replace(/([^a-z0-9]|^)([\d\.]+)([^a-z0-9]|$)/ig,"$1<span class='hl-num'>$2</span>$3").replace(/\b(RegExp|return|if|fi|then|else|break|continue|for|endif|in|not|die|exit|switch|case|throw|void|typeof|endwhile|elseif|import|array|while|foreach|important|new|and|or|xor|with|desc|limit|order|try|as|catch)\b/ig, "<span class='hl-kw'>$1</span>").replace(/((?=^|\n|\r| )\s*(\/\/|#).*(?=\r|\n|$))/g,"<span class='hl-note'>$1</span>").replace(/\b(echo|print|substr|replace|query|include|default|final|eval|exec|shell|list|function|static|const|var|let|unset|unlink|undefined|null|true|bind|false|empty|del|is|def|this|clear|screen|max|min|rgba|rgb|box|inherit|left|right|top|bottom|wrap|wget|ls|chmod|grep|cat|test|match|yum|apt|mv|cp|rm|sudo|sh|source|bash|find|more|touch|awk|curl|tee|tree|read|vim|diff|unzip|public|static|tar|ftp|cd|mount|stat|rmdir|git|dd|df|du|restart|stop|start|sfdisk|fdisk|kill|top|free|who|clear|reset|alias|gzip|rpm|pacman|dump|bzip2|dpkg|count|goto|document|window|Date|Math|install|remove|floor|make|isNaN|NaN)\b/ig,"<span class='hl-kf'>$1</span>").replace(/\b((?![0-9])[\w0-9]+(?=\())/ig,"<span class='hl-kf'>$1</span>").replace(/(\$(?![0-9])[\w0-9]+\b)/ig, "<span class='hl-var'>$1</span>");
});

if ($(".post-meta")){
	$(".post-meta").css("width",$(".atcs").width()-15);
}

$('.post-thumb img').each(function(){
    this.onerror = function(){
        $(this).attr("src", themeUrl+"/s/img/error.jpg");
    }
})
window.onload = function(){
    $("#pagecover").fadeOut()
}