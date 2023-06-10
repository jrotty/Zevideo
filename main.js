var cookie = {
    
    setjson:function(key,carr,time){
        console.log(carr);
        console.log(this.get(key));
    var newarr={};
    if(this.get(key)!='undefined'){
    newarr=JSON.parse(this.get(key));
    }
    console.log(newarr);
    console.log(carr);
    
    newarr[carr[0]]=carr; 
    console.log(newarr);

    var str=JSON.stringify(newarr);
    console.log(str);
    
    var xnewarr=Object.entries(JSON.parse(str)).reverse();
    
    xnewarr=xnewarr.sort(this.compare); 
    if(xnewarr.length>20){
    xnewarr = xnewarr.slice(0, 20);
    }
    
    const obj = {};
    const arr = xnewarr;
arr.forEach(item => {
  obj[item[0]] = item[1];
});
    str=JSON.stringify(obj); 
        
    this.set(key,str,time);
    },
    
    getjson:function(key,id='false'){
    var xnewarr={};
    if(this.get(key)!='undefined'){
    xnewarr=JSON.parse(this.get(key));
    }
    console.log(xnewarr);
    var newarr=Object.entries(xnewarr).reverse();
    
    newarr=newarr.sort(this.compare); 
    
    
    
    console.log(newarr);
    
    if(id=='false'){
    return newarr; 
    }
    if(xnewarr[id]){
    return xnewarr[id]; 
    console.log(xnewarr);
    }
    return 'null';   
    },
    compare:function (arr1, arr2) {   // arr1和arr2分别为待比较的两个数组
    if (arr1[1][4] < arr2[1][4]) {   // 比较第一个元素的大小
        return 1;   // 如果arr1[0]小于arr2[0]，则返回正数，表示arr2排在arr1前面
    } else if (arr1[1][4] > arr2[1][4]) {
        return -1;   // 如果arr1[0]大于arr2[0]，则返回负数，表示arr1排在arr2前面
    } else {
        return 0;   // 如果arr1[0]等于arr2[0]，则返回0，表示两者顺序不变
    }
    },
    set:function(key,val,time){//设置cookie方法
        var date=new Date(); //获取当前时间
        var expiresDays=time;  //将date设置为n天以后的时间
        date.setTime(date.getTime()+expiresDays*24*3600*1000); //格式化为cookie识别的时间
        document.cookie=key + "=" + escape(val) +";path=/;expires="+date.toGMTString();  //设置cookie
    },
    get:function(key){//获取cookie方法
        /*获取cookie参数*/
        var getCookie = document.cookie.replace(/[ ]/g,"");  //获取cookie，并且将获得的cookie格式化，去掉空格字符
        var arrCookie = getCookie.split(";")  //将获得的cookie以"分号"为标识 将cookie保存到arrCookie的数组中
        var tips;  //声明变量tips
        for(var i=0;i<arrCookie.length;i++){   //使用for循环查找cookie中的tips变量
            var arr=arrCookie[i].split("=");   //将单条cookie用"等号"为标识，将单条cookie保存为arr数组
            if(key==arr[0]){  //匹配变量名称，其中arr[0]是指的cookie名称，如果该条变量为tips则执行判断语句中的赋值操作
                tips=arr[1];   //将cookie的值赋给变量tips
                break;   //终止for循环遍历
            }
        }
        return unescape(tips);
    }
}
//原生js简易提示框
function sinnertip(type, msg) {
    if (document.querySelector(".sinner-tips")) {return;}
    var ico = type ? '<span class="d-block text-green-500 mb-2"><?xml version="1.0" standalone="no"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg t="1553065772988" fill="currentColor" class="w-28 mx-auto" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2922" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><style type="text/css"></style></defs><path d="M666.272 472.288l-175.616 192a31.904 31.904 0 0 1-23.616 10.4h-0.192a32 32 0 0 1-23.68-10.688l-85.728-96a32 32 0 1 1 47.744-42.624l62.144 69.6 151.712-165.888a32 32 0 1 1 47.232 43.2m-154.24-344.32C300.224 128 128 300.32 128 512c0 211.776 172.224 384 384 384 211.68 0 384-172.224 384-384 0-211.68-172.32-384-384-384" p-id="2923"></path></svg></span>' : '<span class="d-block text-red-500 mb-2"><?xml version="1.0" standalone="no"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg t="1553065784656" fill="currentColor" class="w-28 mx-auto" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3053" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><style type="text/css"></style></defs><path d="M544 576a32 32 0 0 1-64 0v-256a32 32 0 0 1 64 0v256z m-32 160a32 32 0 1 1 0-64 32 32 0 0 1 0 64z m0-608C300.256 128 128 300.256 128 512s172.256 384 384 384 384-172.256 384-384S723.744 128 512 128z" p-id="3054"></path></svg></span>';
    var c = type ? 'tips-success' : 'tips-error';
    var html = '<section class="sinner-tips ' + c + ' sitips-open">' +
        '<div class="transform scale-110 fixed inset-0 z-50 flex items-end backdrop-blur-md bg-black/30 sm:items-center sm:justify-center"></div>' +
        '<div class="transform scale-110 fixed top-0 left-0 z-50 flex justify-center justify-items-center items-center w-full h-full border dark:border-gray-600"><div class="tips-body rounded pb-6 max-w-xs bg-gray-50 text-lu dark:text-white dark:bg-gray-600">' +
        '<div class="rounded-t py-2 bg-luhead bg-gray-100 dark:bg-black"><div class="mx-2 text-right"><button class="w-3 h-3 bg-gray-300 rounded-full mx-1 focus:outline-none"></button><button class="w-3 h-3 bg-gray-300 rounded-full mx-1 focus:outline-none"></button><button class="w-3 h-3 bg-gray-300 rounded-full mx-1 focus:outline-none"></button></div></div>' +
        '<div class="text-center px-6"><div class="px-5 dark:text-gray-100 dark:border-gray-400">' + ico + '<div class="text-sm">' + msg + '</div></div></div></div></div></section>';
    document.body.insertAdjacentHTML('beforeend', html);
    setTimeout(function () {
         [].slice.call(document.querySelectorAll('.sinner-tips')).forEach(function (tips) {
        tips.classList.remove('sitips-open');
        tips.classList.add('sitips-close');
        setTimeout(function () {
            tips.classList.remove('sitips-close');
            tips.parentNode.removeChild(tips);
        }, 400);
         });
    }, 800);
}
//原生js多功能提示框
function sinnertips(type, html) {
    var con = html;
    var html = '<section class="sinner-tips sitips-open">' +
        '<div class="transform scale-110 fixed inset-0 z-50 flex items-end backdrop-blur-md bg-black/30 sm:items-center sm:justify-center"></div>' +
        '<div class="fixed top-0 left-0 z-50 flex justify-center items-center w-full h-full"><div class="tips-body overflow-hidden rounded-lg w-96 max-w-' + type + ' bg-gray-50 dark:text-white dark:bg-gray-600">' +
        '<div class="py-1 bg-gray-100 dark:bg-black"><div class="mx-1 text-right"><button class="btn-close-tips p-0.5 bg-red-500 rounded-full mx-1 focus:outline-none"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-white w-4 h-4"> <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd"></path> </svg></button></div></div>' +
        '<div class="text-center"><div class="px-5 py-3 dark:text-gray-100 dark:border-gray-400">' + con + '</div></div>\
			</div></div></section>';
    document.body.insertAdjacentHTML('beforeend', html);
    [].slice.call(document.querySelectorAll('.btn-close-tips')).forEach(function (closebtn) {
        closebtn.onclick = function () {
            var c = this.parentNode.parentNode.parentNode.parentNode.parentNode;
            c.classList.remove('sitips-open');
            c.remove();
        }
    });

}

