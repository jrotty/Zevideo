<?php 

function setshortcode($con,$type='post'){
$user = Typecho_Widget::widget('Widget_User');  
$con=preg_replace('/<h1>(.*?)<\/h1>/i', '<h1 class="text-3xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-3 dark:text-white dark:border-gray-700">$1</h1>', $con);

$con=preg_replace('/<h2>(.*?)<\/h2>/i', '<h2 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>$1</h2>', $con);

$con=preg_replace('/<h3>(.*?)<\/h3>/i', '<h3 class="text-xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>$1</h3>', $con);
  
$con=preg_replace('/<h4>(.*?)<\/h4>/i', '<h4 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-100 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>$1</h4>', $con);

$con=preg_replace('/<h5>(.*?)<\/h5>/i', '<h5 class="text-base font-semibold text-gray-800 border-b-2 border-gray-100 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>$1</h5>', $con);

$con=preg_replace('/<h6>(.*?)<\/h6>/i', '<h6 class="text-sm font-semibold text-gray-800 border-b-2 border-gray-100 pb-2 mb-3 flex flex-row items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>$1</h6>', $con);

$con=preg_replace('#<img(.*?)title="(.*?)"(.*?)>#', '<div class="relative inline-block"><img$1title="$2"$3 loading="lazy"><span class="absolute top-0 left-0 text-xs text-gray-900 bg-gray-100 dark:text-white dark:bg-gray-700 p-1 rounded-br-md">$2</span></div>', $con); 

$con=preg_replace('/<hr>/i', '<hr class="border border-gray-200 dark:border-gray-700 my-8">', $con);
$con=preg_replace('/<blockquote>/i', '<blockquote class="border-l-4 border-sky-500 pl-4 mb-5">', $con); 

$con=preg_replace('#<li>\[[x|X]\](.*?)<\/li>#', '<li class="list-none !mt-1">✅$1</li>', $con);
$con=preg_replace('#<li>\[ \](.*?)<\/li>#', '<li class="list-none !mt-1">⬜️$1</li>', $con);

// 文章内链接新窗口打开
$con=preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" class=\"text-sky-500\" target=\"_blank\" rel=\"nofollow\" data-ajax=\"false\">", $con);
//表格样式追加class
$con=preg_replace("/<table(.*?)>/","<div class=\"mb-5 overflow-x-auto\"><table class=\"table-auto w-full whitespace-nowrap\"$1>", $con);
$con=preg_replace("/<thead(.*?)>/","<xhead$1>", $con);
$con=preg_replace("/<th(.*?)>/","<th class=\"border border-gray-200 dark:border-gray-700 p-2\"$1>", $con);
$con=preg_replace("/<td(.*?)>/","<td class=\"border border-gray-200 dark:border-gray-700 p-2\"$1>", $con);
$con=preg_replace("/<xhead(.*?)>/","<thead$1 class=\"w-full bg-gray-100 dark:bg-gray-800\">", $con);
$con=preg_replace("/<\/table>/","</table></div>", $con);

//符号转译
$con = preg_replace_callback('#<code(.*?)>([\s\S]*?)<\/code>#','code',$con);
//按钮短代码
$con = preg_replace_callback('#(<br\s*/?>)?\{(btn|button) (url|href)="(.*?)"( type="(.*?)")?\}(.*?)\{\/(btn|button)\}(<br\s*/?>)?#','btn',$con);

$con=preg_replace('#(<p>)?\{center\}(.*?)\{\/center\}(<\/p>)?#', '<center>$2</center>', $con); 

