<div class="max-h-full overflow-y-auto">
<?php $this->need('pages/back.php'); ?>
    <template x-if="cate">
        <div class="grid grid-cols-2 gap-4 m-3">
            <template x-for="(item,i) in cate">
                <a :href="item.url" itemprop="url" 
                 x-init="setTimeout(function () {pjax.refresh();}, 50);"
                    class="flex justify-between items-center cursor-pointer shadow w-full p-3 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 rounded-lg text-lg">
                    <div>
                    <h2 class="line-1" itemprop="name headline" x-text="item.name">
                    </h2>
                    <div class="text-sm line-1 text-gray-500 dark:text-gray-300" x-text="item.description"></div>
                    </div>
                    <div x-text="item.count" class="text-xl font-black text-gray-300 dark:text-gray-500"></div>
                </a>

            </template>
        </div>
    </template>

    <template x-if="!cate">
        <div class="w-full text-gray-900 text-center p-3 dark:bg-gray-900 dark:text-gray-100">
            <span class="inline-flex items-center">
                <?php icons('load','animate-spin -ml-1 mr-2 h-5 w-5'); ?>加载中...
            </span>
        </div>
    </template>
    
    
    <div class="block px-3">
    <template x-if="tag">
        
<div class="flex flex-col bg-white dark:bg-gray-900 shadow rounded-md p-4 mb-5 dark:text-white">
                                        <h2 class="flex items-center mb-3">
                                            <div class="bg-gradient-to-r from-blue-500 to-purple-500 w-4 h-2 rounded-md mr-1 duration-300">
                                            </div>标签
                                        </h2>
        <div class="-mx-2 text-sm">
            <template x-for="(item,i) in tag">
                <a :href="item.url" itemprop="url"
                 x-init="setTimeout(function () {pjax.refresh();}, 50);"
                    class="inline-block shadow m-2 px-2 py-1 text-gray-900 dark:text-gray-100 bg-white dark:bg-black rounded-lg" x-text="'#'+item.name">
                </a>

            </template>
        </div>
                                                                                
                                    </div>
        
        
        

    </template>

    <template x-if="!tag">
        <div class="w-full text-gray-900 text-center p-3 dark:bg-gray-900 dark:text-gray-100">
            <span class="inline-flex items-center">
                <?php icons('load','animate-spin -ml-1 mr-2 h-5 w-5'); ?>加载中...
            </span>
        </div>
    </template>
</div>
</div>