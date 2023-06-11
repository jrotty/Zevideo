# Zevideo
Typecho开源视频主题

## 功能介绍
- 全站pjax无刷新加载
- 支持根据系统进入深色模式，或手动切换
- 支持记录播放历史功能
- 首页布局支持自定义
- 主题设置支持修改logo，添加统计代码，这是广告位广告等
- 生态方面支持 https://github.com/jrotty/CatClaw 采集插件可对接大部分资源站`json`接口
- 支持多条件检索（需要购买这个插件 https://blog.zezeshe.com/archives/gjsoso-typecho.html 【历史原因这个插件一直为付费插件，所以不能免费，不需要这个功能则无需购买】）

### 对typecho改动
**1,让文章根据最后编辑时间排序**
在 `Typecho` 的 `var/Widget` 路径下编辑 `Archive.php` 文件，在 `764` 行左右找到如下代码
```php
        $select->order('table.contents.created', Db::SORT_DESC)
            ->page($this->currentPage, $this->parameter->pageSize);
```
将其改为
```php
        $select->order('table.contents.modified', Db::SORT_DESC)
            ->page($this->currentPage, $this->parameter->pageSize);
```
**2,修改数据库结构**
因为是用自定义字段存每集动漫的视频地址的，然而像是柯南这种上千集的，字段数据库表格存不下，所以我将数据库`fields`表`str_value`的类型由text改为了`mediumtext`。