//登录可见
if($user->hasLogin()){
$con=preg_replace('#\{login\}(.*?)\{\/login\}#', '$1', $con); 
}else{
$con=preg_replace('#\{login\}(.*?)\{\/login\}#', '{tip type="error"}抱歉，隐藏内容
<a class="text-sky-500" data-ajax="false" href="'.Helper::options()->adminUrl.'" target="_blank">登陆</a> 后可见{/tip}', $con); 
}

// 视频比例优化
$con=preg_replace('/<xiframe(.*?)<\/xiframe>/i', '<div class="media media-16x9 mb-5"><iframe$1</iframe></div>', $con);

//允许使用span标签，支持使用class
$con=preg_replace('#\{span class="(.*?)"\}#', '<span class="$1">', $con);
$con=preg_replace('#\{\/span\}#', '</span>', $con);

//下载按钮
$con = preg_replace('#\{file (url|href)="(.*?)"( type="(.*?)")?\}(.*?)\{\/file\}#','<div class="flex $4"><div class="flex items-center rounded shadow border border-gray-200 dark:border-gray-700 px-3 py-2.5">
  <div class="flex-grow">
    <a href="$2" data-ajax="false" target="_blank" class="flex items-center"><svg class="w-8 h-8 inline dark:text-blue-400 mr-3" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="22725"><path d="M678.64064 514.00704a168.448 168.448 0 1 0-168.448 167.7056 168.06912 168.06912 0 0 0 168.448-167.7056z" fill="#F4CA1C" p-id="22726"></path><path d="M983.04 603.41248a242.48832 242.48832 0 0 0-280.39168-238.40768 253.32224 253.32224 0 0 0-446.42816-77.824 249.13408 249.13408 0 0 0-48.95744 153.38496A203.39712 203.39712 0 0 0 240.18944 844.8h527.77472a31.98976 31.98976 0 0 0 14.75072-3.71712A242.03776 242.03776 0 0 0 983.04 603.41248z m-242.432 177.30048H240.18944a139.38688 139.38688 0 1 1 0-278.76864 31.96928 31.96928 0 0 0 8.704-1.34144 31.96416 31.96416 0 0 0 24.84736-35.99872 187.81184 187.81184 0 0 1 157.74208-214.016A188.46208 188.46208 0 0 1 641.024 383.42656a241.62816 241.62816 0 0 0-142.848 219.98592 32.1792 32.1792 0 0 0 64.3584 0 178.06848 178.06848 0 1 1 178.0736 177.30048z" fill="#595BB3" p-id="22727"></path></svg><div class="flex flex-col font-mono"><div class="text-gray-900 font-semibold dark:text-white">$5</div></div></a>
  </div>
  <div class="flex-none ml-3">
    <a href="$2" data-ajax="false" target="_blank" class="flex  text-white text-2xl p-2 bg-indigo-600 rounded-full hover:bg-indigo-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>
</a>
  </div>
</div></div>
',$con);

//github仓库控件
$con = preg_replace('#\{github repo="(.*?)"(.*?)\}#','<div x-data="{ html:\'\'}" x-init="fetch(\'https://api.github.com/repos/$1\').then(response => response.json()).then(data=>{html=\'<div class=&quot;py-3 px-2 md:px-5 bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700&quot;><div class=&quot;flex items-center justify-between&quot;><div class=&quot;flex items-center font-semibold capitalize&quot;><svg class=&quot;text-gray-600 w-5 h-5 mr-1 dark:text-gray-200&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; viewBox=&quot;0 0 496 512&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><path fill=&quot;currentColor&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; stroke-width=&quot;2&quot; d=&quot;M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z&quot;></path></svg><a href=&quot;\'+data.html_url+\'&quot; target=&quot;_blank&quot;><span class=&quot;text-gray-600 dark:text-gray-100&quot;>\'+data.name+\'</span></a></div><div class=&quot;flex bg-white border text-sm px-2 py-0.5 dark:bg-gray-800 dark:border-gray-700&quot;><a href=&quot;\'+data.html_url+\'/stargazers&quot; target=&quot;_blank&quot; class=&quot;flex items-center mr-2&quot;><svg class=&quot;text-gray-600 w-4 h-4 mr-1 dark:text-gray-200&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; viewBox=&quot;0 0 576 512&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><path fill=&quot;currentColor&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; stroke-width=&quot;2&quot; d=&quot;M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z&quot;></path></svg>\'+data.watchers_count+\'</a><a href=&quot;\'+data.html_url+\'/network/members&quot; target=&quot;_blank&quot; class=&quot;flex items-center&quot;><svg class=&quot;text-gray-600 w-4 h-4 mr-1 dark:text-gray-200&quot;  fill=&quot;none&quot; stroke=&quot;currentColor&quot; viewBox=&quot;0 0 384 512&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><path fill=&quot;currentColor&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; stroke-width=&quot;2&quot; d=&quot;M384 144c0-44.2-35.8-80-80-80s-80 35.8-80 80c0 36.4 24.3 67.1 57.5 76.8-.6 16.1-4.2 28.5-11 36.9-15.4 19.2-49.3 22.4-85.2 25.7-28.2 2.6-57.4 5.4-81.3 16.9v-144c32.5-10.2 56-40.5 56-76.3 0-44.2-35.8-80-80-80S0 35.8 0 80c0 35.8 23.5 66.1 56 76.3v199.3C23.5 365.9 0 396.2 0 432c0 44.2 35.8 80 80 80s80-35.8 80-80c0-34-21.2-63.1-51.2-74.6 3.1-5.2 7.8-9.8 14.9-13.4 16.2-8.2 40.4-10.4 66.1-12.8 42.2-3.9 90-8.4 118.2-43.4 14-17.4 21.1-39.8 21.6-67.9 31.6-10.8 54.4-40.7 54.4-75.9zM80 64c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16 7.2-16 16-16zm0 384c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zm224-320c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16 7.2-16 16-16z&quot;></path></svg>\'+data.forks_count+\'</a></div></div></div><div class=&quot;p-2 md:p-5 text-sm text-gray-600 dark:text-gray-200&quot;>\'+data.description+\'—<a href=&quot;\'+data.html_url+\'#readme&quot; target=&quot;_blank&quot;>Read More</a><br><a href=&quot;\'+data.homepage+\'&quot; target=&quot;_blank&quot;>\'+data.homepage+\'</a></div><div class=&quot;py-3 px-2 md:px-5 bg-gray-100 border-t dark:bg-gray-800 dark:border-gray-700&quot;><a href=&quot;\'+data.html_url+\'/zipball/master&quot; title=&quot;Get an archive of this repository&quot; class=&quot;bg-white border text-sm px-2 py-0.5 dark:bg-gray-800 dark:border-gray-700&quot;>Download as zip</a></div>\';}).catch(function(e) {html=\'<div class=&quot;tips rounded w-full text-white bg-red-500&quot;><div class=&quot; container flex items-center px-6 py-4 mx-auto&quot;> <div><svg viewBox=&quot;0 0 40 40&quot; class=&quot;w-6 h-6 fill-current&quot;> <path d=&quot;M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z&quot;></path> </svg></div><div class=&quot;mx-3&quot;>Github API请求失败，建议您检查网络后刷新页面重试！</div></div></div>\';});"><div class="shadow-md rounded-md border dark:border-gray-700" x-html="html"><div class="py-2 md:py-5 flex justify-center items-center"><div class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900 dark:border-gray-200"></div></div></div></div>',$con);


//bilibili小窗
//$con = preg_replace('#\{bilibili (av|bv)="(.*?)"\}#','<iframe src="https://api.paugram.com/bili?$1=$2" style="height:162px;" class="bg-white shadow-lg border rounded-lg dark:bg-gray-300 dark:border-gray-700"></iframe>',$con);

//复制文本
$con = preg_replace('#\{copy text="(.*?)"(.*?)?\}(.*?){\/copy\}#','<button data-clipboard-action="copy" data-clipboard-text="$1" class="copybtn">$3</button>',$con);


$con = preg_replace_callback('#(<p>)?\{bilibili[" *"](av|bv|hbv|hav)="(.*?)"[" *"]?\}(<\/p>)?#','bilibili',$con);

//折叠
$con = preg_replace_callback('#\{collapse title="(.*?)"( show="(true|false)?")?\}(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)?\{\/collapse\}#','collapse',$con);


//提示标签
$con = preg_replace_callback('#\{tip( type="(.*?)")?( title="(.*?)")?\}([\s\S]*?)\{\/tip\}#','tip',$con);

//tab标签短代码
$con = preg_replace_callback('#(<p>)?\{tabs( selected="(.*?)")?\}(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)?\{\/tabs\}(<\/p>)?#','tabitems',$con);
$con = preg_replace('#\{tabs selected="(.*?)"\}([\s\S]*?)\{\/tabs\}#','<div class="tabs mb-6" x-data="{ tab: \'$1\' }">$2</div>',$con);
//相册排版短代码
$con = preg_replace_callback('#(<p>)?\{photo set="(.*?)"( bili="(.*?)")?\}([\s\S]*?)\{\/photo\}(<\/p>)?#','photo',$con);

//调用站内文章
$con = preg_replace_callback('#(<p>)?\{post cid="(.*?)"\}(<\/p>)?#','post',$con);

//时间轴
$con = preg_replace_callback('#(<p>)?\{timeline}(<p>)?(<br>)?(.*?)(<br>)?(<p>)?\{\/timeline\}(<\/p>)?#','timeline',$con);
//链接模块
$con = preg_replace_callback('#(<p>)?\{link}(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)?\{\/link\}(<\/p>)?#','links',$con);

//影视卡片
$con = preg_replace_callback('#(<p>)?\{video( title="(.*?)")?( pic="(.*?)")?\}(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)?\{\/video\}(<\/p>)?#','video',$con);

//修复奇葩bug
$con=preg_replace('#<div class="media media-16x9(.*?)?"><div class="media media-16x9 mb-5">(.*?)<\/div><\/div>#','<div class="media media-16x9$1">$2</div>', $con);
if($type=='post'){
if(!empty(Helper::options()->tools)&&in_array('postindex', Helper::options()->tools)){
   $con = preg_replace('#(<p>)?\{postindex\}(<\/p>)?#','',$con);
   $con = $con.'{postindex}';
}
   $con = preg_replace_callback('#(<p>)?\{postindex\}(<\/p>)?#','getCatalog',$con); 
}

return $con;
}


function createCatalog($obj) {    //为文章标题添加锚点
    global $catalog;
    global $catalog_count;
    $catalog = array();
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h([1-6])>/i', function($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count ++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);//存储目录信息，内容，登记与数
        return '<h'.$obj[1].$obj[2].'><div id="cl-'.$catalog_count.'" class="h-20 -mt-20 block invisible"></div>'.$obj[3].'</h'.$obj[1].'>';
    }, $obj);
    return $obj;
}
function getCatalog() {    //输出文章目录容器
    global $catalog;
    $index = '';
    if ($catalog) {
        $index = '<ul class="!m-0">'."\n";
        $prev_depth = '';
        $to_depth = 0;
        foreach($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>'."\n";
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                    $index .= '<ul class="!m-0">'."\n";
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i=0; $i<$to_depth2; $i++) {
                            $index .= '</li>'."\n".'</ul>'."\n";
                            $to_depth--;
                        }
                    }
                    $index .= '</li>';
                }
            }
            $index .= '<li class="list-none"><button @click="anchor(\'#cl-'.$catalog_item['count'].'\')" class="text-left block px-8 py-1 hover:bg-slate-100 dark:hover:bg-slate-600/30 line-1" data-no-instant>'.$catalog_item['text'].'</button>';
            $prev_depth = $catalog_item['depth'];
        }
        for ($i=0; $i<=$to_depth; $i++) {
            $index .= '</li>'."\n".'</ul>'."\n";
        }
    $index = '<div id="postindex" class="transition-all max-w-xs absolute inset-y-0 right-0 bg-gray-50 translate-x-full shadow-md dark:bg-gray-800 dark:text-white z-40" x-data="{indexopen:false}" :class="{\'translate-x-full\':!indexopen}">'."\n".'<div id="toc" class="overflow-y-auto h-full">'."\n".'<h3 class="mt-20 mb-5 text-xl font-semibold text-gray-800 dark:text-white px-8">文章目录</h3>'."\n".$index.'</div>'."\n".'<div class="absolute -left-8 inset-y-0 flex items-center"><button @click="indexopen=!indexopen" class="transition-all rounded-full h-16 w-16 bg-white border border-gray-100 dark:border-gray-800 shadow-md dark:bg-gray-800 flex items-center p-2" :class="{\'justify-center\':indexopen}"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-show="!indexopen"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-show="indexopen"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></button></div></div>'."\n";
    }
    return $index;
}


	
//转译避免代码块与短代码嵌套冲突	
function code($m){
$con = str_replace('/','&#47;',$m[2]); 
$con = str_replace('{','&#123;',$con); 
return '<code>'.$con.'</code>';    
}

