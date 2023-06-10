<div class="link max-h-full h-full overflow-y-auto scroll-smooth pb-6 flex flex-col">
                            <div class="sticky top-0 bg-white dark:bg-gray-900 z-20">
                                <form id="searchhome" data-ajax="true" class="search relative px-3 pb-3" method="get"
                                    action="<?php $this->options->siteUrl(); ?>" role="search">
                                    <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                                    <input type="text" name="s"
                                        class="w-full bg-gray-100 dark:bg-gray-600 rounded py-2 px-1.5 text-base text" x-model="$store.ze.searchtext"
                                        placeholder="<?php _e('搜索'); ?>" required/>
                                </form>
                            </div>
                            
<div x-data="{menu:1}">
<div class="flex mb-2 border-b pb-2 dark:border-gray-500">
<button class="w-full" :class="{'text-sky-500':menu==1}" @click="menu=1" aria-label="分类">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
</svg>

</button>
<button class="w-full" :class="{'text-sky-500':menu==2}" @click="menu=2" aria-label="最近评论">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
</svg>
</button>

</div>
            

<div x-show="menu==1" class="relative pb-6 h-full" x-cloak>

<template x-if="cate">
            <template x-for="(item,i) in cate">
                <a :href="item.url" itemprop="url" 
                 x-init="setTimeout(function () {pjax.refresh();}, 50);"
                    class="mx-3 mt-3 flex justify-between items-center cursor-pointer p-3 text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-800 rounded-lg text-lg">
                    <div>
                    <h2 class="line-1" itemprop="name headline" x-text="item.name">
                    </h2>
                    <div class="text-sm line-1 text-gray-500 dark:text-gray-300" x-text="item.description"></div>
                    </div>
                    <div x-text="item.count" class="text-xl font-black text-gray-300 dark:text-gray-500"></div>
                </a>

            </template>
</template>

<div class="shadow mx-3 mt-20 rounded-lg overflow-hidden">
<?php $this->options->ad2(); ?>
</div>

</div>
   
                            
<div  x-show="menu==2" class="pb-6">

<template x-if="comments">

<template x-for="(item,i) in comments">
<a :href="item.url" class="flex px-3 py-2 text-left w-full select-none duration-300 hover:bg-gray-200 hover:dark:bg-gray-700" itemprop="url" 
                 x-init="setTimeout(function () {pjax.refresh();}, 50);"
    x-data="{k:item.k,imgurl:item.tx,}">
    <div class="flex-none" x-init="
    if(k.type=='qq'){
    fetch(k.url).then(data => data.json()).then(data => {
    imgurl=data.url;});
    }else{imgurl=k.url;}
    $nextTick(() => {setTimeout(function () {Limg(); },500);});
    ">
        <div class="relative">
        <img class="relative z-10 w-12 h-12 object-cover border-2 border-gray-200 rounded-full scrollLoading mr-1" src="<?php echo theurl; ?>img/load.gif" 
        :data-xurl="imgurl" :alt="item.author" x-cloak>
        <img class="absolute top-0 left-0 w-12 h-12 object-cover border-2 border-gray-200 rounded-full scrollLoading mr-1" :src="item.tx" :alt="item.author" x-cloak>
        </div>
    </div>
    <div class="flex-grow flex flex-col pl-2 dark:text-gray-100">
        <div class="flex justify-between"><span x-text="item.author"></span><time
                class="text-xs text-gray-400 dark:text-gray-500" x-text="item.date"></time></div>
        <div class="text-sm text-gray-600 dark:text-gray-300 line-1" x-html="item.text"></div>
    </div>
</a>
</template>

</template>

</div>











</div>  


</div>  


