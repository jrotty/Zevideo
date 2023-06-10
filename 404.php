<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(!$this->request->get('feach')){
$this->need('header.php');
}


?>
 <div class="absolute inset-0 lg:p-2 z-50 bg-white dark:bg-black">
     
<div class="py-24 text-l text-muted text-center dark:text-gray-200"><div class="svg-404 mx-auto mb-3"></div><p class="mb-3">很抱歉，您访问的页面不存在！<br>请仔细检查您输入的网址是否正确。</p>
<a href='<?php $this->options->siteUrl(); ?>' data-ajax="false" class='px-3 py-2 border border-gray-500 rounded'>返回首页</a>

</div>




</div>


<?php 
 if(!$this->request->get('feach')){
 $this->need('footer.php');
}
 ?>