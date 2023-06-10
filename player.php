<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div x-data="{url:'',i:0,html:false,cid:'<?php $this->cid(); ?>',posttitle:'<?php $this->title(); ?>',posturl:'<?php $this->permalink() ?>',his:'null'}"
x-init="his=cookie.getjson('xhistory',cid);"
@createiframe="document.querySelector('.post').scrollTo(0, 0);html=false;html='&lt;iframe src=&quot;<?php echo theurl;?>lib/player.php?url='+url+'&quot; scrolling=&quot;no&quot; border=&quot;0&quot; frameborder=&quot;no&quot; framespacing=&quot;0&quot; allowfullscreen=&quot;true&quot;&gt;&lt;/iframe&gt;';"
    >


<?php
$duoji="";
$list="";
if($this->fields->duoji && strpos($this->fields->duoji,'$') !== false){

$hang = array_filter(explode("\r\n", $this->fields->duoji));
$shu=count($hang);

for($i=0;$i<$shu;$i++){
$cid=explode("$",$hang[$i])[1];
$this->widget('Widget_Archive@duoji'.$cid, 'pageSize=1&type=post', 'cid='.$cid)->to($ji); 

if($ji->cid==$this->cid){
$duoji=$duoji."<span class=\"ml-1 uk-text-small p-1 uk-text-secondary\">".explode("$",$hang[$i])[0]."</span>";
}else{
$duoji=$duoji."<a href=\"".$ji->permalink."\" class=\"ml-1 uk-text-small p-1\">".explode("$",$hang[$i])[0]."</a>";
}
}

}





function jishulist($text,$type=0,$can=null,$c=0) {

if($text->fields->mp4){
$spurl=$text->fields->mp4;
}

if(strpos($spurl,'$') == false){
$spurl='全集$'.$spurl;
}

$sptitle=0;
$x=0;

if(strpos($spurl,'$') !== false){

$j=0;
if(isset($_GET['action']) == 'get' && 'GET' == $_SERVER['REQUEST_METHOD'] ) {
$j=$_GET['p']-1;
}

$txt=$spurl;

$string_arr = array_filter(explode("\r\n", $txt));


$long=count($string_arr);
$list="";
for($i=0;$i<$long;$i++){

$j=$i+1;
//cookie.set(cid,\''.$j.'\',30);
$c="class=\"jinum".$j." relative inline-block px-5 py-2 text-sm font-medium font-mono rounded-sm m-2\" :class=\"{'bg-red-500 text-white':i==".$j.",'bg-gray-100 dark:bg-gray-800':i!=".$j."}\"";
$list=$list.'<button  x-ref="jinum'.$j.'" @click="i=\''.$j.'\';url=\''.explode("$",$string_arr[$i])[1].'\';$dispatch(\'createiframe\');cookie.setjson(\'xhistory\',[cid,\''.$j.'\',posttitle,posturl,Date.now()],30);" '.$c.'>'.explode("$",$string_arr[$i])[0].'</button>';

}
if($type==0){
return @explode("$",$string_arr[$j])[1];
}elseif($type==2){

if(@isset(explode("$",$string_arr[$j])[2])){
return @explode("$",$string_arr[$j])[2];}else{
return '';
}

}
else{
$list= '<div class="mb-3 border dark:border-gray-600 py-2 overflow-y-auto max-h-96">'.$list.'</div>';
return $list;
}



}
}




$spurl=jishulist($this,0);

$zimu=jishulist($this,2);

$list=jishulist($this,1,'');    
    

?>
<div class="mb-5" x-show="html" x-cloak style="
    margin-left: -1.25rem;
    margin-right: -1.25rem;
    margin-top: -1.25rem;
">
<div class="marquee text-red-500 text-sm"><p>提示：请不要相信视频中的任何广告内容</p></div>
<div class="media media-16x9" id="player" x-html="html">
</div> 
<div class="marquee text-red-500 text-sm"><p>提示：请不要相信视频中的任何广告内容</p></div>
</div>

<div class="overflow-hidden p-3 mb-5 relative bg-black text-white"
style="
    margin-left: -1.25rem;
    margin-right: -1.25rem;
    margin-top: -1.25rem;
">

<div class="md:flex relative z-10">
<div class="md:flex-none mr-2">

<div class="shadow-md w-36 mx-auto media media-10x14 rounded-lg overflow-hidden">
        <img @click="html=false;i=0;his=cookie.getjson('phistory',cid);" class="cursor-pointer media-content w-full h-full object-cover" data-xurl="<?php showThumbnail($this); ?>">
        <div class="absolute bottom-2 text-xs bg-red-500 text-white px-1 py-0.5 rounded-r-md"><?php gengxin($this); ?></div>
</div>
    
</div>
<div class="md:flex-1">
<h1 class="cursor-pointer text-lg mb-2" @click="html=false;i=0;his=cookie.getjson('phistory',cid);"><?php $this->title() ?></h1>

<?php if($this->fields->niandai){echo '<div class="mb-1">发布年代：'.$this->fields->niandai.'年</div>';} ?>
<?php if($this->fields->name){echo '<div class="mb-1">又名：'.$this->fields->name.'</div>';} ?>
<?php $zhuangtai="完结";if($this->fields->zhuangtai==1){$zhuangtai="连载";}if($this->fields->zhuangtai==-1){$zhuangtai="预告";}
echo '<div class="mb-1">状态：'.$zhuangtai.'</div>'; ?>
<?php if(count($this->tags) != 0 ): ?>
<div class="text-xs -mx-0.5 mb-1">
<?php 
foreach($this->tags as $val){
    ?>
<a href="<?php echo $val['url']; ?>" itemprop="url" class="shadow mx-0.5 px-2 py-1 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 rounded-lg"><?php echo $val['name']; ?></a>
<?php } ?>
</div>
<?php endif; ?>
<div>
<?php $text=preg_replace('#　#', '', $this->text);
echo $text; ?>
</div>
</div>
</div>

<div class="absolute inset-0 bg-no-repeat bg-cover bg-center blur-lg opacity-60 transform scale-110" style="background-image: url(<?php showThumbnail($this) ?>);"></div>
</div>

<div x-show="(!html&&his!='null')" class="mt-4 mb-5" x-cloak>
<div class="tips rounded w-full text-white bg-blue-600">
    <div class="container flex items-center justify-between px-6 py-4 mx-auto"> 
    <div class="flex items-center">
    <div><svg viewBox="0 0 40 40" class="w-6 h-6 fill-current"> <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path> </svg></div><div class="mx-3">您上次观看到<span x-text="his[1]"></span>集，<span class="cursor-pointer text-red-500" @click="document.querySelector('.jinum'+his[1]).click();">点此继续播放</span></div>
    </div>
            <button @click="his='null'" class="p-1 transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
    </div>
    </div>
</div>
<div class="tool-button mt-4">
<h1 class="text-lg mb-2">剧集</h1>
<?php echo $list; ?>
</div>

</div>