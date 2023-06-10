<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(!$this->is('attachment')): ?>
<div class="w-full p-5 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-900">
<?php function threadedComments($comments, $options) {
    $commentClass = '';$sf="";
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {$sf=icons('lanv','ml-0.5',1);
            $commentClass .= '';  //如果是文章作者
        } else {
            $commentClass .= '';  //如果是评论作者
$sf="";
        }
    } 
   if ($comments->url) {
        $author = '<a href="' . $comments->url . '" target="_blank" rel="external nofollow" class="'.$commentClass.'" data-ajax="false">' . $comments->author . '</a>';
    } else {
                $author = '<span class="'.$commentClass.'">' . $comments->author . '</span>';
    }
    
    $commentLevelClass = $comments->levels > 0 ? ' comment-child children' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>

<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php echo $commentLevelClass; ?>">
<div id="<?php $comments->theId(); ?>"><div class="h-20 -mt-20 block invisible"></div>
 <article id="div-<?php $comments->theId(); ?>" class="flex comment-body my-2">
        <div class="flex-none mr-1"
 x-data="{k:[],imgurl:'<?php echo letter_avatar($comments->author); ?>',tx:'<?php echo letter_avatar($comments->author); ?>'}"
  x-init="k.type='<?php $k = commenttx($comments->mail,$comments->coid);echo $k['type']; ?>';
  k.url='<?php echo $k['url']; ?>';
  if(k.type=='qq'){
    fetch(k.url).then(data => data.json()).then(data => {
    imgurl=data.url;});
    }else{imgurl=k.url;}">
            
        <div class="relative">
        <img class="relative z-10 w-12 object-cover border-2 border-gray-200 rounded-full scrollLoading mr-1" :src="imgurl" alt="<?php echo $comments->author; ?>" x-cloak>
        <img class="absolute top-0 left-0 w-12 object-cover border-2 border-gray-200 rounded-full scrollLoading mr-1" :src="tx" alt="<?php echo $comments->author; ?>" x-cloak>
        </div>
        
        </div>
        <!-- .comment-author -->
<div class="flex-initial w-full text-sm">
            <div class="comment-author mb-1">
                <div class="flex items-center">
                    <?php echo $author.$sf; ?><span class="mx-1"></span><?php if ('waiting' == $comments->status) { ?><span class="text-muted">您的评论需管理员审核后才能显示！</span><?php } ?> </div>
            </div>
            <div class="comment-content px-4 py-2 rounded bg-slate-100 text-gray-900 dark:bg-gray-700 dark:text-gray-100">
                <?php 

$cos=$comments->content;
$cos=parseBiaoQing($comments->content);
$cos = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#',
        '<a$1 href="$2$3"$5 class="text-sky-500" target="_blank" rel="nofollow" data-ajax="false">', $cos);    

echo get_comment_at($comments->coid).$cos;
 ?>
                            </div><!-- .comment-content -->
            <div class="flex items-center comment-meta text-xs text-gray-500 mt-1" data-no-instant>
                <time class="mr-1"><?php echo timesince($comments->created); ?></time>
                <button class="flex items-center comment-reply cp-<?php $comments->theId(); ?> text-muted comment-reply-link hover:text-blue-500" onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid(); ?>);"><?php icons('comments','w-3.5 mr-0.5'); ?><span>回复</span></button>

                <button id="cancel-comment-reply" onclick="return TypechoComment.cancelReply();" class="flex items-center cancel-comment-reply cl-<?php $comments->theId(); ?> text-muted comment-reply-link text-red-500" style="display:none">
                <?php icons('x-mark','w-3.5 mr-0.5'); ?><span>取消</span></button>
            </div>
        </div><!-- .comment-text -->
    </article><!-- .comment-body -->
</div>



<?php if ($comments->children) { ?>
<?php $comments->threadedComments(); ?>
<?php } ?>
</li>
<?php } ?>




<div id="comments" class="post-comment">


<?php if($this->allow('comment')): ?> 
 <div id="<?php $this->respondId(); ?>" class="comment-respond"  data-no-instant>










<form method="post" action="<?php $this->commentUrl() ?>" id="commentform" class="comment-form"
    >
<div class="flex text-sm">

<div class="flex-initial w-full">
<div class="comment-form-body flex align-items-center rounded relative bg-slate-100 dark:bg-gray-700 dark:text-gray-100">

<textarea id="comment" name="text" class="resize-none py-2 px-1.5 OwO-textarea flex-1 w-full text-sm bg-transparent border-gray-600" rows="3" placeholder="说点什么吧" required><?php $this->remember('text'); ?></textarea>

    
<div class="form-submit comment-form-action flex flex-none justify-center px-2.5">
<button name="submit" type="submit" id="submit" class="flex items-center justify-center h-9 w-9 rounded-full m-auto py-2 text-xl text-white bg-red-500 border border-transparent transition duration-300 transform -rotate-45 hover:rotate-0 focus:outline-none" value="发布评论" aria-label="提交评论"><?php icons('paper-airplane'); ?></button>
</div>

</div>
<?php if($this->user->hasLogin()): ?>

 <?php else: ?>
