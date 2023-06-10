<?php 
/**
 * 友情链接
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(!$this->request->get('feach')){
    $this->need('templates/onlypost.php');
exit;
}
?>
<title class="hidden" x-init="document.title='<?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?>';"></title>
        
<div class="post max-h-full overflow-y-auto scroll-smooth text-gray-900 dark:text-gray-100">


    <div
        class="sticky shadow z-20 top-0 bg-white  dark:bg-black border-b dark:border-gray-600">
        <div class="flex items-center p-2">
            <a :href="$store.ze.back" data-rel="back" class="flex-none text-gray-700 dark:text-gray-200">
                <div class="h-full p-1"><?php echo icons('arrow-small-left','w-6 h-6'); ?></div>
            </a>
            <div class="flex-1 pl-1">
                <div class="font-black"><?php $this->title() ?></div>
                <div class="text-gray-500 text-xs hidden sm:block"><?php $this->commentsNum(); ?> 条讨论 <?php if($this->user->uid==$this->authorId):?><a href="<?php $this->options->adminUrl(); ?><?php if ($this->is('attachment')) : ?>media<?php else: ?>write-<?php if($this->is('post')): ?>post<?php else: ?>page<?php endif;?><?php endif;?>.php?cid=<?php echo $this->cid;?>" class="text-sky-500"  target="_blank" data-ajax="false">✍️ 编辑</a><?php endif;?></div>
            </div>
            <button data-clipboard-action="copy" data-clipboard-text="<?php echo $this->title."\n".$this->permalink; ?>" class="flex-none copyurl"><?php echo icons('share','w-6 h-6 p-1'); ?></button>
        </div>
    </div>




<!--cache-->

<div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 mb-4 p-5">
<?php 
Links_Plugin::output('<div class="flex items-center p-4 bg-black text-white shadow rounded-md transition-all duration-300 transform hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
<a href="{url}" title="{name}" target="_blank" data-ajax="false" rel="noopener" class="flex flex-shrink-0 z-10"><img src="'.theurl.'img/load.gif" class="w-11 h-11 lg:w-14 lg:h-14 object-cover rounded-full scrollLoading" data-xurl="{image}"></a>
<div class="w-full mt-0 pl-2 z-10"><p class="text-base font-medium line-1 dark:text-gray-50"><a href="{url}" target="_blank" rel="noopener" title="{name}" class="block">{name}</a></p><p class="text-xs text-gray-100 line-1 mt-1">{description}</p>
</div>
<div class="rounded-md absolute inset-0 bg-cover bg-no-repeat opacity-70" style="background-image:url({image});background-size: 200000%;
background-position: center 30%;"></div>
</div>'); ?>

</div>
  
<?php if(!empty($this->content)): ?> 
<article class="post-content shadow mx-3 my-5 p-5 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 rounded-lg">
 <div id="post" class="post-content fancycon mb-4">   
<?php $this->content(); ?>
</div>  
</article> 

<?php endif; ?>
<!--cacheend-->


<div class="shadow mx-3 my-5  rounded-lg overflow-hidden">
<?php $this->need('comments.php'); ?>
</div>


</div>