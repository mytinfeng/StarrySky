
<!doctype html>
<html>
<head>
<meta charset="<?php $this->options->charset(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php $this->archiveTitle(array(
        'category'  =>  _t('分类 %s 下的文章'),
        'search'    =>  _t('包含关键字 %s 的文章'),
        'tag'       =>  _t('标签 %s 下的文章'),
        'author'    =>  _t('%s 发布的文章')
    ), '', ' - '); ?><?php $this->options->title(); ?></title>
    
<link rel="shortcut icon" href="<?php $this->options->favicon() ?>" />
<link rel="bookmark"href="<?php $this->options->favicon() ?>" />

<!-- 使用url函数转换相关路径 -->
<link rel="stylesheet" href="<?php $this->options->themeUrl('style/css/bootstrap.min.css')?>">
<link href="<?php $this->options->themeUrl('style/fonts/stylesheet.css'); ?>" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="<?php $this->options->themeUrl('style/css/style.min.css?b=1.0.2')?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('style/css/viewer.min.css')?>">
<script src="https://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>

<!--[if lt IE 9]>
<script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
<script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!--代码高亮-->
<?php if ($this->is('post')): ?>
<link href="<?php $this->options->themeUrl('prismjs/prism_black.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php $this->options->themeUrl('prismjs/prism_black.js'); ?>"></script>
<?php endif; ?>
<!--表情-->
<script>themeUrl = "<?php echo $this->options->themeUrl ?>";</script>
<!--字体-->
<link rel="preload" href="//at.alicdn.com/t/font_2889477_kba4vejhzk.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="stylesheet" href="//at.alicdn.com/t/font_2889477_kba4vejhzk.css">
<!-- 通过自有函数输出HTML头部信息 -->
<?php $this->header(); ?>
</head>
<body>
<!--<div class="landscape"></div>-->
<!--<div class="filter"></div>-->
<canvas id="canvas"></canvas>

<div class="tin-protect" style="position: absolute;">
    <div class="container">
        <header>

            <!--PC端导航-->
            <div class="tin-nav-pc">
                    <div class="tin-logo">
                        <a href="/"><span><?php $this->options->logoUrl() ?>✨</span></a>
                    </div>
                    <div class="tin-son-nav">
                        <ul>
                            
                            <?php duNav() ?>
                            
                        </ul>
                    </div>
            </div>
            <!--手机端导航-->
            <div class="tin-nav-wap">
                <div class="tin-logo tin-fl-left">
                    <a href="/"><span><?php $this->options->logoUrl() ?>✨</span></a>
                </div>
                <div class="tin-son-nav tin-fl-right">
                    <div class="tin-tw">
                        <div class="container-btn">
                          <div class="stick stick-1"></div>
                          <div class="stick stick-2"></div>
                          <div class="stick stick-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tin-son-nav-wap">
                <div class="tin-logo">
                    <span><?php $this->options->logoUrl() ?>✨</span>
                </div>
                <ul>
                    
                    <?php duNav() ?>     
                    
                </ul>
            </div>
        </header>
        
        