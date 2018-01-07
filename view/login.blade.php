<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>oracle记事本</title>
    <link rel="icon" href="../public/images/but.ico">
    <link rel="stylesheet" href="../public/css/normalize.css">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <script type="text/javascript" src="../public/js/jquery.min.js"></script>
    <script type="text/javascript" src="../public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public/js/SMValidator.js"></script>
    <style>
        body{
            color: white;
            background-image: url(../public/images/kobe.jpg);
        }
        .container{
            background: rgba(7,17,27,0.8);
        }
        .modal-content{
            background: rgba(7,17,27,0.8);
        }
    </style>
</head>
<body>
<div class="container" style="margin:100px">
    <div class="row">
        <form class="form-horizontal" method="POST" action="../login_check.php">
            <div class="page-header" style="text-align: center">
                <h1>登&nbsp;&nbsp;&nbsp;录</h1>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">邮箱</label>
                <div class="col-sm-6">
                    <input name="u_email" type="text" class="form-control" data-rule="required(输入不能为空)|email" placeholder="请输入邮箱">
                    <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none;"></span>
                    <small class="help-block" style="display: none;"></small>
                    <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none;"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">密码</label>
                <div class="col-sm-6">
                    <input name="u_password" type="password" class="form-control" data-rule="required(输入不能为空)|length(3,11)" placeholder="密码长度4-10位">
                    <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none;"></span>
                    <small class="help-block" style="display: none;"></small>
                    <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none;"></span>
                </div>
            </div>
            <br/>
            <br/>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-4">
                    <button type="submit" class="btn btn-primary">登录</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#register">注册</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: yellow;">&times;</span></button>
                <h4 class="modal-title" id="label" style="text-align: center;">注&nbsp;&nbsp;&nbsp;册</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="../register_check.php">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">用户名</label>
                        <div class="col-sm-6">
                            <input name="r_name" type="text" class="form-control" data-rule="required(输入不能为空)" placeholder="请输入用户名">
                            <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none;"></span>
                            <small class="help-block" style="display: none;"></small>
                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">邮箱</label>
                        <div class="col-sm-6">
                            <input name="r_email" type="text" class="form-control" data-rule="required(输入不能为空)|email" placeholder="请输入邮箱">
                            <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none;"></span>
                            <small class="help-block" style="display: none;"></small>
                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">密码</label>
                        <div class="col-sm-6">
                            <input name="r_password" type="password" class="form-control" data-rule="required(输入不能为空)|length(3,11)" placeholder="长度为3~10位">
                            <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none;"></span>
                            <small class="help-block" style="display: none;"></small>
                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">确认密码</label>
                        <div class="col-sm-6">
                            <input name="rc_password" type="password" class="form-control" data-rule="required(输入不能为空)|equal([name='r_password'])" placeholder="请再次输入">
                            <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none;"></span>
                            <small class="help-block" style="display: none;"></small>
                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary">注册</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    SMValidator.setSkin('bootstrap');
    SMValidator.setLang({
        required:"输入不能为空",
        number:"请输入数字",
        password:"密码不匹配",
        length_scope:"密码长度3~10位",
        email:"邮箱格式不对"
    });
    new SMValidator('form', {
        submit: function(valid, form) {
            if(valid) form.submit();
        }
    });
</script>
</body>
</html>