//图片弹窗
function popups(obj) {
    var img = obj.getAttribute('data-img');
    var title = obj.getAttribute('data-title');
    var desc = obj.getAttribute('data-desc');
    var html = '<div class="text-center"><h6 class="mb-1 mt-2">' + title + '</h6>\
                    <div class="text-muted text-sm mb-2" > '+ desc + ' </div>\
                    <img src="' + img + '" alt="' + title + '" class="w-full h-auto">\
                    </div>'
    sinnertips('xs', html);
}
window.main = {};
//表单序列化
main.serialize = function (form) {
    var res = [],   //存放结果的数组
        current = null, //当前循环内的表单控件
        i,  //表单NodeList的索引
        len, //表单NodeList的长度
        k,  //select遍历索引
        optionLen,  //select遍历索引
        option, //select循环体内option
        optionValue,    //select的value
        form = form;    //用form变量拿到当前的表单，易于辨识

    for (i = 0, len = form.elements.length; i < len; i++) {

        current = form.elements[i];

        //disabled表示字段禁用，需要区分与readonly的区别
        if (current.disabled) continue;

        switch (current.type) {
            //可忽略控件处理
            case "file":    //文件输入类型
            case "submit":  //提交按钮
            case "button":  //一般按钮
            case "image":   //图像形式的提交按钮
            case "reset":   //重置按钮
            case undefined: //未定义
                break;
            //select控件
            case "select-one":
            case "select-multiple":
                if (current.name && current.name.length) {
                    console.log(current)
                    for (k = 0, optionLen = current.options.length; k < optionLen; k++) {
                        option = current.options[k];
                        optionValue = "";
                        if (option.selected) {
                            optionValue = option.hasAttribute('value') ? option.value : option.text
                        }
                        res.push(encodeURIComponent(current.name) + "=" + encodeURIComponent(optionValue));
                    }
                }
                break;

            //单选，复选框
            case "radio":
            case "checkbox":
                //这里有个取巧 的写法，这里的判断是跟下面的default相互对应。
                //如果放在其他地方，则需要额外的判断取值
                if (!current.checked) break;

            default:
                //一般表单控件处理
                if (current.name && current.name.length) {
                    res.push(encodeURIComponent(current.name) + "=" + encodeURIComponent(current.value));
                }
        }
    }
    return res.join("&");
}

