<?php

if($this->options->rewrite==0){
$soso="/index.php/search/sy/";
}else{
$soso="/search/sy/";
}

$sousou=$this->options->rootUrl.$soso;


$can="";
$gj="&gaojijiansuo=1";
$cat=intval($this->request->cat);
$tag=intval($this->request->tag);
$niandai=intval($this->request->niandai);
$zhuangtai=intval($this->request->zhuangtai);
$site=intval($this->request->site);
if(!$site){$site=0;}
if(!$cat){$cat=0;}
if(!$tag){$tag=0;}
if(!$niandai){$niandai=0;}
if(!$zhuangtai){$zhuangtai=-2;}
 ?>







<?php 

$can='?cat='.$cat.'&site='.$site.'&tag='.$tag.'&niandai='.$niandai.'&zhuangtai='.$zhuangtai.$gj;
$tclass="font-bold dark:text-white";
$aclass='mx-1 py-0.5 text-sm dark:text-white';
$cclass=' px-2 bg-blue-500 text-white rounded-full';
 ?>
<div class="text-base m-3 dark:text-white p-3 border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-700">


<div class="mb-3"><span class="<?php echo $tclass; ?>">类型：</span><a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=0&site=0&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="<?php echo $aclass; ?><?php if($cat==0){echo $cclass;} ?>">全部</a>                    
<?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
<?php while($categorys->next()): ?><?php if ($categorys->levels === 0): ?>
<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php $categorys->mid(); ?>&site=0&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" title="<?php $categorys->name(); ?>" class="<?php echo $aclass; ?><?php if($cat==$categorys->mid){echo $cclass;} ?>"><?php $categorys->name(); ?></a>
<?php endif; ?><?php endwhile; ?>

</div>





<?php if ($cat != 0): ?>
<?php $this->widget('Widget_Post_cat@catx', 'mid='.$cat)->to($categorys); ?>
<?php if ($categorys->have()): ?>

<div class="mb-3"><span class="<?php echo $tclass; ?>">子类：</span><a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat.$gj; ?>&site=0&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="<?php echo $aclass; ?><?php if($site==0){echo $cclass;} ?>">全部</a>                    

<?php while($categorys->next()): ?>
<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat.$gj; ?>&site=<?php $categorys->mid(); ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" title="<?php $categorys->name(); ?>" class="<?php echo $aclass; ?><?php if($site==$categorys->mid){echo $cclass;} ?>"><?php $categorys->name(); ?></a>
<?php endwhile; ?></div>

<?php endif; ?>


<?php endif; ?>


<div class="mb-3"><span class="<?php echo $tclass; ?>">标签：</span><a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&tag=0&cat=<?php echo $cat.$gj; ?>&site=<?php echo $site; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="<?php echo $aclass; ?><?php if($tag==0){echo $cclass;} ?>">全部</a>

<?php $this->widget('Widget_Metas_Tag_Cloud',array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 30))->to($tags); ?>  
<?php while($tags->next()){
if(mb_strlen($tags->name,'UTF8')<4&&$tags->name!='韩国'&&$tags->name!='日本'&&$tags->name!='美国'&&$tags->name!='中国'&&$tags->name!='动画'){
?>  
<a rel="tag" href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&tag=<?php $tags->mid(); ?>&cat=<?php echo $cat.$gj; ?>&site=<?php echo $site; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="<?php echo $aclass; ?><?php if($tag==$tags->mid){echo $cclass;} ?>"><?php $tags->name(); ?></a>
<?php }} ?>

</div>


<div class="mb-3"><span class="<?php echo $tclass; ?>">状态：</span><a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat; ?>&site=<?php echo $site; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=-2" class="<?php echo $aclass; ?><?php if($zhuangtai==-2){echo $cclass;} ?>">全部</a>    
<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat; ?>&site=<?php echo $site; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=2" class="<?php echo $aclass; ?><?php if($zhuangtai==2){echo $cclass;} ?>">完结</a>
<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat; ?>&site=<?php echo $site; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=1" class="<?php echo $aclass; ?><?php if($zhuangtai==1){echo $cclass;} ?>">连载</a>

<!--<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat; ?>&site=<?php echo $site; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=-1" class="<?php echo $aclass; ?><?php if($zhuangtai==-1){echo $cclass;} ?>">预告</a>-->
</div>



<div class="break-all"><span class="<?php echo $tclass; ?>">年代：</span><a href="<?php echo $sousou; ?>?niandai=0&cat=<?php echo $cat; ?>&site=<?php echo $site; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="<?php echo $aclass; ?><?php if($niandai==0){echo $cclass;} ?>">全部</a>     
<?php 
$y=date('Y');
for($i=0;$i<15;$i++){
$c="";
if($y==$niandai){$c=$cclass;}
echo '<a href="'.$sousou.'?niandai='.$y.'&cat='.$cat.'&site='.$site.'&tag='.$tag.$gj.'&zhuangtai='.$zhuangtai.'" class="'.$aclass.$c.'">'.$y.'</a>';
$y--;
}
?>
<a href="<?php echo $sousou; ?>?niandai=-<?php echo $y; ?>&cat=<?php echo $cat; ?>&site=<?php echo $site; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="<?php echo $aclass; ?><?php if($niandai==-$y){echo $cclass;} ?>">更早</a>
</div>
                </div>



