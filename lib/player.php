<?php
if(isset($_GET['url'])&&!empty($_GET['url'])){
    
$url=$_GET['url'];
//$url=str_ireplace('http://', 'https://',$url);
?>
<!doctype html>
<html lang="zh-CN">
<head>
<title><?php if(!empty($_GET['title'])){echo urldecode($_GET['title']);}else{echo 'Plyr播放器';}?></title>

<meta name="referrer" content="never">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link href="https://lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/plyr/3.6.12/plyr.min.css" type="text/css" rel="stylesheet" />
<script src="https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/hls.js/1.1.5-0.canary.8255/hls.min.js"></script>
<script src="https://lf9-cdn-tos.bytecdntp.com/cdn/expire-1-M/plyr/3.6.12/plyr.min.js" type="application/javascript"></script>
</head>
<style>
body,html{width:100%;height:100%;background:#000;padding:0;margin:0;overflow-x:hidden;}
*{margin:0;border:0;padding:0;text-decoration:none}
video {
width: 100%;
height: 100%;
}
<?php if(isset($_GET['pic'])&&!isset($_GET['bg'])): ?>
.plyr__poster {
    background-size: cover;
    filter: blur(6px);
    -webkit-filter: blur(6px);
    scale: 1.1;
}
<?php endif; ?>
</style>


<body>

    
<?php if(strpos($url,'www.youtube.com/') !== false): ?>
<?php 
$v=preg_replace('/(.*?)watch\?v\=(.*?)(\/)?/i', '$2', $url);
?>
<div id="player" data-plyr-provider="youtube" data-plyr-embed-id="<?php echo $v; ?>"></div>
<?php else: ?>
<video id="player" playsinline controls data-poster="<?php if(isset($_GET['pic'])){echo $_GET['pic'];}else{echo 'https://ae02.alicdn.com/kf/Hae3544136d6f4bf9aafc7a5993e2ece6C.jpg';} ?>" data-plyr-config='{ "ratio": "16:9" }'>
  <source src="<?php echo $url; ?>" type="video/mp4" />
</video>
<?php endif; ?>





<script>
document.addEventListener('DOMContentLoaded', () => {
     let video = document.getElementById('player');
     const player = new Plyr(video,{
      i18n: {
        speed: '速度',
        normal: '正常',
      },
      resetOnEnd: true,
      <?php if(isset($_GET['bg'])): ?>
      autoplay:true,
      muted:true,
      controls:true,
      loop:{
          active: true,
      },
      <?php endif; ?>
      enabled: !/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent),
     });
     
  <?php if(strpos($url,'.m3u8')!==false):?> 
    const source='<?php echo $url; ?>';
     if (!Hls.isSupported()) {
		video.src = source;
     } else {
		// For more Hls.js options, see https://github.com/dailymotion/hls.js
		const hls = new Hls();
		hls.loadSource(source);
		hls.attachMedia(video);
		window.hls = hls;
		
		// Handle changing captions
		player.on('languagechange', () => {
			// Caption support is still flaky. See: https://github.com/sampotts/plyr/issues/994
			setTimeout(() => hls.subtitleTrack = player.currentTrack, 50);
		});
     }

     <?php endif; ?>
     
     window.player = player;
});
  </script>

</body>

</html>

<?php } ?>