function btn($m){
    
if(empty($m[6])){$m[6]='red';}  
    
return '<a href="'.$m[4].'" data-ajax="false" class="shortcode inline-block inline-flex mx-1 justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-'.$m[6].'-600 text-base font-medium text-white hover:bg-'.$m[6].'-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-'.$m[6].'-500 sm:w-auto sm:text-sm mb-2" target="_blank"><span class="text-gray-100">'.$m[7].'</span></a>';    
    
}


function timeline($m){
  $con=$m[4];$n=1;
  
  
  $con = preg_replace('#<p><strong>(.*?)<\/strong>(<br>)?(.*?)<\/p>#','<div class="flex relative pb-5"><div class="h-full w-4 absolute inset-0 flex items-center justify-center"><div class="h-full w-1 bg-gray-200 dark:bg-gray-500 pointer-events-none"></div></div><div class="flex-shrink-0 w-4 h-4 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative"></div><div class="flex-grow pl-4"><div class="font-semibold text-base text-gray-900 dark:text-gray-200 mb-1 tracking-wider">$1</div><div>$3</div></div></div>',$con);
  
  $con = preg_replace('#(<p>)?{p}(<br>)?<strong>(.*?)<\/strong>(<br>)?(.*?)(<br>)?{\/p}(<\/p>)?#','<div class="flex relative pb-5"><div class="h-full w-4 absolute inset-0 flex items-center justify-center"><div class="h-full w-1 bg-gray-200 dark:bg-gray-500 pointer-events-none"></div></div><div class="flex-shrink-0 w-4 h-4 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative"></div><div class="flex-grow pl-4"><div class="font-semibold text-base text-gray-900 dark:text-gray-200 mb-1 tracking-wider">$3</div><div>$5</div></div></div>',$con);  
   
    return '<div class="timeline">'.$con.'<div class="flex relative pb-5"><div class="flex-shrink-0 w-4 h-4 rounded-full bg-red-500 inline-flex items-center justify-center text-white relative"></div></div></div>';
}

