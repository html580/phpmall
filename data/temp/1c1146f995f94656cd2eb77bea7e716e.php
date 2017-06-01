<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:88:"F:\code\php\ypwl-TwoThink-master\TwoThink/application/home/view/default/index\index.html";i:1493988942;s:88:"F:\code\php\ypwl-TwoThink-master\TwoThink/application/home/view/default/base\common.html";i:1493988942;s:85:"F:\code\php\ypwl-TwoThink-master\TwoThink/application/home/view/default/base\var.html";i:1493988942;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo config('WEB_SITE_TITLE'); ?></title>
<link href="__STATIC__/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/docs.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/twothink.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="__STATIC__/bootstrap/js/html5shiv.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.min.js"></script>
<!--<![endif]-->
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader'); ?>
</head>
<body>
	<!-- 头部 -->
	<!-- 导航条
	================================================== -->
	<div class="navbar navbar-inverse navbar-fixed-top">
	    <div class="navbar-inner">
	        <div class="container">
	            <a class="brand" href="<?php echo url('index/index'); ?>">TwoThink</a>
	            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <div class="nav-collapse collapse">
	                <ul class="nav"> 
		                <?php $__NAV__ = \think\Db::name('Channel')->field(true)->where("status=1")->order("sort")->select();if(is_array($__NAV__) || $__NAV__ instanceof \think\Collection || $__NAV__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;if($nav['pid'] == '0'): ?>
		                        <li>
		                            <a href="<?php echo get_nav_url($nav['url']); ?>" target="<?php if($nav['target'] == '1'): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo $nav['title']; ?></a>
		                        </li>
                        	<?php endif; endforeach; endif; else: echo "" ;endif; ?> 
	                </ul>
	            </div>
	            <div class="nav-collapse collapse pull-right">
	                <?php if(is_login()): ?>
	                    <ul class="nav" style="margin-right:0">
	                        <li class="dropdown">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo get_username(); ?> <b class="caret"></b></a>
	                            <ul class="dropdown-menu">
	                                <li><a href="<?php echo url('user/user/profile'); ?>">修改密码</a></li>
	                                <li><a href="<?php echo url('user/login/logout'); ?>">退出</a></li>
	                            </ul>
	                        </li>
	                    </ul>
	                <?php else: ?>
	                    <ul class="nav" style="margin-right:0">
	                        <li>
	                            <a href="<?php echo url('user/login/index'); ?>">登录</a>
	                        </li>
	                        <li>
	                            <a href="<?php echo url('user/user/register'); ?>" style="padding-left:0;padding-right:0">注册</a>
	                        </li>
	                    </ul>
	                <?php endif; ?>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- /头部 -->
	
	<!-- 主体 -->
	
    <header class="jumbotron subhead" id="overview">
        <div class="container">
            <h2>源自相同起点，演绎不同精彩！</h2>
            <p class="lead"></p>
        </div>
    </header>

	<div id="main-container" class="container">
	    <div class="row">
	        
<!-- 左侧 nav
================================================== -->
    <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav">
           <?php echo widget('Category/lists', array(1, true)); ?>
        </ul>
    </div>

	        
    <div class="span9">
        <!-- Contents
        ================================================== -->
        <section id="contents">

            <?php $__CATE__ = model('Category')->getChildrenId(1);$__WHERE__ = model('Document')->listMap($__CATE__);$__LIST__ = \think\Db::name('Document')->where($__WHERE__)->field($field)->order('`level` DESC,`id` DESC')->paginate(10);if($__LIST__){ $__LIST__=$__LIST__->toArray(); $__LIST__=$__LIST__['data'];} if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?>
                <div class="row">
                    <div class="span2 pull-left">
                      <a href="<?php echo url('Article/detail?id='.$article['id']); ?>">
                        <img class="img-responsive" src="__ROOT__<?php echo get_cover_path($article['cover_id']); ?>" />
                      </a>
                    </div>
                    <div class="span7">
                      <h3><a href="<?php echo url('Article/detail?id='.$article['id']); ?>"><?php echo $article['title']; ?></a></h3>
                      <p class="lead"><?php echo $article['description']; ?></p>
                      <span><a href="<?php echo url('Article/detail?id='.$article['id']); ?>">查看全文</a></span>
                      <span class="pull-right">
                          <span class="author"><?php echo get_username($article['uid']); ?></span>
                          <span>于 <?php echo date('Y-m-d H:i',$article['create_time']); ?></span> 发表在 <span>
                          <a href="<?php echo url('Article/lists?category='.get_category_name($article['category_id'])); ?>"><?php echo get_category_title($article['category_id']); ?></a></span> ( 阅读：<?php echo $article['view']; ?> )
                      </span>
                    </div>
                </div>
                <hr/>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </section>
    </div>

	    </div>
	</div>

	<script type="text/javascript">
	    $(function(){
	        $(window).resize(function(){
	            $("#main-container").css("min-height", $(window).height() - 343);
	        }).resize();
	    })
	</script>
	<!-- /主体 -->

	<!-- 底部 -->
	
    <!-- 底部
    ================================================== -->
    <footer class="footer">
      <div class="container">
          <p> 本站由 <strong><a href="http://www.twothink.cn" target="_blank">TwoThink</a></strong> 强力驱动</p>
      </div>
    </footer>

	<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "__ROOT__", //当前网站地址
		"APP"    : "__APP__", //当前项目地址
		"PUBLIC" : "__PUBLIC__", //项目公共目录地址
		"DEEP"   : "<?php echo config('URL_PATHINFO_DEPR'); ?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo config('URL_MODEL'); ?>", "<?php echo config('URL_CASE_INSENSITIVE'); ?>", "<?php echo config('URL_HTML_SUFFIX'); ?>"],
		"VAR"    : ["<?php echo config('VAR_MODULE'); ?>", "<?php echo config('VAR_CONTROLLER'); ?>", "<?php echo config('VAR_ACTION'); ?>"]
	}
})();
</script>
	 <!-- 用于加载js代码 -->
	<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
	<?php echo hook('pageFooter', 'widget'); ?>
	<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
		
	</div>

	<!-- /底部 -->
</body>
</html>
