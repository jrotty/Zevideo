<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$active="bg-white/40 rounded-lg text-sky-500 dark:bg-white/10 ark:text-sky-400";
?>
<aside class="side select-none
md:h-full md:flex md:flex-col"

x-init="
if (window.matchMedia('(display-mode: standalone)').matches) {
app=true;
 }
">
    <div class="flex-none elative z-10 px-1 py-1.5 hidden xl:block" x-show="!app" x-cloak>
        <div class="group flex items-center">
            <span class="w-3 h-3 bg-red-500 rounded-full mx-1">
            </span>
            <span class="w-3 h-3 bg-yellow-500 rounded-full mx-1">
            </span>
            <span class="w-3 h-3 bg-green-500 rounded-full mx-1">
            </span>
        </div>
    </div>
    <div class="flex justify-around md:relative md:flex-1 md:block z-10 max-h-full overflow-y-auto dark:text-gray-200">
        <div class="hidden md:block m-3"
        ><img src="<?php echo logo; ?>" alt="LOGO" class="shadow mx-auto w-9 h-9 xl:w-12 xl:h-12 object-cover rounded-full"></div>
        
        <a :href="siteurl" @click="open='con'" :class="{'<?php echo $active; ?>':open=='con'}" class="w-full md:w-auto flex flex-col h-16 m-0 md:m-2 justify-center items-center text-center">
            <i class="flex items-center justify-center mb-0.5 mx-auto">
                <?php echo icons('home','w-5 h-5 xl:w-7 xl:h-7'); ?></i>
            <div>首页</div>
        </a>

        <a nopjax href="#&cate" @click="open='cate'" :class="{'<?php echo $active; ?>':open=='cate'}" class="w-full md:w-auto flex flex-col h-16 m-0 md:m-2 justify-center items-center text-center">
            <i class="flex items-center justify-center mb-0.5 mx-auto">
                <?php echo icons('tag','w-5 h-5 xl:w-7 xl:h-7'); ?></i>
            <div>分类</div>
        </a>

        <a nopjax href="#&searchpage" @click="open='searchpage'"  :class="{'<?php echo $active; ?>':open=='searchpage'}"
            class="w-full md:w-auto flex flex-col h-16 m-0 md:m-2 justify-center items-center text-center">
            <i class="flex items-center justify-center mb-0.5 mx-auto">
                <?php echo icons('search','w-5 h-5 xl:w-7 xl:h-7'); ?></i>
            <div>检索</div>
        </a>

        <a nopjax href="#&history" @click="open='history'" :class="{'<?php echo $active; ?>':open=='history'}" class="w-full md:w-auto flex flex-col h-16 m-0 md:m-2 justify-center items-center text-center">
            <i class="flex items-center justify-center mb-0.5 mx-auto">
                <?php echo icons('calendar','w-5 h-5 xl:w-7 xl:h-7'); ?></i>
            <div>历史</div>
        </a>

        <a nopjax href="#&page" @click="open='page'" :class="{'<?php echo $active; ?>':open=='page'}" class="w-full md:w-auto flex flex-col h-16 m-0 md:m-2 justify-center items-center text-center">
            <i class="flex items-center justify-center mb-0.5 mx-auto">
                <?php echo icons('more','w-5 h-5 xl:w-7 xl:h-7'); ?></i>
            <div>关于</div>
        </a>
        
        <template x-if="mode<2">
        <a nopjax href="#&setting" @click="open='setting'" :class="{'<?php echo $active; ?>':open=='setting'}"
            class="md:hidden w-full md:w-auto flex flex-col h-16 m-0 md:m-2 justify-center items-center text-center">
            <i class="flex items-center justify-center mb-0.5 mx-auto">
                <?php echo icons('setting','w-5 h-5 xl:w-7 xl:h-7'); ?></i>
            <div>设置</div>
        </a>
        </template>
</div>
<template x-if="mode>=2">
<div class="hidden md:block">
        <a nopjax href="#&setting" @click="open='setting'" :class="{'<?php echo $active; ?>':open=='setting'}"
            class="md:flex-shrink-0 w-full md:w-auto flex flex-col h-16 m-0 md:m-2 justify-center items-center text-center">
            <i class="flex items-center justify-center mb-0.5 mx-auto">
                <?php echo icons('setting','w-5 h-5 xl:w-7 xl:h-7'); ?></i>
            <div>设置</div>
        </a>
    </div>
</template>
</aside>