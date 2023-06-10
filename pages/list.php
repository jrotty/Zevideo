<div x-data="{page:0,all:[],sticky:false,more:true,zhuangtai:'more',}" @addlist="zhuangtai='load';page++;fetch(siteurl+'?api=new&page='+page).then(data => data.json()).then(data=>{
    all=[...all, ...data.items.data];if(!sticky){sticky=data.items.sticky;}
    if(data.items.pageCount<=page){more=false;zhuangtai=false;}else{zhuangtai='more';}
    setTimeout(function () {pjax.refresh();}, 50);
    });" class="h-full max-h-full overflow-y-auto dark:text-gray-200 scroll-smooth">

<?php if($this->options->gonggao): ?>
    <div
        class="sticky shadow z-20 top-0 bg-white dark:bg-black border-b dark:border-gray-600">
        <div class="flex justify-between items-center py-2 px-3">
            <div class="line-1 mr-1"><span class="text-red-500">公告：</span><?php $this->options->gonggao() ?></div>
            <button aria-label="详情" @click="sinnertips('xs', '<h2 class=\'text-red-500 font-black my-1 text-xl\'>公告</h2><?php echo htmlspecialchars($this->options->gonggao); ?>')"><?php echo icons('ellipsis-vertical','w-6 h-6'); ?></button>
    
        </div>
    </div>
<?php endif; ?>


    <template x-if="sticky">
        <div class="relative mx-3 mb-3 mt-5 shadow text-white"
            x-data="{bgcolor:['bg-orange-500','bg-green-500','bg-sky-500','bg-indigo-500','bg-purple-500','bg-fuchsia-500','bg-pink-400'],k:0,n:-1}"
            x-init="k=bgcolor.length;">
            <span class="absolute -top-3 left-0 bg-red-500 text-white rounded-full p-1 mr-1 z-10">
                <?php icons('thumbtack','-rotate-45 h-4 w-4'); ?>
            </span>
            <div class="relative p-3 rounded-lg bg-black overflow-hidden">
            <div class="relative z-10">
            <template x-for="(ding,i) in sticky">
                <a :href="ding.url" itemprop="url"
                    class="flex justify-between items-center w-full cursor-pointer py-1"
                    :class="{'border-t border-gray-300':i!=0}" data-container="container">
                    <div class="mb-0.5 flex items-center">
                        <span class="font-mono text-sm px-1 text-gray-100 rounded mr-0.5" :class="bgcolor[i%k]"
                            x-text="i+1"></span>
                        <span itemprop="name headline" class="line-1" x-text="ding.title">
                        </span>
                    </div>
                    <div class="font-mono text-xs text-gray-200 hidden md:block" x-text="ding.date"></div>
                </a>
            </template>
        </div>
            <div class="rounded-lg absolute inset-0 bg-no-repeat opacity-60" :style="'background-image:url('+sticky['0'].img+');background-size: 20000%;background-position: center 10%;transform: scale(10);'"></div>
        </div></div>
    </template>

    <template x-for="(item,i) in all">
        <article class="relative shadow mx-3 my-5 text-white bg-black p-3 rounded-lg overflow-hidden">
            <a :href="item.url" itemprop="url" class="flex w-full cursor-pointer relative z-10"
                data-container="container">
                <div class="flex-grow flex flex-col">
                    <div class="flex-1 mb-1">
                    <h2 class="line-1 mb-1 font-black" itemprop="name headline" x-text="item.title">
                    </h2>
                    <div class="text-sm line-2 text-gray-100" x-text="item.description"></div>
                     </div>
                    <div class="font-mono text-xs text-gray-200"><span
                            x-text="item.date+' '+item.category"></span></div>
                </div>
                <div class="py-2 pl-2 flex-none">
                    <img :src="item.img" :alt="item.title" class="shadow-xl w-20 h-20 lg:w-24 lg:h-24 object-cover rounded-lg">
                </div>
            </a>
            <div class="rounded-lg absolute inset-0 bg-no-repeat opacity-60" :style="'background-image:url('+item.img+');background-size: 20000%;background-position: center 10%;transform: scale(10);'"></div>
        </article>
    </template>

    <template x-if="more">
        <div class="cursor-pointer rounded-lg mx-3 mb-3 text-center p-3 bg-blue-600 text-gray-100"
            x-init="$dispatch('addlist')" @click="$dispatch('addlist')">
            <span x-show="zhuangtai=='load'" class="inline-flex items-center">
                <?php icons('load','animate-spin -ml-1 mr-2 h-5 w-5'); ?>加载中...
            </span>
            <span x-show="zhuangtai=='more'">加载更多</span>
        </div>
    </template>
    <template x-if="!more">
        <div class="w-full text-center py-2 px-3">已经没有啦😋</div>
    </template>

</div>