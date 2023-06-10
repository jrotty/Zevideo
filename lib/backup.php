<?php
$name=thename;
$db = Typecho_Db::get();
$sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name));
$ysj = @$sjdq['value'];
if(isset($_POST['type']))
{ 
if($_POST["type"]=="备份模板设置数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:'.$name.'bf');
$updateRows= $db->query($update);
echo '<div class="tongzhi home">备份已更新，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
if($ysj){
     $insert = $db->insert('table.options')
    ->rows(array('name' => 'theme:'.$name.'bf','user' => '0','value' => $ysj));
     $insertId = $db->query($insert);
echo '<div class="tongzhi home">备份完成，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}
}
        }
if($_POST["type"]=="还原模板设置数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$sjdub=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'));
$bsj = $sjdub['value'];
$update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:'.$name);
$updateRows= $db->query($update);
echo '<div class="tongzhi home">检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
<?php
}else{
echo '<div class="tongzhi home">没有模板备份数据，恢复不了哦！</div>';
}
}
if($_POST["type"]=="删除备份数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$delete = $db->delete('table.options')->where ('name = ?', 'theme:'.$name.'bf');
$deletedRows = $db->query($delete);
echo '<div class="tongzhi home">删除成功，请等待自动刷新，如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
echo '<div class="tongzhi home">不用删了！备份不存在！！！</div>';
}
}
    }
if(isset($_POST["uploadpic"])&&$_POST["uploadpic"]=="上传"){
$result = array();   
                    $file = $_FILES['up'];
                    $path = '../sinnerimages/';
                    //创建上传目录
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }

foreach ($file['error'] as $key => $error){  //遍历处理文件
  if ( $error == UPLOAD_ERR_OK ) {
      if($key==0){$name="logo";}
      if($key==1){$name="logo-dark";}
      if($key==2){$name="tb";}
      if($key==3){$name="wx";}
      if($key==4){$name="icon";}
          
if($file["type"][$key]=='image/svg+xml'){
  $name = $name.'.svg';  
}elseif($file["type"][$key]=='image/png'){
  $name = $name.'.png';  
}elseif($file["type"][$key]=='image/jpeg'){
  $name = $name.'.jpg';  
}elseif($file["type"][$key]=='image/gif'){
  $name = $name.'.gif';  
}else{
echo '图片格式不正确，可能前台无法正常显示！'.$file["type"][$key];
$name = $name.'.png';
}
if(refilex('logo')&&$key==0&&!empty($file['name'])){unlink(refilex('logo'));}
if(refilex('logo-dark')&&$key==1&&!empty($file['name'])){unlink(refilex('logo-dark'));}
if(refilex('tb')&&$key==2&&!empty($file['name'])){unlink(refilex('tb'));}
if(refilex('wx')&&$key==3&&!empty($file['name'])){unlink(refilex('wx'));}
if(refilex('icon')&&$key==4&&!empty($file['name'])){unlink(refilex('icon'));}  

if(!move_uploaded_file($_FILES["up"]["tmp_name"][$key], $path.'/'.$name)){
    echo "上传故障，请检查网站根目录下是否存在sinnerimages文件夹，若不存在请手动建立，然后在检查改文件夹权限是否为777，用户组是否为www，如不是请手动修改下！";
}else{
  
    
    
}
$result[0]['status']=201;
$result[0]['url']= Helper::options()->rootUrl.'/sinnerimages/'.$name;
//echo json_encode($result);//把上传成功的文件名称加入数组
  }

}

?>   
<div class="tongzhi home">上传成功，请等待自动刷新，如果等不到请点击<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
<?php

}
echo '<form class="protected setc" action="?'.$name.'bf" method="post">
<input type="submit" name="type" class="btn btn-s" value="备份模板设置数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="还原模板设置数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="删除备份数据" /></form>';


?>