function bilibili($m){$url=$m[3];
if($m[2]=='hbv'||$m[2]=='hav'){
 return '<div class="bg-white mb-5 p-3 lg:p-4 shadow hover:shadow-md border rounded-md flex py-4 dark:bg-gray-800 dark:border-gray-700" x-data="{ bt:\'标题加载中...\',ms:\'描述加载中...\',pic:\''.theurl.'img/load.gif\',heji:\'\',url:\'\'}" x-init="fetch(\''.api('biliinfo').$m[2].'='.$m[3].'\').then(response => response.json()).then(data=>{var data=data.data.View.ugc_season; bt=data.title;ms=data.intro;pic=\'https://i0.wp.com/\'+data.cover;heji=data.sections[0].episodes;url=\'https://www.bilibili.com/video/\'+heji[0].bvid;})">
  <div class="flex-initial mr-3">
<a :href="url" class="w-24 sm:w-32 xl:w-56 media media-16x9" target="_blank"><img :src="pic" class="media-content shadow-md h-qz-full w-full object-cover rounded-lg nofancybox"></a></div>
 <div class="flex flex-col flex-1"> 
  <div class="flex-initial">
<a :href="url" target="_blank"><span class="text-base lg:text-xl font-semibold font-medium text-gray-700 dark:text-gray-100 line-1" target="_blank" x-text="bt">标题加载中...</span></a>
      <div class="text-sm lg:text-base text-gray-600 mt-1 mb-2 dark:text-gray-200 line-2" x-text="ms">描述加载中...</div>
  </div>
<div x-data="{ collapseopen: false }" class="rounded border border-blue-100 dark:border-gray-700"> <div @click="collapseopen=!collapseopen" class="rounded flex bg-gray-50 justify-between text-sm dark:bg-gray-700 cursor-pointer p-4"><div>视频合集</div><div class="transform duration-300" :class="{\'rotate-180\':collapseopen}"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path></svg></div></div><div class="transition-all max-h-0 py-0 px-4 overflow-y-hidden px-4" :class="{\'max-h-0 py-0 overflow-y-hidden\':!collapseopen,\'overflow-y-auto h-56 pt-2\':collapseopen}"">
<template x-for="(item,i) in heji">
        <a :href="\'https://www.bilibili.com/video/\'+item[\'bvid\']" target="_blank" class="block pb-1 mb-2 hover:text-blue-500 dark:hover:text-blue-400 flex justify-between border-dashed border-b border-gray-700"><span x-text="item[\'title\']"></span><span class="text-xl sui-av hidden lg:inline"></span></a>
</template>
</div></div></div>
</div>'; 
}else{
if($m[2]=='av'){$url='av'.$m[3];}
$url='https://www.bilibili.com/video/'.$url;
 return '<div class="post-item flex shadow-md sm:shadow-lg rounded-md mb-5 sm:mb-8 overflow-hidden p-3.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700" x-data="{bt:\'标题加载中...\',ms:\'描述加载中...\',pic:\''.theurl.'img/load.gif\',tname:\'\',view:\'\',author:\'\'}" x-init="fetch(\''.api('biliinfo').$m[2].'='.$m[3].'\').then(response => response.json()).then(data=>{
bt=data.data.title; tname=data.data.tname; view=data.data.stat.view;author=data.data.owner.name;if(data.data.dynamic){ms=data.data.dynamic;}else{ms=data.data.desc}pic=\'https://i0.wp.com/\'+data.data.pic;})">
<div class="media media-3x2 w-1/3 md:w-1/4 lg:w-1/3" style="max-width: 12.5rem;">
        <a href="'.$url.'" target="_blank" class="media-content rounded-md scrollLoading" :style="\'background-image: url(&quot;\'+pic+\'&quot;)\'"></a>
    </div>
    <div class="flex flex-col w-full text-gray-700 pl-2 sm:pl-3.5 md:pl-4 py-0.5 dark:text-white">
    <div class="flex-1">
    <a href="'.$url.'" target="_blank" class="text-lg xl:text-xl font-semibold line-2" x-text="bt"></a>
     <div class="hidden md:block"><p class="mt-2 text-sm xl:text-base text-gray-500 dark:text-gray-200 line-2" x-text="ms">描述加载中...</p></div>
   </div>
   <div class="flex items-center justify-between w-full text-xs">
      <div class="flex items-center mr-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-2 w-3.5 h-3.5 mr-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0118 18.375M20.625 4.5H3.375m17.25 0c.621 0 1.125.504 1.125 1.125M20.625 4.5h-1.5C18.504 4.5 18 5.004 18 5.625m3.75 0v1.5c0 .621-.504 1.125-1.125 1.125M3.375 4.5c-.621 0-1.125.504-1.125 1.125M3.375 4.5h1.5C5.496 4.5 6 5.004 6 5.625m-3.75 0v1.5c0 .621.504 1.125 1.125 1.125m0 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m1.5-3.75C5.496 8.25 6 7.746 6 7.125v-1.5M4.875 8.25C5.496 8.25 6 8.754 6 9.375v1.5m0-5.25v5.25m0-5.25C6 5.004 6.504 4.5 7.125 4.5h9.75c.621 0 1.125.504 1.125 1.125m1.125 2.625h1.5m-1.5 0A1.125 1.125 0 0118 7.125v-1.5m1.125 2.625c-.621 0-1.125.504-1.125 1.125v1.5m2.625-2.625c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125M18 5.625v5.25M7.125 12h9.75m-9.75 0A1.125 1.125 0 016 10.875M7.125 12C6.504 12 6 12.504 6 13.125m0-2.25C6 11.496 5.496 12 4.875 12M18 10.875c0 .621-.504 1.125-1.125 1.125M18 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m-12 5.25v-5.25m0 5.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-12 0v-1.5c0-.621-.504-1.125-1.125-1.125M18 18.375v-5.25m0 5.25v-1.5c0-.621.504-1.125 1.125-1.125M18 13.125v1.5c0 .621.504 1.125 1.125 1.125M18 13.125c0-.621.504-1.125 1.125-1.125M6 13.125v1.5c0 .621-.504 1.125-1.125 1.125M6 13.125C6 12.504 5.496 12 4.875 12m-1.5 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M19.125 12h1.5m0 0c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h1.5m14.25 0h1.5" />
</svg><span x-text="tname"></span></div>
      <div class="flex items-center">
    <span class="items-center mr-2 hidden sm:flex"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-2 w-3.5 h-3.5 mr-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
</svg>
<span x-text="author"></span></span>
    <span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-2 w-3.5 h-3.5 mr-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path> <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path> </svg><span x-text="view"></span></span>
      </div>
   </div>
 </div>       
          </div>';   
}
}