<div class="comment-form-info mt-3">
<div class="grid grid-cols-1 md:grid-cols-<?php if (!empty($this->options->tools) && in_array('spam', $this->options->tools)){echo '3'; }else{echo '2'; } ?> gap-4">
<div>
<input class="w-full rounded py-1.5 px-1 text-sm comment-form-body text-gray-900 border-gray-100 bg-slate-100 dark:bg-gray-700 dark:text-gray-100" id="author" placeholder="昵称" name="author" type="text" value="<?php $this->remember('author'); ?>" required>
</div>
<div>
<input class="w-full rounded py-1.5 px-1 text-sm comment-form-body text-gray-900 border-gray-100 bg-slate-100 dark:bg-gray-700 dark:text-gray-100" id="mail" placeholder="Email" name="mail" type="email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
</div>
<?php if (!empty($this->options->tools) && in_array('spam', $this->options->tools)): ?>
<?php spam_protection_math(); ?>
<?php endif; ?>
</div>
</div>     
<?php endif; ?>
 
<div class="flex items-center mt-1 text-gray-600 dark:text-gray-400">
<label class="inline-flex items-center">
 <?php
$owo=array("ヾ(≧∇≦*)ゝ","OωO","(｡•ˇ‸ˇ•｡)","(°∀°)ﾉ","（/TДT)/","Σ(ﾟдﾟ;)","ヽ(`Д´)ﾉ");
$owo='<button type="button" class="OwO-logo mr-3" rel="external nofollow" data-no-instant><small class="text-xs">'.$owo[array_rand($owo,1)].'</small></button>';  
//$owo='<a href="javascript: void(0);" class="OwO-logo mr-3 border border-gray-100 rounded px-2 py-1"><small class="text-xs"><span class="sui-smile mr-1"></span>表情</small></a>';  
echo $owo;
?>
</label>



  <?php $all = Typecho_Plugin::export();?><?php if (array_key_exists('SecretComments', $all['activated'])) : ?>
    <input type="checkbox" name="is-private" id="PrivateComments" class="hidden">
    <label for="PrivateComments" class="relative rounded-full bg-gray-200 cursor-pointer mr-1 dark:bg-gray-700"></label><span>隐私评论</span>
<?php endif; ?>       

      

        
</div>   
  
    
    
       <div class="OwO mt-2"></div>    
    
    
    
    
    
</div></div>
</form>
</div>
<?php else: ?>
<!--评论已关闭-->
<?php endif; ?>





<?php $this->comments()->to($comments); ?>
<?php if ($comments->have()): ?>
<?php $comments->listComments(); ?>


<div class="flex items-center justify-between my-5">
    

<?php 
$pattern = '/\<li.*?class=\"prev\"><a.*?\shref\=\"(.*?)\"[^>]*>/i';
$npattern = '/\<li.*?class=\"next\"><a.*?\shref\=\"(.*?)\"[^>]*>/i';
ob_start();
$comments->pageNav();
$con = ob_get_clean();
$n=preg_match_all($npattern, $con, $nextlink);
if($n){
$nextlink=str_replace('#comments', '', $nextlink[1][0]);
$nextlink='"@click="getdetail($el,\''.$nextlink.'\',\'#comments\')"';
}else{
$nextlink=' disabled:opacity-0" disabled="disabled"';
}

$p=preg_match_all($pattern, $con, $prevlink);
if($p){
$prevlink=str_replace('#comments', '', $prevlink[1][0]);
$prevlink='"@click="getdetail($el,\''.$prevlink.'\',\'#comments\')"';
}else{
$prevlink=' disabled:opacity-0" disabled="disabled"';
}

?>

<button class="px-4 py-2 mx-1 text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-100 shadow-md sm:shadow-lg rounded-md<?php echo $prevlink; ?> data-container="container">
<?php icons('chevron-right','stroke-2 w-4 h-4 rotate-180'); ?>
</button>
<button class="px-4 py-2 mx-1 text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-100 shadow-md sm:shadow-lg rounded-md<?php echo $nextlink; ?> data-container="container">
<?php icons('chevron-right','stroke-2 w-4 h-4'); ?>
</button>

</div>
<?php else: ?>
<div class="w-full flex justify-center text-gray-500 text-xs pt-2 pb-6">
    
    暂无评论，快来抢沙发
    
</div>

<?php endif; ?>








</div>

<script type="text/javascript">
(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},pom:function(id){return document.getElementsByClassName(id)[0]},iom:function(id,dis){var alist=document.getElementsByClassName(id);if(alist){for(var idx=0;idx<alist.length;idx++){var mya=alist[idx];mya.style.display=dis}}},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom("<?php echo $this->respondId(); ?>"),input=this.dom("comment-parent"),form="form"==response.tagName?response:response.getElementsByTagName("form")[0],textarea=response.getElementsByTagName("textarea")[0];if(null==input){input=this.create("input",{"type":"hidden","name":"parent","id":"comment-parent"});form.appendChild(input)}input.setAttribute("value",coid);if(null==this.dom("comment-form-place-holder")){var holder=this.create("div",{"id":"comment-form-place-holder"});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.iom("comment-reply","");this.pom("cp-"+cid).style.display="none";this.iom("cancel-comment-reply","none");this.pom("cl-"+cid).style.display="";if(null!=textarea&&"text"==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom("<?php echo $this->respondId(); ?>"),holder=this.dom("comment-form-place-holder"),input=this.dom("comment-parent");if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.iom("comment-reply","");this.iom("cancel-comment-reply","none");holder.parentNode.insertBefore(response,holder);return false}}})();
</script>
</div>
<?php endif; ?>