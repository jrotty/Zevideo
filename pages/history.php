<div class="h-full max-h-full overflow-y-auto">
<?php $this->need('pages/back.php'); ?>


<div class="block m-3" x-data="{his:false}"
x-init="his=cookie.getjson('xhistory')">


<template x-if="his">  
<div
            x-data="{bgcolor:['bg-orange-500','bg-green-500','bg-sky-500','bg-indigo-500','bg-purple-500','bg-fuchsia-500','bg-pink-400'],k:0,n:-1}"
            x-init="k=bgcolor.length;">
                                        <h2 class="flex items-center text-lg dark:text-white mb-3">
                                            <div class="bg-gradient-to-r from-blue-500 to-purple-500 w-4 h-2 rounded-md mr-1 duration-300">
                                            </div>观看历史
                                        </h2>

<template x-for="(item,i) in his">
            <a :href="item[1][3]" x-data="{index:i+1,bg:bgcolor[i%k]}" x-init="if(index<10){index='0'+index;}if(i>6){bg=bgcolor[6]}" itemprop="url">
            <div class="flex items-center justify-between shadow mb-3 p-3 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 rounded-lg">
            <div class="mb-0.5 flex items-center">
            <span class="font-mono text-sm px-1 text-gray-100 rounded mr-0.5" :class="bg"
                            x-text="index"></span>
            <h2 class="line-1" itemprop="name headline" x-text="item[1][2]">
            </h2>
            </div>
            <div class="text-sm">第<span class="text-red-600" x-text="item[1][1]"></span>集</div>
            </div>
            </a>
</template>
</div>
</template>  
</div>




</div>






