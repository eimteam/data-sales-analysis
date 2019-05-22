<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $main_title ?></title>       
    <link href="/css/bootstrap.min.css" rel="stylesheet">    
    <!-- 当前视图特有的 css 文件 -->
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">    
    <?php if (isset($load_css)) {
        foreach ($load_css as $value) { ?>
            <link href="<?= $value  ?>" rel="stylesheet">
        <?php }     
    }?>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <?= $main_menu ?>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <?= $main_top ?>
            </div>            
            
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?= $navname ?></h2>
                    <ol class="breadcrumb">                        
                        <li>
                            <a><?= $nav_g_name ?></a>
                        </li>
                        <li class="active">
                            <strong><?= $navname ?></strong>
                        </li>
                    </ol>
                </div>              
            </div>          
            <div class="wrapper wrapper-content animated fadeInRight">
                <?= $contents ?>
            </div>
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
                </div>
            </div>
            
        </div>  
    </div>
    <!-- Mainly scripts -->
    <script src="/js/jquery-3.1.1.min.js"></script>    
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/layui/lay/modules/layer.js"></script>    
    <!-- 通知插件 -->
    <script src="/js/plugins/toastr/toastr.min.js"></script>    
    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
   
    <!-- 当前视图特有的 js 文件 -->
    <?php if (isset($load_js)) {
        foreach ($load_js as $value) { ?>
            <script src="<?= $value  ?>"></script>
        <?php }     
    }?>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Responsive Admin Theme', '欢迎使用');
            }, 2000);
        });
    </script>    
</body>
</html>
