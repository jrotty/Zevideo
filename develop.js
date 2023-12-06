document.addEventListener('alpine:init', () => {
    Alpine.data('data', () => ({
        Copyright:'<span class="text-xs">Copyright © By <a href="https://github.com/jrotty/Zevideo" data-ajax="false" target="_blank">Zevideo</a></span>',
        dark: getThemeFromLocalStorage(1),
        open:'con',
        app:false,
        home:'',
        cate:false,
        tag:false,
        page:false,
        comments:false,
        mode:getComputedStyle(document.documentElement).getPropertyValue('content').replace('"', '').replace('"', ''),
        init() {

        if(location.hash.substring(1)){
            this.open=location.hash.substring(1).replace('&','');
        }
        if (window.matchMedia('(display-mode: standalone)').matches) {
            this.app=true;
        }
        
        fetch(sitedata.url+'?home=1').then(data => data.text()).then(data=>{
            this.home=data;
        });
            
        fetch(sitedata.url+'?cate=1').then(data => data.json()).then(data=>{
            this.cate=data.data;
        });
        fetch(sitedata.url+'?tags=50').then(data => data.json()).then(data=>{
            if(data.status=='200'){this.tag=data.data;}
        });
        fetch(sitedata.url+'?pages=1').then(data => data.json()).then(data=>{
            this.page=data.data;
        });
        fetch(sitedata.url+'?comments=1').then(data => data.json()).then(data=>{
            this.comments=data.data;
        });
            
        },

        
        autoTheme() {
        localStorage.removeItem('theme');
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            this.dark = true;
            document.documentElement.classList.add('dark');document.cookie = "dark=true;path=/";
        } else {
            this.dark = false;
            document.documentElement.classList.remove('dark');document.cookie = "dark=light;path=/";
        }},
        
        anchor(mao) {
            const dom = document.querySelector(mao);
            document.querySelector('.post').scrollTo({
                top: dom.offsetTop,
                behavior: 'smooth',
            });
        },
    }));

    Alpine.store('ze', {
        searchtext: '',
    });
    
    const mediaquery = window.matchMedia('(prefers-color-scheme: dark)');
function getThemeFromLocalStorage(a=0) {
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && mediaquery.matches)) {
    if(a!=1){document.documentElement.classList.add('dark');}
    document.cookie = "dark=true;path=/";return true;//如果cookie有则返回真
} else {
    if(a!=1){document.documentElement.classList.remove('dark');}
    document.cookie = "dark=light;path=/";return false;//如果cookie有则返回真
}
  };

});