//图片懒加载函数封装
function Limg() {

    // 获取所有需要懒加载的图片
    const images = document.querySelectorAll('img[data-xurl]');

    // 创建IntersectionObserver实例
    const callback = entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const image = entry.target;
                const data_src = image.getAttribute('data-xurl');
                image.setAttribute('src', data_src);
                observer.unobserve(image);
                console.log("触发");
                //image.removeAttribute('data-xurl');
            }
        });
    };
    const observer = new IntersectionObserver(callback);
    // 观察所有需要懒加载的图片
    images.forEach(img => {
        observer.observe(img);
    });

}

main.ajaxcomment = function () {
    /*ajax评论*/
    //监听评论表单提交
    [].slice.call(document.querySelectorAll('.comment-form')).forEach(function (commentform) {
        commentform.addEventListener("submit", function (event) {
            event.preventDefault();
            var params = main.serialize(commentform); params += '&themeAction=comment';
            var buttonhtml = document.querySelector('#submit').innerHTML;
            // 解析新评论并附加到评论列表
            var appendComment = function (comment) {
                // 评论列表
                var el = document.querySelector('#comments > .comment-list');
                var pl = " comment-parent";
                if (0 != comment.parent) {
                    pl = " children";
                    // 子评论则重新定位评论列表
                    var el = document.querySelector('#li-comment-' + comment.parent);
                    // 父评论不存在子评论时
                    if (el.querySelectorAll('.comment-list').length < 1) {
                        el.insertAdjacentHTML('beforeend', '<ol class="comment-list"></ol>');
                    }
                    el = document.querySelector('#li-comment-' + comment.parent + ' .comment-list');
                }
                if (!el) {//如果是第一次评论
                    document.querySelector('#comments').insertAdjacentHTML('beforeend', '<ol class="comment-list"></ol>');
                    el = document.querySelector('#comments > .comment-list');
                }
                // 评论html模板，根据具体主题定制
                var html = '<div id="div-comment-' + comment.coid + '" class="comment-body' + pl + ' comment-ajax"><article id="div-comment-' + comment.coid + '" class="flex comment-body my-4 py-md-2"><div class="flex-none mr-1"><img alt="" src="' + comment.avatar + '" class="w-12 rounded-full scrollLoading" height="48" width="48"></div><div class="flex-initial w-full text-sm"><div class="comment-author mb-1"><div class="flex items-center"><a href="' + comment.permalink + '" target="_blank" rel="external nofollow">' + comment.author + '</a>' + comment.sf + '<span class="mx-1"></span></div></div><div class="comment-content px-4 py-2 rounded bg-slate-100 text-gray-900 dark:bg-gray-700 dark:text-gray-100">' + comment.content + '</div><div class="flex items-center comment-meta text-xs text-gray-500 mt-1"><time class="mr-1">刚刚</time><span class="text-muted">' + comment.status + '</span></div></div></article></div>';
                el.insertAdjacentHTML('afterbegin', html);
            };
            // ajax提交评论
            var submit = document.querySelector('#submit');
            submit.setAttribute('disabled', 'disabled');
            submit.innerHTML = '<svg class="animate-spin h-5 w-5 text-white m-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

            fetch(globals.post_url + "?" + params, { method: "POST", }).then(data => data.json()).then(data => {
                if (data.status == 1) {console.log(1);
                    appendComment(data.comment);
                    document.querySelector('#comment').value = '';
                    console.log(2);
                    TypechoComment.cancelReply();
                    sinnertip(1, __.success);console.log(3);
                } else {
                    var tishi = undefined === data.msg ? '评论返回数据异常' : data.msg;
                    sinnertip(0, tishi);
                }

                document.querySelector('#submit').disabled = '';
                document.querySelector('#submit').innerHTML = buttonhtml;
            });

            return false;
        });
    });
}

