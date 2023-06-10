<div class="h-full max-h-full overflow-y-auto dark:text-gray-200 scroll-smooth px-3" 
 x-init="setTimeout(function () {pjax.refresh();Limg();}, 50);"
    >

<?php 
$txt=$this->options->cms;
if(empty($txt)){
echo '<div class="py-24"><div class="svg-404 mx-auto mb-3"></div><p class="text-l text-muted text-center dark:text-gray-200">请在模板设置处配置cms布局！</p></div>';
}else{
$txt=str_replace("\r\n","\n",$txt);
$string_arr = explode("\n", $txt);
$long=count($string_arr);
?>
<?php 
for($i=0;$i<$long;$i++){
$id=explode("$",$string_arr[$i])[0];
$biaoti=explode("$",$string_arr[$i])[1];
$slm=explode("$",$string_arr[$i])[2];
$order='&orderBy=modified';
$sl=$slm*6;
?>
<?php 
if($id==0){
$this->widget('Widget_Contents_Post_Recent@index'.$i,'pageSize='.$sl.$order)->to($new);
}else{
$this->widget('Widget_Post_ct@inde'.$i, 'pageSize='.$sl.$order.'&mid='.$id)->to($new);
}

?>

<div class="flex items-center justify-between pt-2 mb-3 text-sm focus:outline-none">
    <div class="text-xl xl:text-2xl font-extrabold"><span><?php echo $biaoti; ?></span></div>
    
    <?php if($id!=0){ ?>
<a href="<?php echo $new->categories[0]['permalink']; ?>" class="rounded-md bg-gray-200 dark:bg-gray-700 px-2 py-1 cursor-pointer hover:text-sky-500">更多</a>
<?php } ?></div>


<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 2xl:gap-8 pb-8 border-b border-gray-200 dark:border-gray-800">
    

<?php while ($new->next()): ?>
<a href="<?php $new->permalink() ?>" class="cursor-pointer transition-all duration-300 transform hover:-translate-y-1">
        <div class="shadow-md media media-<?php if($id==0){echo '16x9';}else{echo '10x14';} ?>">
        <img class="media-content rounded w-full h-full object-cover" data-xurl="<?php showThumbnail($new); ?>">
        <div class="absolute bottom-2 text-xs bg-red-500 text-white px-1 py-0.5 rounded-r-md"><?php gengxin($new); ?></div>
    </div>
    <div class="text-gray-700 text-sm mt-1 sm:px-2 dark:text-white">
        <p class="text-center line-1"><?php $new->title(); ?></p>
 </div>       
</a>

<?php endwhile; ?>





</div>
<?php }} ?>


<?php if($this->options->ad3): ?>
<div class="guanggaowei my-5 shadow rounded-lg overflow-hidden text-center">
<?php $this->options->ad3(); ?>
</div>  
<?php endif; ?>

<div class="p-2 text-center">
<footer class="text-sm">Copyright © 2023 <?php $this->options->footer(); ?> Theme By <a href="https://github.com/jrotty/Zevideo" target="_blank" rel="noopener noreferrer">Zevideo</a> </footer>
</div>
</div>