function post($m){
$cid=$m[2];
$f=Typecho_Widget::widget('Widget_Archive@'.$cid,'pageSize=1&type=post', 'cid='.$cid);
if($f->have()){
if($f->categories){
            foreach ($f->categories as $category) {
                $result[] = $category['name'];
            }
            $cate=implode(' , ', $result);
    }else{$cate='none';}
    
return '<a href="'.$f->permalink.'" data-container="container" class="cursor-pointer post-item flex shadow-md sm:shadow-lg rounded-md mb-5 overflow-hidden p-3.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-left">
<div class="media media-3x2 w-1/3 md:w-1/4 lg:w-1/3" style="max-width: 12.5rem;">
        <div class="media-content rounded-md scrollLoading ojbk" style="background-image: url('.showThumbnail($f,1).');"></div>
    </div>
    <div class="flex flex-col w-full text-gray-700 pl-2 sm:pl-3.5 md:pl-4 py-0.5 dark:text-white">
    <div class="flex-1">
    <div class="text-lg xl:text-xl font-semibold line-2">'.$f->title.'</div>
     <div class="hidden md:block"><div class="mt-2 text-sm xl:text-base text-gray-500 dark:text-gray-200 line-2">'.excerpt($f,150, '...','return').'</div></div>
   </div>
   <div class="flex items-center justify-between w-full text-xs">
      <div class="flex items-center mr-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-2 w-3.5 h-3.5 mr-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"></path></svg>'.$cate.'</div>
      <div class="flex items-center">
    <span class="items-center mr-2 hidden sm:flex">'.date('Y年m月d日' , $f->created).'</span>
    <span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-2 w-3.5 h-3.5 mr-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path> <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path> </svg>'.get_post_view($f,1).'</span>
      </div>
   </div>
 </div></a>';    
}else{
    return '<div class="tips rounded w-full text-white bg-red-500"><div class="container flex items-center px-6 py-4 mx-auto">
<div><svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg></div><div class="mx-3">引用的文章不存在或已被删除</div></div></div>';
}
    
    
}