//文章密码ajax提交
main.password = function () {
    var passwordform = document.querySelector(".protected");
    if (passwordform) {
        passwordform.addEventListener("submit", function (event) {
            document.querySelector(".protected .submit").value = '提交中...';
            event.preventDefault();
            var surl = this.getAttribute('action');
            fetch(surl + '&' + main.serialize(passwordform), { method: "POST", }).then(data => data.text()).then(data => {
                if (data.indexOf('name="protectPassword"') >= 0 || data.indexOf("您输入的密码错误") >= 0) {
                    document.querySelector(".protected .submit").value = '提交';
                    sinnertip(0, "密码错误，请重试！");
                } else {
                    sinnertip(1, "密码正确，请等待页面刷新！");
                    var zhongzhuan = document.createElement("div");
                    zhongzhuan.innerHTML = data;
                    document.querySelector(".post-content").innerHTML = zhongzhuan.querySelectorAll(".post-content")[0].innerHTML;
                }
            });
        });
    }
}




main.windows = function () {
    if (navigator.userAgentData) {
        navigator.userAgentData.getHighEntropyValues(["platformVersion"])
            .then(ua => {
                if (navigator.userAgentData.platform === "Windows") {
                    const majorPlatformVersion = parseInt(ua.platformVersion.split('.')[0]);
                    if (majorPlatformVersion >= 13) {
                        document.cookie = "win11=true;path=/";
                    }
                }
            });
    }
}

main.init = function () {

    //评论表情初始化
    if (document.getElementsByClassName('OwO')[0]) {
        var biaoqingapi = sitedata.theme_url + 'assets/OwO.json?2022';
        if (sitedata.biaoqing.length > 1) { biaoqingapi = sitedata.biaoqing; }
        var OwO_demo = new OwO({
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementsByClassName('OwO-textarea')[0],
            api: biaoqingapi,
            position: 'down',
            width: '66vw',
            maxHeight: '250px'
        });
    }

    //隐私评论交互
    var PrivateComments = document.getElementById("PrivateComments");
    if (PrivateComments) {
        var holder = document.getElementById("comment").getAttribute('placeholder');
        PrivateComments.addEventListener('change', function () {
            if (PrivateComments.checked) {
                document.getElementById("comment").setAttribute("placeholder", "正在隐私评论中...");
            } else {
                document.getElementById("comment").setAttribute("placeholder", holder);
            }
        });
    }

//复制按钮
var clipboard = new ClipboardJS('.copybtn');
clipboard.on('success', function(e) {
sinnertip(1, "复制成功！");
    e.clearSelection();
});
clipboard.on('error', function(e) {
sinnertip(0, "复制失败！");
});

var clipboardurl = new ClipboardJS('.copyurl');
clipboardurl.on('success', function(e) {
sinnertip(1, '文章链接已复制到剪切板');
    e.clearSelection();
});
clipboardurl.on('error', function(e) {
sinnertip(0, "复制失败！");
});



}
main.all = function () {
    main.init();
    main.ajaxcomment();
    main.password();
    main.windows();
    Limg();
};
main.all();