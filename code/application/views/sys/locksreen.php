<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录已锁定</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="lock-word animated fadeInDown">
    <span class="first-word"></span><span></span>
</div>
    <div class="middle-box text-center lockscreen animated fadeInDown">
        <div>
            <div class="m-b-md">
            <img alt="image" width="128px" height='128px' class="img-circle circle-border" src="/img/a4.jpg">
            </div>
            <h3>John Smith</h3>            
            <p>您已锁定登录状态,需重新输入密码进入系统.</p>
            <?php echo form_open('/home/userunlocked'); ?>
                <div class="form-group">
                    <input name="pwd" type="password" class="form-control" placeholder="******" required="">
                    <?php echo validation_errors('<p class="text-danger">', '</p>'); ?>
                </div>
                <button type="submit" class="btn btn-primary block full-width">解锁</button>
                <p/>
                <a href="/home/logout">重新登录</a>
            </form>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
