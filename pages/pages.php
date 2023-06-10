<div class="h-full max-h-full overflow-y-auto">
<?php $this->need('pages/back.php'); ?>
<template x-if="page">
<template x-for="(item,i) in page">
            <a :href="item.url" itemprop="url">
            <h2  class="shadow m-3 p-3 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 rounded-lg line-1" itemprop="name headline" x-text="item.title">
            </h2>
            </a>
</template>
</template>

<template x-if="!page">
<div  class="w-full text-gray-900 text-center p-3 bg-white dark:bg-gray-900 dark:text-gray-100">
<span class="inline-flex items-center">
<?php icons('load','animate-spin -ml-1 mr-2 h-5 w-5'); ?>加载中...
</span>
</div>
</template>




</div>






