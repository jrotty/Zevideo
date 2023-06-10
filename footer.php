<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>
<?php if(!$this->request->isAjax()): ?>
                        <div id="cate" class="page content out" data-title="分类" x-show="open=='cate'" x-transition x-cloak>
                            <?php $this->need('pages/cate.php'); ?>
                        </div>
                        <div id="page" class="page content out" data-title="页面" x-show="open=='page'" x-transition x-cloak>
                            <?php $this->need('pages/pages.php'); ?>
                        </div>
                        <div id="history" class="page content out" data-title="历史" x-show="open=='history'" x-transition x-cloak>
                            <?php $this->need('pages/history.php'); ?>
                        </div>

                        <div id="searchpage" class="page content out" data-title="检索" x-show="open=='searchpage'" x-transition x-cloak>
                            <?php $this->need('pages/search.php'); ?>
                        </div>

                        <div id="setting" class="page content out" data-title="设置" x-show="open=='setting'" x-transition x-cloak>
                            <?php $this->need('pages/setting.php'); ?>
                        </div>
                        <!--pages -->
<?php endif; ?>
                    </div>
                </div>

</div>



    </main>
<?php if(!$this->request->isAjax()): ?>
    <script src="https://cdn.staticfile.org/pjax/0.2.8/pjax.min.js"></script>
    <script src="<?php $this->options->themeUrl('assets/OwO.min.js?2023'); ?>"></script>
    <script src="https://cdn.staticfile.org/alpinejs/3.12.0/cdn.min.js" defer></script>
    <script src="https://cdn.staticfile.org/clipboard.js/2.0.10/clipboard.min.js"></script>
    <script src="<?php $this->options->themeUrl('main.js?2023512'); ?>"></script>
    <script src="<?php $this->options->themeUrl('develop.js?202306'); ?>"></script>
    <script>
var pjax = new Pjax({
  elements: 'a[href]:not([target="_blank"]):not([nopjax]),form[data-ajax]',
  selectors: ["title",".the-content"],
  cacheBust: false,//是否显示时间戳
})

// 开始 PJAX 执行的函数
document.addEventListener('pjax:send', function (){
    document.querySelector('#openx').click();//主屏显示
    document.querySelector("loader").classList.add("active");
});

// PJAX 完成之后执行的函数，可以和上面的重载放在一起
document.addEventListener('pjax:complete', function (){
    setTimeout(function() {//让子弹飞一会
        document.querySelector('#open').click();//主屏显示
        Alpine.store('ze').searchtext='';//搜索词清空
        document.querySelector("loader").classList.remove("active");
    }, 20);

    main.all();
});
</script>
<?php endif; ?>
    <?php $this->footer(); ?>
    </body>

    </html>