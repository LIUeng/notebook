<?php
    header("Content-Type: text/html; charset=utf-8");
    session_start();
    if(!isset($_SESSION['user_name'])){
        header("Location:../login.blade.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>oracle记事本</title>
    <link rel="icon" href="../public/images/but.ico">
    <script type="text/javascript" src="../public/js/jquery.min.js"></script>
    <script type="text/javascript" src="../public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public/js/vue.min.js"></script>
    <link rel="stylesheet" href="../public/css/normalize.css">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">

    <style>
        [v-cloak] {
            display: none;
        }
        #logo{
            width: 150px;
            height: 20px;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">
                    <img src="../public/images/logo.png" id="logo">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
                <ul class="nav navbar-nav">
                    <li class="active"><a href=""><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>&nbsp;主页</a></li>
                    <li><a href="javascript:void(0)" @click="personal_setting(name='<?php echo $_SESSION['user_name']?>')"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;个人设置</a></li>
                    <li><a href="javascript:void(0)" @click="notebook_manager()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;记事本管理</a></li>
                    <li><a href="javascript:void(0)" @click="user()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;用户管理</a></li>
                    <li><a href="javascript:void(0)" @click="notice()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;发布公告</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.blade.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo $_SESSION['user_name']?>退出</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div id="show_notice" v-show="isShowNotice">
            <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
            &nbsp;&nbsp;&nbsp;公告&nbsp;&nbsp;&nbsp;
            <span v-for="(nw,index) in new_notice" style="color: red;" v-cloak>
               {{nw}}
            </span>

        </div>
        <br/>
        <div id="edit" v-show="isEdit">
            <div class="edit">
                <form action="" class="form" method="post">
                    <div class="form-group">
                        <label>
                            <span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;标题
                        </label>
                        <input id="e_title" type="text" class="form-control" placeholder="请输入标题">
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="text">
                            <span class="glyphicon glyphicon-music"></span>&nbsp;&nbsp;&nbsp;记录你的日记
                        </label>
                        <textarea id="e_text" class="form-control" name="text" rows="5"></textarea>
                    </div>
                    <div class="form-group text-right float-right">
                        <input type="button" class="btn btn-success btn-block" @click="insert_notebook()" value="记录">
                    </div>
                </form>
            </div>
        </div>
        <br/>
        <div id="list" v-show="isList">
            <div>
                <span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;&nbsp;一共有299条记录
            </div>
            <br/>
            <div class="media" v-for="(not,index) in users.t" v-cloak>
                <div class="media-left">
                    <a href="#">
                        <img width="32px" height="32px" class="img-circle" src="../public/images/kobe.jpg" alt="加载出错">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{not.N_TITLE}}</h4>
                    {{not.N_TEXT}}
                </div>
            </div>
        </div>
        <div id="personal_setting" v-show="isPersonal">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">个人中心</div>
                        <div class="panel-body">
                            <br/>
                            <br/>
                            <br/>
                            <ul class="list-group text-center" v-for="(ad,index) in g_admin" v-cloak>
                                <li class="list-group-item list-group-item-success">ID&nbsp;&nbsp;&nbsp;{{ad.USER_ID}}</li>
                                <br/>
                                <li class="list-group-item list-group-item-info">用户名&nbsp;&nbsp;&nbsp;{{ad.USER_NAME}}</li>
                                <br/>
                                <li class="list-group-item list-group-item-warning">邮箱&nbsp;&nbsp;&nbsp;{{ad.USER_EMAIL}}</li>
                                <br/>
                                <li class="list-group-item list-group-item-danger">性别&nbsp;&nbsp;&nbsp;{{ad.USER_GENDER}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="note_book_manager" v-show="isNotebook">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">记事本管理</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" action="" method="POST">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="text-center">
                                            <td>ID</td>
                                            <td>标题</td>
                                            <td>内容</td>
                                            <td>时间</td>
                                            <td>操作</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="text-center" v-for="(notebook,index) in users.t" v-cloak>
                                            <td>{{notebook.NOTEBOOK_ID}}</td>
                                            <td>{{notebook.N_TITLE}}</td>
                                            <td>{{notebook.N_TEXT}}</td>
                                            <td>{{notebook.CREATE_TIME}}</td>
                                            <td class="text-center">
                                                <a class="label label-info" href="javascript:void(0)" @click="select_notebook_by_id(notebook.NOTEBOOK_ID)">编辑</a>
                                                <a class="label label-danger" data-toggle="modal" data-target="#d_n" href="javascript:void(0)" @click="n_id=notebook.NOTEBOOK_ID">删除</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-show="select_notebook.length!=0" v-for="(sn,index) in select_notebook" v-cloak>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">记事本修改设置</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="">
                                <div class="form-group">
                                    <label for="id" class="col-md-4 control-label">ID</label>
                                    <div class="col-md-6">
                                        <input id="n_id" type="text" name="notebook_id" class="form-control" :value="sn.NOTEBOOK_ID" disabled="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">标题</label>
                                    <div class="col-md-6">
                                        <input id="n_title" :value="sn.N_TITLE" type="text" name="notebook_title" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">内容</label>
                                    <div class="col-md-6">
                                        <textarea id="n_text" :value="sn.N_TEXT" class="form-control" name="text" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="button" class="btn btn-primary btn-saveMe" @click="upd_notebook(sn.NOTEBOOK_ID)">更新</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="user" v-show="isUser">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">用户管理</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" action="" method="POST">
                                <div class="table-responsive">
                                    <table class="table table-bordered tb-bg ">
                                        <thead>
                                        <tr class="text-center">
                                            <td>ID</td>
                                            <td>用户名</td>
                                            <td>邮箱</td>
                                            <td>性别</td>
                                            <td>时间</td>
                                            <td>操作</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="text-center" v-for="(user,index) in users.u" v-cloak>
                                            <td>{{user.USER_ID}}</td>
                                            <td>{{user.USER_NAME}}</td>
                                            <td>{{user.USER_EMAIL}}</td>
                                            <td>{{user.USER_GENDER}}</td>
                                            <td>{{user.CREATE_TIME}}</td>
                                            <td class="text-center">
                                                <a class="label label-info" href="javascript:void(0)" @click="select_user_by_id(user.USER_ID)">编辑</a>
                                                <a class="label label-danger" @click="now_id=user.USER_ID" href="javascript:void(0)" data-toggle="modal" data-target="#e">删除</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-show="select_user.length!=0" v-for="(se,index) in select_user" v-cloak>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">个人修改设置</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="">
                                <div class="form-group">
                                    <label for="id" class="col-md-4 control-label">ID</label>
                                    <div class="col-md-6">
                                        <input id="id" type="text" name="user_id" class="form-control" :value="se.USER_ID" disabled="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">用户名</label>
                                    <div class="col-md-6">
                                        <input id="name" :value="se.USER_NAME" type="text" name="user_name" class="form-control" disabled="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">邮箱</label>
                                    <div class="col-md-6">
                                        <input id="hello" :value="se.USER_EMAIL" type="email" class="form-control" name="user_email" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">性别</label>
                                    <div class="col-md-6">
                                        <label class="radio-inline">
                                            <input type="radio" value="女" name="user_gender" checked="checked" disabled>女
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" value="男" name="user_gender" disabled>男
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="button" class="btn btn-primary btn-saveMe" @click="upd(se.USER_ID)">更新</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div v-cl>
        </div>
        <div id="notice" v-show="isNotice">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">发布公告</div>
                        <div class="panel-body">
                            <form class="form-horizontal" id="NoticeForm" role="form" action="" method="POST">
                                <div class="form-group">
                                    <label class="col-md-1 control-label" for="title">标题</label>
                                    <div class="col-md-11">
                                        <input name="title" class="form-control" id="t_title" type="text" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1 control-label" for="noticeText">内容</label>
                                    <div class="col-md-11">
                                        <textarea name="text" class="form-control col-md-6" id="t_text" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-11 col-md-offset-1">
                                        <br>
                                        <button class="btn btn-primary btn_send" type="button" @click="insert_notice()">发布</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;&nbsp;一共有299条公告
            </div>
            <br/>
            <div class="media" v-for="(t,index) in users.n" v-cloak>
                <div class="media-left">
                    <a href="#">
                        <img width="32px" height="32px" class="img-circle" src="../public/images/kobe.jpg" alt="加载出错">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{t.TITLE}}</h4>
                    {{t.TEXT}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="e" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="mySmallModalLabel">删除功能</h4>
                </div>
                <div class="modal-body">
                    确定删除吗！！？？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="dte(now_id)">删除</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="d_n" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="mySmallModalLabel">删除功能</h4>
                </div>
                <div class="modal-body">
                    确定删除吗！！？？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="dte_notebook(n_id)">删除</button>
                </div>
            </div>
        </div>
    </div>
    <div class="" id="success" style="display:none;position: fixed;top: 100px;left: 400px;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body" style="color: red;">
                    删除成功
                </div>
            </div>
        </div>
    </div>
    <div class="" id="update" style="display:none;position: fixed;top: 100px;left: 400px;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body" style="color: red;">
                    更新成功
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el:'#app',
        data:{
            isEdit:true,
            isList:true,
            isPersonal:false,
            isNotebook:false,
            isUser:false,
            isNotice:false,
            isShowNotice:true,
            users:[],
            select_user:[],
            notebook:[],
            select_notebook:[],
            new_notice:[],
            g_admin:[]
        },
        created:function(){
            this.getAllUsers();
            this.select_notice_new_one();
        },
        methods:{
            personal_setting:function(name){
                this.isEdit=false;
                this.isList=false;
                this.isNotebook=false;
                this.isUser=false;
                this.isNotice=false;
                this.isPersonal=true;
                var _this=this;
                $.ajax({
                    url:'../get_admin.php',
                    data:{user_name:name},
                    dataType:'json',
                    success:function(data){
                        _this.g_admin=data;
                    },
                    error:function(error){
                        console.log("hello error");
                    }
                });
            },
            notebook_manager:function(){
                this.isEdit=false;
                this.isList=false;
                this.isPersonal=false;
                this.isUser=false;
                this.isNotice=false;
                this.isNotebook=true;
            },
            user:function(){
                this.isEdit=false;
                this.isList=false;
                this.isNotebook=false;
                this.isPersonal=false;
                this.isNotice=false;
                this.isUser=true;
            },
            notice:function(){
                this.isEdit=false;
                this.isList=false;
                this.isNotebook=false;
                this.isPersonal=false;
                this.isUser=false;
                this.isShowNotice=false;
                this.isNotice=true;
            },
            getAllUsers:function(){
                var _this=this;
                $.ajax({
                   url:'../us_no_nt.php',
                   dataType:'json',
                   success:function(data){
                       _this.users=data;
                       console.log(_this.users);
                   },
                   error:function(error){
                       console.log(error);
                   }
                });
            },
            dte:function(now_id){
                var _this=this;
                $.ajax({
                    url:'../delete_user.php',
                    data:{id:now_id},
                    dataType:'json',
                    success:function(data){
                        if(data==1){
                            _this.getAllUsers();
                            $('#success').css("display","block");
                            setTimeout(function(){
                                $('#success').css("display","none");
                            },3000);
                        }
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            },
            upd:function(user_id){
                var hello=$('#hello').val();
                var _this=this;
                $.ajax({
                    url:'../update_user.php',
                    data:{id:user_id,hello:hello},
                    type:'post',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        if(data==1){
                            _this.getAllUsers();
                            $('#update').css("display","block");
                            setTimeout(function(){
                                $('#update').css("display","none");
                            },3000);
                        }
                    },
                    error:function(error){
                        console.log("hello error");
                    }
                });
            },
            select_user_by_id:function(se_id){
                var _this=this;
                $.ajax({
                    url:'../select_user_by_id.php',
                    dataType:'json',
                    data:{id:se_id},
                    success:function(data){
                        _this.select_user=data;
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            },
            insert_notebook:function(){
                var e_title=$('#e_title').val();
                var e_text=$('#e_text').val();
                var _this=this;
                $.ajax({
                    url:'../insert_notebook.php',
                    data:{title:e_title,text:e_text},
                    type:'post',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        if(data==1){
                            _this.getAllUsers();
                            $('#update').css("display","block");
                            setTimeout(function(){
                                $('#update').css("display","none");
                            },3000);
                        }
                    },
                    error:function(error){
                        console.log("hello error");
                    }
                });
                $('#e_title').val("");
                $('#e_text').val("");
            },
            dte_notebook:function(n_id){
                var _this=this;
                $.ajax({
                    url:'../delete_notebook.php',
                    data:{id:n_id},
                    dataType:'json',
                    success:function(data){
                        if(data==1){
                            _this.getAllUsers();
                            $('#success').css("display","block");
                            setTimeout(function(){
                                $('#success').css("display","none");
                            },3000);
                        }
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            },
            select_notebook_by_id:function(sn_id){
                var _this=this;
                $.ajax({
                    url:'../select_note_by_id.php',
                    dataType:'json',
                    data:{id:sn_id},
                    success:function(data){
                        _this.select_notebook=data;
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            },
            upd_notebook:function(no_id){
                var n_text=$('#n_text').val();
                var n_title=$('#n_title').val();
                var _this=this;
                $.ajax({
                    url:'../update_notebook.php',
                    data:{id:no_id,title:n_title,text:n_text},
                    type:'post',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        if(data==1){
                            _this.getAllUsers();
                            $('#update').css("display","block");
                            setTimeout(function(){
                                $('#update').css("display","none");
                            },3000);
                        }
                    },
                    error:function(error){
                        console.log("hello error");
                    }
                });
            },
            insert_notice:function(){
                var t_title=$('#t_title').val();
                var t_text=$('#t_text').val();
                var _this=this;
                $.ajax({
                    url:'../insert_notice.php',
                    data:{title:t_title,text:t_text},
                    type:'post',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        if(data==1){
                            _this.getAllUsers();
                            _this.select_notice_new_one();
                            $('#update').css("display","block");
                            setTimeout(function(){
                                $('#update').css("display","none");
                            },3000);
                        }
                    },
                    error:function(error){
                        console.log("hello error");
                    }
                });
                $('#t_title').val("");
                $('#t_text').val("");
            },
            select_notice_new_one:function(){
                var _this=this;
                $.ajax({
                    url:'../select_new.php',
                    dataType:'json',
                    success:function(data){
                        _this.new_notice=data[0][0];
                        console.log(_this.new_notice);
                    },
                    error:function(error){
                        console.log("hello error");
                    }
                });
            }
        }
    });
</script>
</body>
</html>





