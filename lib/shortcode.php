<?php 

function setshortcode($con,$type='post'){
$user = Typecho_Widget::widget('Widget_User');  
$con=preg_replace('/<h1>(.*?)<\/h1>/i', '<h1 class="text-3xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-3 dark:text-white dark:border-gray-700">$1</h1>', $con);

$con=preg_replace('/<h2>(.*?)<\/h2>/i', '<h2 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>$1</h2>', $con);

$con=preg_replace('/<h3>(.*?)<\/h3>/i', '<h3 class="text-xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>$1</h3>', $con);
  
$con=preg_replace('/<h4>(.*?)<\/h4>/i', '<h4 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-100 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>$1</h4>', $con);

$con=preg_replace('/<h5>(.*?)<\/h5>/i', '<h5 class="text-base font-semibold text-gray-800 border-b-2 border-gray-100 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>$1</h5>', $con);

$con=preg_replace('/<h6>(.*?)<\/h6>/i', '<h6 class="text-sm font-semibold text-gray-800 border-b-2 border-gray-100 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>$1</h6>', $con);

$con=preg_replace('/<hr>/i', '<hr class="border border-gray-200 dark:border-gray-700 my-8">', $con);
$con=preg_replace('/<blockquote>/i', '<blockquote class="border-l-4 border-sky-500 pl-4 mb-5">', $con); 

// 文章内链接新窗口打开
$con=preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" class=\"text-sky-500\" target=\"_blank\" rel=\"nofollow\" data-ajax=\"false\">", $con);
//表格样式追加class
$con=preg_replace("/<table(.*?)>/","<div class=\"mb-5 overflow-x-auto\"><table class=\"table-auto w-full whitespace-nowrap\"$1>", $con);
$con=preg_replace("/<thead(.*?)>/","<xhead$1>", $con);
$con=preg_replace("/<th(.*?)>/","<th class=\"border border-gray-200 dark:border-gray-700 p-2\"$1>", $con);
$con=preg_replace("/<td(.*?)>/","<td class=\"border border-gray-200 dark:border-gray-700 p-2\"$1>", $con);
$con=preg_replace("/<xhead(.*?)>/","<thead$1 class=\"w-full bg-gray-100 dark:bg-gray-800\">", $con);
$con=preg_replace("/<\/table>/","</table></div>", $con);

// 视频比例优化
$con=preg_replace('/<xiframe(.*?)<\/xiframe>/i', '<div class="media media-16x9 mb-5"><iframe$1</iframe></div>', $con);

return $con;
}

?>
