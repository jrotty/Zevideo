<?php

if($archive->request->get('home')){
    $archive->need('pages/home.php');
    exit;
}

if($archive->request->api){
    $pagesize=$archive->request->filter('int')->pagesize ?? 10;//每页文章数量
    $p=$archive->request->filter('int')->page ?? 1;
    $select=$db->select('cid')->from('table.contents')
                ->where('table.contents.status = ?','publish')
                ->where('table.contents.password IS NULL')
                ->where('table.contents.type = ?', 'post');
    if($archive->request->api=='new'){ 
        $select=$select->order('table.contents.created', Typecho_Db::SORT_DESC);
            
        $sticky_cid  = Helper::options()->sticky_cids;
        $sticky_cids = $sticky_cid ? explode(',', strtr($sticky_cid, ' ', ',')) : '';
        //if ($sticky_cids){
        //foreach($sticky_cids as $cid) {
        //$select = $select->where('table.contents.cid != ?', $cid)->group('cid'); // 使文章不重覆
        //}
        //}
        
    }elseif($archive->request->api=='hot'){
    $select=$select->order('table.contents.commentsNum', Typecho_Db::SORT_DESC);
    }elseif($archive->request->api=='views'){
    $select=$select->order('table.contents.views', Typecho_Db::SORT_DESC);
    } 
    $allpage=ceil(count($db->fetchAll($select))/$pagesize);

    $select=$db->fetchAll($select->page($p,$pagesize));//分页
    
    $lon=count($select);
    $a=false;
     if ($sticky_cids&&$p==1){
        foreach($sticky_cids as $cid) {
        $ji=Helper::widgetById('Contents', $cid);
     $a[] = array( 
                    "cid" => $ji->cid,
                    "title" => $ji->title,
                    "url" => $ji->permalink,
                    "date"=>date('Y年m月d日',$ji->created),
                    "img" => showThumbnail($ji,'1','1'),
                ); 
        }
        }
    
    for($ii=0;$ii<$lon;$ii++){
     $ji=Helper::widgetById('Contents', $select[$ii]['cid']);
     $catename='无分类';
     if(!empty($ji->categories)){
     $catename=$ji->categories[0]['name'];
     }
     $b[] = array( 
                    "cid" => $ji->cid,
                    "title" => $ji->title,
                    "url" => $ji->permalink,
                    "date"=>date('Y年m月d日',$ji->created),
                    "description" => excerpt($ji,'150','...','return'),
                    "category"=>$catename,
                    "img" => showThumbnail($ji,'1','1'),
                );   
    }  
    $items['items'] = array(
                'status' => '200',
                'currentPage' => $p,
                'pageCount' => $allpage,
                "sticky" => $a,
                'page' => $p,
                'data' => $b
            );
    $archive->response->throwJson($items);
    }

    if($archive->request->cate){
 \Widget\Metas\Category\Rows::alloc()->to($pages); 
 while ($pages->next()){
    $cate[] = array(
        "mid" => $pages->mid,
        "name" => $pages->name,
        "url" => $pages->permalink,
        "description" => $pages->description,
        "count" => $pages->count,
    );
 }
 $archive->response->throwJson(array(
    'status' => '200',
    'data' => $cate
));  
    }

    if($archive->request->tags){
        $num=$archive->request->filter('int')->tags ?? 30;
        \Widget\Metas\Tag\Cloud::alloc('ignoreZeroCount=1&desc=1&limit='.$num)->to($pages);
        if($pages->have()){
        while ($pages->next()){
           $page[] = array(
        "mid" => $pages->mid,
        "name" => $pages->name,
        "url" => $pages->permalink,
           );
        }
        $archive->response->throwJson(array(
           'status' => '200',
           'data' => $page
       )); 
        }else{
        $archive->response->throwJson(array(
            'status' => '404',
        )); 
        }
           }


    if($archive->request->pages){
        \Widget\Contents\Page\Rows::alloc()->to($pages); 
        while ($pages->next()){
        //if($pages->template!='bizhi.php'){}
           $page[] = array(
               "cid" => $pages->cid,
               "title" => $pages->title,
               "url" => $pages->permalink,
               "description" => $pages->description,
               "template" =>$pages->template,
           );
        }
        $archive->response->throwJson(array(
           'status' => '200',
           'data' => $page
       ));  
           }

    if($archive->request->comments){
        \Widget\Comments\Recent::alloc('pageSize=18&ignoreAuthor=true&parentId=')->to($pages); 
        while ($pages->next()){
            $a=str_replace('#comment-'.$pages->coid, '', $pages->permalink);
            $text=parseBiaoQing($pages->text);
             if(strpos($text,'$私密$') !== false){
             $text='该评论为私密评论，仅文章作者与评论发起者可见！';
             }
           $page[] = array(
               "coid" => $pages->coid,
               "author"=>$pages->author,
               "date"=>timesince($pages->created),
               "text" => $text,
               "url" => $a,
               "k"=>commenttx($pages->mail,$pages->coid),
               "tx"=>letter_avatar($pages->author),
           );
        }
        $archive->response->throwJson(array(
           'status' => '200',
           'data' => $page
       ));  
           }


    if($archive->request->attachment){
        $select = $db->select()->from('table.contents')->where('table.contents.type = ?', 'attachment');
        /** 提交查询 */
        $select=$db->fetchAll($select->order('table.contents.created', Typecho_Db::SORT_DESC)
            ->page(1, 30));
        $lon=count($select);
        //print_r($select);
        if($lon>0){
        for($i=0;$i<$lon;$i++){
        $info=unserialize($select[$i]['text']);
            
        $b[] = array(
               "title" => $select[$i]['title'],
               "date"=>date('Y/m/d',$select[$i]['created']),
               'mime'=>$info['mime'],
               'type'=>$info['type'],
               'size'=>$info['size'],
               );
        }

        $archive->response->throwJson(array(
           'status' => '200',
           'data' => $b,
       ));  
    }else{
        $archive->response->throwJson(array(
            'status' => '404',
        )); 
    }
           }


?>