function collapse($m){$style='p-4';
if(empty($m[3])){$m[3]='false';}
if($m[3]=='false'){$style='max-h-0 py-0 px-4 overflow-y-hidden';}
$con = '<div x-data="{ collapseopen: '.$m[3].' }" class="border border-gray-300 dark:border-gray-700">
    <div @click="collapseopen=!collapseopen"class="flex bg-gray-100 justify-between text-sm dark:bg-gray-700 cursor-pointer p-4"><div>'.$m[1].'</div><div class="transform duration-300" :class="{\'rotate-180\':collapseopen}"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path></svg></div></div><div class="transition-all '.$style.'"
        :class="{\'max-h-0 py-0 px-4 overflow-y-hidden\':!collapseopen,\'p-4\':collapseopen}"
    >'.$m[5].'</div>
</div>';

return $con;
    
}

function tip($m){
$type=$m[2];
$title=$m[4];
$con=$m[5];
if(empty($type)){$type="info";}
if(!empty($title)){$title='<span class="font-semibold text-blue-500 dark:text-blue-400">'.$title.'</span>';}
switch ($type) {
case "info":
   $color="bg-blue-500";$icon='<svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>';
    break;
case "warn":
case "warning":
   $color="bg-yellow-400";$icon='<svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>';
    break;
case "danger":
case "error":
   $color="bg-red-500";$icon='<svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"></path>
                </svg>';
    break;
case "success":
   $color="bg-green-500";$icon='<svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"></path>
                </svg>';
    break;
}

$con='<div class="tips rounded w-full text-white '.$color.'"><div class="container flex items-center px-6 py-4 mx-auto">
<div>'.$icon.'</div><div class="mx-3">'.$con.'</div></div></div>';

return $con;    
}
	

