<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div id="xpost" class="page content">
        
<script type='text/javascript'>/* <![CDATA[ */
var globals = {"post_id":"<?php $this->cid(); ?>","post_url":"<?php $this->permalink(); ?>"};
/* ]]> */</script>

<div class="post max-h-full overflow-y-auto break-all scroll-smooth
 text-gray-900 dark:text-gray-100
 ">
<div class="sticky shadow z-20 top-0 bg-white dark:bg-black border-b dark:border-gray-600">
    
<div class="flex items-center p-2">
<div class="flex-1 pl-1">
                <div class="font-black"><?php $this->title() ?></div>
<div class="text-gray-500 text-xs hidden sm:flex">
    <div><?php $this->commentsNum(); ?> 条讨论 🗓<?php $this->date('Y日m月d日'); ?> 
    <?php if($this->user->uid==$this->authorId):?><a href="<?php $this->options->adminUrl(); ?><?php if ($this->is('attachment')) : ?>media<?php else: ?>write-<?php if($this->is('post')): ?>post<?php else: ?>page<?php endif;?><?php endif;?>.php?cid=<?php echo $this->cid;?>" class="text-sky-500"  target="_blank" data-ajax="false">✍编辑</a><?php endif;?>
    </div>
    </div>
</div>
<div class="flex-none">
<button data-clipboard-action="copy" data-clipboard-text="<?php echo $this->title."\n".$this->permalink; ?>" class="copyurl" aria-label="分享"><?php echo icons('share','w-6 h-6 p-1'); ?></button>
    
</div>
</div>


</div>

<div class="container mx-auto">

<article class="post-content shadow mx-3 mt-3 mb-5 p-5 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 rounded-lg">
<div id="post">
<?php if($this->fields->mp4){ $this->need('player.php');}
else{
$this->content=setshortcode($this->content);
$this->content();} ?>
</div>
<?php if (array_key_exists('TePass', Typecho_Plugin::export()['activated'])){echo TePass_Plugin::getTePass();} ?>

<?php if(!empty($this->options->tools)&&in_array('cc', $this->options->tools)): ?>
<!--文章版权声明-->
<div class="mt-5 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 p-3.5 rounded-md text-sm">
    <div>
<div class="mb-1"><?php icons('user-circle','flex-none inline align-text-bottom w-4 h-4'); ?><span class="ml-0.5 font-medium">版权属于：</span><?php $this->author->screenName(); ?></div>
<div class="mb-1"><?php icons('link','flex-none inline align-text-bottom w-4 h-4'); ?>
<span class="ml-0.5 font-medium">本文链接：</span><?php $this->permalink() ?></div>

<div class=""><?php icons('information-circle','flex-none inline align-text-bottom w-4 h-4'); ?><span class="ml-0.5">本站未注明转载的文章均为原创，并采用 <a class="text-blue-500" target="_blank" href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh-Hans">
    CC BY-NC-SA 4.0</a> 授权协议，转载请注明来源，谢谢！</span></div>
    </div>
</div>
<!--文章版权声明-->
<?php endif; ?>

</article><!-- end #article-->


<div class="shadow mx-3 my-5 rounded-lg overflow-hidden">
<?php $this->need('comments.php'); ?>
</div>

</div>


</div>
</div>

<?php 
$this->need('footer.php');
?>