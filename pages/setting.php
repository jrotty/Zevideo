<div class="max-h-full overflow-y-auto break-all scroll-smooth">
<?php $this->need('pages/back.php'); ?>
                                <div class="container mx-auto p-3">
                                    <!-- 主题模式切换 -->
                                    <div x-data="{mode:0}"
                                        x-init="if(localStorage.theme=='dark'){mode=1;}if(localStorage.theme=='light'){mode=2;}"
                                        class="bg-white dark:bg-gray-900 shadow rounded-md p-4 mb-5 dark:text-white">
                                        <h2 class="flex items-center mb-3">
                                            <div
                                                class="bg-gradient-to-r from-blue-500 to-purple-500 w-4 h-2 rounded-md mr-1 duration-300">
                                            </div>模式选择
                                        </h2>
                                        <div class="grid grid-cols-3 gap-2 sm:gap-4 text-sm">
                                            <button @click="autoTheme;mode=0;"
                                                class="w-full p-3 flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-600 rounded-lg"
                                                :class="{'border-2 border-blue-600':mode==0}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                                </svg>
                                                <p class="mt-0.5">跟随系统</p>
                                            </button>
                                            <button
                                                @click="dark=true;mode=1;document.cookie = 'dark=true;path=/';localStorage.theme = 'dark'"
                                                class="w-full p-3 flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-600 rounded-lg"
                                                :class="{'border-2 border-blue-600':mode==1}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                                                </svg>
                                                <p class="mt-0.5">深色模式</p>
                                            </button>
                                            <button
                                                @click="dark=false;mode=2;document.cookie = 'dark=light;path=/';localStorage.theme = 'light'"
                                                class="w-full p-3 flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-600 rounded-lg"
                                                :class="{'border-2 border-blue-600':mode==2}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                                </svg>

                                                <p class="mt-0.5">浅色模式</p>
                                            </button>
                                        </div>
                                    </div>

                                    <div
                                        class="flex flex-col bg-white dark:bg-gray-900 shadow rounded-md p-4 mb-5 dark:text-white">
                                        <h2 class="flex items-center mb-3">
                                            <div
                                                class="bg-gradient-to-r from-blue-500 to-purple-500 w-4 h-2 rounded-md mr-1 duration-300">
                                            </div>登录/登出
                                        </h2>
                                        <?php if($this->user->hasLogin()): ?>
                                        <a href="<?php $this->options->adminUrl(); ?>" class="shadow-sm text-center mt-3 p-3 text-gray-100 bg-teal-500 dark:bg-teal-600 rounded-lg"
                                            target="_blank">进入后台
                                        </a>

                                        <a href="<?php $this->options->logoutUrl(); ?>"
                                            class="shadow-sm text-center mt-3 p-3 text-gray-100 bg-red-500 rounded-lg" nopjax>登出账号
                                        </a>
                                        <?php else: ?>
                                        <a href="<?php if(array_key_exists('TePass', Typecho_Plugin::export()['activated'])){echo tepasssignin;}else{$this->options->adminUrl('login.php');} ?>"
                                            data-ajax="false"
                                            class="shadow-sm text-center mt-3 p-3 text-gray-100 bg-teal-500 dark:bg-teal-600 rounded-lg"
                                            target="_blank">登录
                                        </a>
                                        <?php if($this->options->allowRegister): ?>
                                        <a href="<?php if(array_key_exists('TePass', Typecho_Plugin::export()['activated'])){echo tepasssignup;}else{$this->options->registerUrl();} ?>"
                                            data-ajax="false"
                                            class="shadow-sm text-center mt-3 p-3 text-gray-100 bg-yellow-600 dark:bg-yellow-700 rounded-lg"
                                            target="_blank">注册
                                        </a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        
                                    </div>
                                    
                                </div>
                            </div>
