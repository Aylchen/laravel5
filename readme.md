====================================================================================

Blog目前的一些功能详解：

1) 用户登录与注册

2) 文章的显示/新增/编辑/删除
    a) 用户不等录可查看文章
    b) 新增/编辑/删除文章必须在用户登录的情况下方可操作；
    c) 编辑/删除闻着那该加入了权限功能；只有文章的发布者方可对该文章进行编辑和删除操作

3) 文章评论功能
    a) 只有登录用户方可评论文章
    b) 评论的编辑和删除功能加入权限功能：只有当前评论的发布者方可对该评论进行编辑和删除；

4) 用户中心
    a) 我发布的文章
        可对自己发布的文章进行编辑和删除
    b) 我发布的评论
        可对自己发布的评论进行编辑和删除
    c) 我的基本信息

5) 主题切换功能

======================================================================================

关于Theme切换的说明:

a) 主题的使用：

    1) 默认主题为default；

    2) 更改主题只需要修改config/app.php中的theme即可

    3) 主题的切换包括模板的切换和样式的切换

        模板包括当前主题模板及公共模板（所有主题可共用，如：views/errors/404.blade.php）
        样式包括当前主题样式及公共样式( 所有主题可共用，public/css/* public/js/* 等)

b) 主题功能修改

    1) 修改了helpers.php下view方法，将主题添加为前置

    2) 修改View/Compiler/BladeCompiler.php中两个方法：compileExtends / compileInclude

    3) 添加样式的变化

       在HtmlBuilder中添加了theme_script和theme_style两个方法，可以在原来的写法上将theme作前置加上

    4) 不同主题公共模板和样式的使用

        ***********样式************

        1) 公共样式 template 中使用 @{!! Html::script|style('') !!}
            public/css/*
            public/js/*

        2) 主题样式   template 中使用 @{!! Html::theme_script|theme_style('') !!}
            public/themeName/css/*
            public/themeName/js/*

        ***********模板************

        1) 公共模板
        在模板的<code>@ include</code> 和 <code>@ extends</code>中都可接受第二个参数：true|false, 与第一个参数以, 隔开
        用法: <code>@ include('<templateName>', true)</code> | <code>@ extends('<templateName>', true)</code>

        默认false，使用的是当前主题下的模板
        如为true, 则默认使用公共模板 views/public/

        2) 主题不能命名为public