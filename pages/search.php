<div class="flex w-full h-full flex-col">
<?php $this->need('pages/back.php'); ?>
                                <form id="search" data-ajax="true" class="search sticky z-10 top-0 w-full p-3" method="get"
                                    action="<?php $this->options->siteUrl(); ?>" role="search">
                                    <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                                    <input type="text" name="s"
                                        class="shadow-lg w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded py-2 px-1.5 text-base text" x-model="$store.ze.searchtext"
                                        placeholder="<?php _e('输入关键字搜索'); ?>" required/>
                                </form>
                                
<?php if (!empty(Helper::options()->tools) && in_array('soso',Helper::options()->tools)): ?>
<?php $this->need('gjsearch.php'); ?>
<?php endif; ?>
</div>