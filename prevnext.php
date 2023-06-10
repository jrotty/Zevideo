<div class="mx-3 my-5 text-gray-900 dark:text-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-4">
  
<?php 
$prev=thePrev($this);//调用函数并将函数值给变量
$next=theNext($this);//调用函数并将函数值给变量
if($this->fields->tcid){$this->widget('Widget_Archive@tcid', 'pageSize=1&type=post', 'cid='.$this->fields->tcid)->to($prev);}
if($this->fields->bcid){$this->widget('Widget_Archive@bcid', 'pageSize=1&type=post', 'cid='.$this->fields->bcid)->to($next);}
 ?>
 <?php if($prev->created<$this->created): ?>
<a href="<?php $prev->permalink(); ?>" class="relative cursor-pointer p-3 lg:p-4 duration-300 bg-black text-white rounded-lg hover:-translate-y-1 overflow-hidden shadow">
<div class="relative z-10 flex justify-between items-center ">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
</svg>
<div class="flex-1 text-right">
<div class="font-semibold mb-1">上一篇</div>
<div class="text-sm line-1"><?php $prev->title(); ?></div>
</div></div>

<div class="rounded-lg absolute inset-0 bg-cover bg-no-repeat opacity-60" style="background-image:url(<?php showThumbnail($prev,'0','1') ?>);background-size: 20000%;background-position: center 10%;transform: scale(10);"></div>
</a>
<?php endif; ?>
<!--
讲解一下，$prev=thePrev($this);调用后，$prev->permalink就是上一篇文章的链接，$prev->title就是标题，showThumbnail($prev)就是缩略图，就跟正常调用文章的语法一致，只是$this换成了$prev。
-->
<!--判断下一篇文章是否存在-->
<?php if($next->created>$this->created): ?>
<a href="<?php $next->permalink(); ?>" class="relative cursor-pointer p-3 lg:p-4 duration-300 bg-black text-white rounded-lg hover:-translate-y-1 overflow-hidden shadow">
<div class="relative z-10 flex justify-between items-center ">
<div class="flex-1">
<div class="font-semibold mb-1">下一篇</div>
<div class="text-sm line-1"><?php $next->title(); ?></div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
</svg>
</div>

<div class="rounded-lg absolute inset-0 bg-cover bg-no-repeat opacity-60" style="background-image:url(<?php showThumbnail($next,'0','1') ?>);background-size: 20000%;background-position: center 10%;transform: scale(10);"></div>
</a>
<?php endif; ?>


</div>