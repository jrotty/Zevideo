<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>


<div class="max-h-full overflow-y-auto break-all text-gray-900 dark:text-gray-100 scroll-smooth">

<?php
$can="";
if($this->request->get('gaojijiansuo')){
    include('gjsearch.php');
}else{
?>

    <div
        class="sticky shadow z-20 top-0 bg-white dark:bg-black border-b dark:border-gray-600">
        <div class="flex items-center p-2">
            <div class="flex-grow pl-1">
                <div class="font-black"><?php $this->archiveTitle([
            'category' => _t('%s'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('%s'),
            'author'   => _t('%s 发布的文章')
        ], '', ''); ?></div>
        <div class="justify-between text-gray-500 dark:text-gray-200 text-xs flex">
            <div>共有 <?php echo $this->getTotal(); ?> 条内容</div>
            
            <div><?php if($this->currentPage>1) echo $this->currentPage;  else echo 1;?>/<?php echo $this->getTotalPage(); ?></div>
            </div>

            </div>


        </div>
    </div>
<?php } ?>


<?php if(1==2): ?>
    <?php if ($this->have()): ?>
    <?php while ($this->next()): ?>
    <?php $img=showThumbnail($this,'1','1') ?>
        <article class="relative shadow mx-3 my-5 text-white bg-black p-3 rounded-lg overflow-hidden">
        <a href="<?php $this->permalink() ?>" itemprop="url" class="flex w-full cursor-pointer relative z-10" data-container="container">
            <div class="flex-grow flex flex-col">

            <div class="flex-1 mb-1">
                <h2 class="line-1 mb-1 font-black" itemprop="name headline"><?php $this->title() ?>
                </h2>
                <div class="text-sm line-2 text-gray-100"><?php excerpt($this,'150','...','echo'); ?>
                </div>
            </div>
                <div class="font-mono text-xs text-gray-200 mb-0.5"><?php $this->date('Y年m月d日') ?> <?php $this->category(',',false); ?></div>
               
            </div>
            <div class="p-2 flex-none">
                <img src="<?php echo $img; ?>"
                    class="shadow w-20 h-20 lg:w-24 lg:h-24 object-cover rounded-lg">
            </div>
        </a>
            <div class="rounded-lg absolute inset-0 bg-cover bg-no-repeat opacity-60" style="background-image:url(<?php echo $img; ?>);background-size: 20000%;background-position: center 10%;transform: scale(10);"></div>
    </article>
    <?php endwhile; ?>
    <?php else: ?>
    <div class="py-24">
        <div class="svg-404 mx-auto mb-3"></div>
        <p class="text-muted text-center text-gray-900 dark:text-gray-200">看起来这里没有任何东西…</p>
    </div>
    <?php endif; ?>
 <?php endif; ?>


<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 2xl:gap-8 pb-8 border-b border-gray-200 dark:border-gray-800 p-3">

    <?php if ($this->have()): ?>
    <?php while ($this->next()): ?>

   <a href="<?php $this->permalink() ?>" class="cursor-pointer transition-all duration-300 transform hover:-translate-y-1">
        <div class="shadow-md media media-16x9">
        <img class="media-content rounded w-full h-full object-cover" data-xurl="<?php showThumbnail($this); ?>">
        <div class="absolute bottom-2 text-xs bg-red-500 text-white px-1 py-0.5 rounded-r-md"><?php gengxin($this); ?></div>
    </div>
    <div class="text-gray-700 text-sm mt-1 sm:px-2 dark:text-white">
        <p class="text-center line-1"><?php $this->title(); ?></p>
 </div>       
</a>

    <?php endwhile; ?>
    <?php endif; ?>
</div>


    <div class="flex items-center justify-between mx-3 my-5">

        <?php 
$pattern = '/\<a.*?\shref\=\"(.*?)\"[^>]*>/i';
ob_start();
$this->pageLink('下一页','next');
$nextlink = ob_get_clean();
$t=preg_match_all($pattern, $nextlink, $nextlink);
if($t){
$nextlink='" href="'.$nextlink[1][0].$can.'"';
}else{
$nextlink=' opacity-0" disabled="disabled"';
}
?>
        <?php 
ob_start();
$this->pageLink('上一页');
$prevlink = ob_get_clean();
$t=preg_match_all($pattern, $prevlink, $prevlink);
if($t){
$prevlink='" href="'.$prevlink[1][0].$can.'"';
}else{
$prevlink=' opacity-0" disabled="disabled"';
}

?>

        <a
            class="flex items-center text-xs px-4 py-2 mx-1 text-gray-700 bg-white dark:bg-black dark:text-gray-100 shadow-md sm:shadow-lg rounded-md<?php echo $prevlink; ?> data-container="container">
            <?php icons('chevron-right','stroke-2 w-4 h-4 rotate-180'); ?>上一页
        </a>
        <a
            class="flex items-center text-xs px-4 py-2 mx-1 text-gray-700 bg-white dark:bg-black dark:text-gray-100 shadow-md sm:shadow-lg rounded-md<?php echo $nextlink; ?> data-container="container">
            下一页<?php icons('chevron-right','stroke-2 w-4 h-4'); ?>
        </a>

    </div>

</div><!-- end #main -->

<?php 
$this->need('footer.php');
?>