<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html x-data="data" :class="{ 'dark' : dark }" lang="zh-CN">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="renderer" content="webkit">
    <title><?php 
    if($this->request->gaojijiansuo){echo "条件检索 - ";
}else{
    $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - ');
}
        ?><?php $this->options->title(); ?></title>
<link rel="dns-prefetch" href="//cdn.staticfile.org" />
<link rel="dns-prefetch" href="//sdk.51.la" />
<meta name="theme-color" content="#fff" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#101827" media="(prefers-color-scheme: dark)">
<link rel="apple-touch-icon" href="<?php echo logo; ?>">
<link rel="manifest" href="<?php $this->options->themeUrl('app/manifest.json'); ?>"/>
<link rel="icon" href="<?php echo logo; ?>">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes"/>
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php $this->options->title(); ?>">
<meta name="format-detection" content="telephone=no,email=no"/>
<meta name="viewport" content="width=device-width,user-scalable=no,viewport-fit=cover,initial-scale=1, maximum-scale=1">
    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css?20230427'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('cssjs/mobilebone.css?202304271'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('cssjs/tailwind.min.css?20230425'); ?>">
    <script type='text/javascript'>/* <![CDATA[ */
var sitedata = {"ajax_url":"<?php $this->options->siteUrl(); ?>","url":"<?php $this->options->siteUrl(); ?>","theme_url":"<?php echo theurl; ?>","te":"<?php Helper::options()->version(); ?>","version":"<?php $info = Typecho_Plugin::parseInfo(__DIR__ . '/index.php');echo $info['version']; ?>","biaoqing":"<?php if (!empty($this->options->tools) && in_array('biaoqing', $this->options->tools)){ echo $this->options->rootUrl.'/sinnerimages/biaoqing/info.json';}?>"};
var __ = {"load_more":"\u52a0\u8f7d\u66f4\u591a","reached_the_end":"- \u6ca1\u6709\u66f4\u591a\u5185\u5bb9 -","thank_you":"\u8c22\u8c22\u70b9\u8d5e","success":"\u64cd\u4f5c\u6210\u529f","cancelled":"\u53d6\u6d88\u70b9\u8d5e","loadicon":'<?php icons('load','animate-spin -ml-1 mr-2 h-5 w-5');?>',};
/* ]]> */</script>
    <!-- 通过自有函数输出HTML头部信息 -->

<!--<script src="https://zezeshe.com/ui/js/3.2.4.js"></script>
<script>
tailwind.config = {
  darkMode: 'class',
}
</script>-->
<?php if(!$this->request->isAjax()): ?><?php endif; ?>
<?php $this->header('generator=&template=&commentReply='); ?>
<?php $this->options->header(); ?>
</head>
<body class="bg-white dark:bg-black" x-data="{siteurl:'<?php Helper::options()->siteUrl(); ?>'}">
    
<main x-data="{linkurl:false}" class="h-full">
        <div class="relative h-full flex shadow-sm">

                <div 
                    class="z-50 fixed left-0 bottom-0 w-full md:relative md:left-auto md:bottom-auto flex-none md:w-16 xl:w-20 text-xs xl:text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-black border-t dark:border-gray-800 lg:border-0 lg:border-r">
                    <!-- sidebar -->
                    <?php $this->need('sidebar.php'); ?>
                </div>

                <div class="flex flex-grow">
                    
                    <div class="flex-none w-72 hidden lg:block text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900">
                        <div class="h-6"></div>
                        <!-- link -->
                        <?php $this->need('pages/RecentComments.php'); ?>
                        <!-- link-->
                    </div>
                    
<div id="container" class="relative overflow-hidden flex-grow bg-gray-50 dark:bg-gray-800">
<button class="hidden" id="open" @click="open='con'"></button>
<button class="hidden" id="openx" @click="open='false'"></button>
<loader class="page bg-white dark:bg-black dark:text-white">
     <?php icons('load','animate-spin h-6 w-6 lg:h-12 lg:w-12'); ?>
</loader>
    <div class="the-content h-full" x-show="open=='con'" x-transition x-cloak>