function links($m){
$con = preg_replace('#(<br\s*/?>)?{(.*?),(.*?),<a.*?>(.*?)<\/a>(,)?}(<br\s*/?>)?#','<div class="group lg:flex items-center p-4 bg-white rounded-lg border border-gray-100 text-gray-600 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600  transition-all duration-300 transform shadow hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden"><a href="$4" title="$2" target="_blank" data-ajax="false" rel="noopener" class="flex flex-shrink-0"><img class="w-11 h-11 lg:w-14 lg:h-14 object-cover rounded-full scrollLoading" src="'.api().'$4"></a><div class="w-full mt-2 lg:mt-0 lg:pl-4"><div class="text-base font-medium line-1 transition-all duration-300 transform dark:text-gray-50 group-hover:text-red-500 dark:hover:text-red-500"><a href="$4" target="_blank" data-ajax="false" rel="noopener" title="$2" class="block">$2</a></div><div class="text-xs text-gray-400 line-1 mt-1">$3</div></div><div class="absolute -bottom-10 -right-10 w-32 h-32 lg:w-24 lg:h-24 rounded-full bg-contain opacity-5 duration-300 group-hover:opacity-10"  style="background-image:url('.api().'$4);"></div>
</div>',$m[3]);
$con = preg_replace('#(<br\s*/?>)?{(.*?),(.*?),<a.*?>(.*?)<\/a>,(.*?)}(<br\s*/?>)?#','<div class="group lg:flex items-center p-4 bg-white rounded-lg border border-gray-100 text-gray-600 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600  transition-all duration-300 transform shadow hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden"><a href="$4" title="$2" target="_blank" data-ajax="false" rel="noopener" class="flex flex-shrink-0"><img class="w-11 h-11 lg:w-14 lg:h-14 object-cover rounded-full scrollLoading" 
src="$5"></a><div class="w-full mt-2 lg:mt-0 lg:pl-4"><div class="text-base font-medium line-1 transition-all duration-300 transform dark:text-gray-50 group-hover:text-red-500 dark:hover:text-red-500"><a href="$4" target="_blank" data-ajax="false" rel="noopener" title="$2" class="block">$2</a></div><div class="text-xs text-gray-400 line-1 mt-1">$3</div></div><div class="absolute -bottom-10 -right-10 w-32 h-32 lg:w-24 lg:h-24 rounded-full bg-contain opacity-5 duration-300 group-hover:opacity-10"  style="background-image:url($5);"></div>
</div>',$con);

$con = preg_replace('#(<br\s*/?>)?{(.*?),(.*?),<a.*?>(.*?)<\/a>,<a.*?>(.*?)<\/a>}(<br\s*/?>)?#','<div class="group lg:flex items-center p-4 bg-white rounded-lg border border-gray-100 text-gray-600 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600  transition-all duration-300 transform shadow hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden"><a href="$4" title="$2" target="_blank" data-ajax="false" rel="noopener" class="flex flex-shrink-0"><img class="w-11 h-11 lg:w-14 lg:h-14 object-cover rounded-full scrollLoading" src="$5"></a><div class="w-full mt-2 lg:mt-0 lg:pl-4"><div class="text-base font-medium line-1 transition-all duration-300 transform dark:text-gray-50 group-hover:text-red-500 dark:hover:text-red-500"><a href="$4" target="_blank" data-ajax="false" rel="noopener" title="$2" class="block">$2</a></div><div class="text-xs text-gray-400 line-1 mt-1">$3</div></div><div class="absolute -bottom-10 -right-10 w-32 h-32 lg:w-24 lg:h-24 rounded-full bg-contain opacity-5 duration-300 group-hover:opacity-10"  style="background-image:url($5);"></div>
</div>',$con);

$con='<div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 mb-4">'.$con.'</div>';
return $con;    
    
}

function video($m){
  $title='';$juji='';$info=array();$length=0;$pic=$m[5];
  if(strpos($m[7],'(') !== false){//内部包含小括号则为多线路模式
  $xianlu='';
  $juji = preg_replace_callback('#(<p>)?(<br\s*/?>)?\((.*?)\)(<br\s*/?>)?\{(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)\}(<br\s*/?>)?(<\/p>)?#','xianlu',$m[7]);
  preg_match_all( "/\((.*?)\)/", $m[7], $name);
  foreach ($name[1] as $val){
      $xianlu=$xianlu.'<button class="block" @click="xianlu=\''.$val.'\'">'.$val.'</button>';
  }
  
  
  $juji='<div class="m-2" x-data="{xianlu:\''.$name[1][0].'\',qiehuan:false}"><div class="relative text-sky-500 text-sm text-right mb-2"><button @click="qiehuan=!qiehuan" @click.outside="qiehuan=false"><span class="mr-1">切换线路</span><i class="sui-forward-down"></i></button><template x-if="qiehuan"><div class="absolute mt-1 right-0 p-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700">'.$xianlu.'</div></template></div><div class="overflow-y-auto m-2">'.$juji.'</div></div>';
  $vurl=preg_replace('#(.*?)\{(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)\}(.*?)#','$3',$m[7]);
  $info=qiege($vurl,$pic);$length=count($info);
  $info[0]['jishu']=$name[1][0].$info[0]['jishu'];
  }else{
    if(strpos($m[7],'$') === false){$m[7]='占位$'.$m[7];}
    $info=qiege($m[7],$pic);$length=count($info);
if($length>1){
$k=0;
foreach($info as $ji) {$k++;
$juji=$juji.'<button x-ref="jinum'.$k.'" @click="videourl=\''.$ji['url'].'\';ji=\''.$ji['jishu'].'\';$dispatch(\'createiframe\');" class="shortcode inline-flex mx-1 justify-center px-3.5 py-2 text-sm rounded text-white mb-2" :class="{\'bg-blue-600\':ji==\''.$ji['jishu'].'\',\'bg-gray-600\':ji!=\''.$ji['jishu'].'\'}"><span class="text-gray-100">'.$ji['jishu'].'</span></button>';
}
$juji='<template x-if="videourl">
<div class="overflow-y-auto m-2 max-h-72">'.$juji.'<div x-init="$refs.jinum1.click();" class="hidden"></div></div></template>
';
}
}

$player='<div class="media media-16x9" x-html="html"></div>';

if(!empty($m[3])){
$title=$m[3];  
}
if(!empty($title)){
$title='<h3 class="m-2 text-base font-semibold text-gray-800 border-b-2 border-gray-200 py-2 flex items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" viewBox="0 0 20 20" fill="currentColor"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
</svg>'.$title.'</h3>';
}

if($length>1){
$buju='
<div class="my-4 border dark:border-gray-700 dark:bg-gray-800" x-data="{videourl:\''.$info[0]['url'].'\',ji:\''.$info[0]['jishu'].'\',html:false}"
@createiframe="html=false;
html=\'&lt;iframe src=&quot;\'+videourl+\'&quot; scrolling=&quot;no&quot; border=&quot;0&quot; frameborder=&quot;no&quot; framespacing=&quot;0&quot; allowfullscreen=&quot;true&quot;&gt;&lt;/iframe&gt;\';">
<div>'.$player.'</div>
<div>'.$title.$juji.'</div>
</div>
';
}else{
$buju='
<div class="my-4 border dark:border-gray-700 dark:bg-gray-800" x-data="{videourl:\''.$info[0]['url'].'\',ji:\''.$info[0]['jishu'].'\',html:false}"
@createiframe="html=false;
html=\'&lt;iframe src=&quot;\'+videourl+\'&quot; scrolling=&quot;no&quot; border=&quot;0&quot; frameborder=&quot;no&quot; framespacing=&quot;0&quot; allowfullscreen=&quot;true&quot;&gt;&lt;/iframe&gt;\';">
<div x-init="$dispatch(\'createiframe\');">'.$player.'</div>
<div>'.$title.$juji.'</div>
</div>
';   
    
    
}


    return $buju;
}




function xianlu($m){
   $info=qiege($m[6]);
   $name=$m[3];
   $juji='';
 $k=0;
foreach($info as $ji) {$k++;
$juji=$juji.'<button  x-ref="jinum'.$k.'" @click="videourl=\''.$ji['url'].'\';ji=\''.$name.$ji['jishu'].'\';$dispatch(\'createiframe\');" class="shortcode inline-flex mx-1 justify-center px-3.5 py-2 text-sm rounded text-white mb-2" :class="{\'bg-blue-600\':ji==\''.$name.$ji['jishu'].'\',\'bg-gray-600\':ji!=\''.$name.$ji['jishu'].'\'}"><span class="text-gray-100">'.$ji['jishu'].'</span></button>';
}
$juji='<template x-if="xianlu==\''.$name.'\'"><div>'.$juji.'<div x-init="$refs.jinum1.click();" class="hidden"></div></div></template>';

   return $juji;
}


function qiege($txt,$pic=''){
if(!empty($txt)){
$info=array();
$string_arr = explode("<br>", $txt);
$long=count($string_arr);
for($i=0;$i<$long;$i++){
$jishu=@explode("$",$string_arr[$i])[0];
$url=@explode("$",$string_arr[$i])[1];
$url=preg_replace('/<a(.*?)>(.*?)<\/a>/i', '$2', $url);
if(strpos($url,'www.bilibili.com/video') !== false){//调用哔哩哔哩iframe
    $bv=preg_replace('/(.*?)www.bilibili.com\/video\/(.*?)(\/)?/i', '$2', $url);
    $bv=str_ireplace('/', '', $bv);
    $url='https://www.bilibili.com/blackboard/html5mobileplayer.html?bvid='.$bv.'&page=1&as_wide=1&danmaku=0&hasMuteButton=1';
}elseif(strpos($url,'live.bilibili.com/') !== false){//哔哩哔哩直播
    $bilive=preg_replace('/(.*?)live.bilibili.com\/(.*?)(\/)?/i', '$2', $url);
    $url='//www.bilibili.com/blackboard/live/live-activity-player.html?cid='.$bilive;
}elseif(strpos($url,'www.acfun.cn/v/') !== false){//acfun
    $ac=preg_replace('/(.*?)www.acfun.cn\/v\/(.*?)(\/)?/i', '$2', $url);
    $url='//www.acfun.cn/player/'.$ac;
}elseif(strpos($url,'www.ixigua.com/') !== false){//西瓜视频
    $xg=preg_replace('/(.*?)www.ixigua.com\/(.*?)(\?)?/i', '$2', $url);
    $url='//www.ixigua.com/iframe/'.$xg.'?autoplay=0';
}elseif(strpos($url,'v.qq.com/') !== false){//腾讯视频
    $vid=preg_replace('/(.*?)v.qq.com\/x\/page\/(.*?).html/i', '$2', $url);
    $url='https://v.qq.com/txp/iframe/player.html?vid='.$vid;
}elseif(strpos($url,'v.douyu.com/') !== false){//斗鱼视频不是直播
    $vid=preg_replace('/(.*?)v.douyu.com\/show\/(.*?)(\/)?/i', '$2', $url);
    $url='https://v.douyu.com/video/videoshare/index?vid='.$vid;
}else{//调用内置播放器
    $url=theurl.'lib/player.php?url='.$url.'&pic='.$pic;
}

$info[]=array('jishu'=>$jishu,'url'=>$url);
}
}
return $info;
}

function photo($m){
$bj=explode(",", $m[2]);$size='';
if(empty($bj[1])){$bj[1]=$bj[0];}
if(empty($bj[2])){$bj[2]=$bj[1];}
if(empty($bj[3])){$bj[3]=$bj[2];}
if(!empty($m[3])){
$size=' media-'.$m[4];   
}

$imgs = getImg($m[5]);
$imgtext='';

if(!empty($imgs)){
foreach($imgs as $img) {
$imgurl=$img['url'];//原始图片地址
$houzhui="";
if(isset(Helper::options()->thumbnail)){
    $houzhui=Helper::options()->thumbnail;
    $img['url']=$img['url'].$houzhui;
}
$img['url']= str_replace("sinaimg.cn/large/","sinaimg.cn/mw690/",$img['url']);

$imgtext=$imgtext.'<div class="media'.$size.' p-0"><a data-fancybox="true" href="'.$imgurl.'" class="media-content scrollLoading item" data-ajax="false" style="background-image: url('.$img['url'].');" title="'.$img['title'].'" data-caption="'.$img['title'].'" data-thumb="'.$imgurl.'"></a></div>';

}
}

$con='<div class="grid grid-cols-'.$bj[0].' sm:grid-cols-'.$bj[1].' lg:grid-cols-'.$bj[2].' xl:grid-cols-'.$bj[3].' gap-4 mb-4" data-no-instant>'.$imgtext.'</div>';
return $con;
    
}  
    
function tabitems($m){
$a = '';$b='';$n=1;
	preg_match_all('#\{tab name="(.*?)"\}(<br\s*/?>)?(<\/p>)?([\s\S]*?)(<br\s*/?>)?(<p>)?\{\/tab\}(<br\s*/?>)?#', $m[5], $matches);

if(empty($m[3])){
$c = 1;
}else{
$c = $m[3];   
}


for($i = 0; $i < count($matches[1]); $i++) {
//print_r($matches[1]);  

if($c==$n){
$hidden='';
}else{
$hidden=' x-cloak';    
}

$a=$a.'<button class="tab z-0 flex items-center h-12 px-4 py-2 text-sm text-center text-gray-700  border-gray-300 sm:text-base dark:border-gray-700 focus:outline-none" :class="{ \'bg-transparent border-b dark:text-white whitespace-nowrap cursor-base hover:border-gray-400 dark:hover:border-gray-300\': tab != \''.$n.'\' , \'border border-b-0 rounded-t-md dark:text-white whitespace-nowrap bg-white dark:bg-gray-900\': tab === \''.$n.'\' }" @click="tab = \''.$n.'\'">'.$matches[1][$i].'</button>';
$b = $b.'<div class="z-0 -mt-px p-4 bg-white border border-gray-300 dark:bg-gray-900 dark:border-gray-700" x-show="tab === \''.$n.'\'"'.$hidden.'>'.$matches[4][$i].'</div>';
$n++;
}



return '{tabs selected="'.$c.'"}'.'<div class="flex overflow-x-auto">'.$a.'</div>'.$b.'{/tabs}';
}	

function getImg($obj) {
	preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?alt=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj, $matches);
	$atts = array();
	if(isset($matches[1][0])) {
		for($i = 0; $i < count($matches[1]); $i++) {
			$atts[] = array('name' => ' ['.($i + 1).']', 'url' => $matches[1][$i],'title' => $matches[2][$i]);
		}
    }
	return  count($atts) ? $atts : NULL;
}

function api($type='ico'){
$api['ico']='https://zezeshe.com/api/ico/?url=';
$api['biliinfo']='https://zezeshe.com/api/bili/info.php?';
return $api[$type];
}

?>