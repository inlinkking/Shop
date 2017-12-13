## my-shop商城
独立完成项目的设计及开发工作:需求分析,数据库设计<br>
基于laravel5.4开发。  <br>
网站前后台页面模板都由本人自主设计，其中后台使用目前比较流行的Amaze UI模板,本次后台的一些功能模块如下： <br>
系统设置：<br>
错误日志（使用Laravel Log Viewer 可以直接通过这个在浏览器上面直接查看错误信息）<br>
站点信息（基本的增删改查）<br>
修改密码（邮箱/手机号/原始密码必须匹配）<br>
清除缓存（缓存使用Redis缓存技术，在模型里面设置缓存，写一个私有方法，在修改页面之后调用这个方法清除缓存）<br>
用户管理（基本的增删改查）<br>
用户组管理（实现基本的增删改查）<br>
权限管理（模型部分，定义HasRoles.php中的trait，在User模型中实例化HasRolse，注册策略，定义中间件，判断当前是否拥有权限，路由中加上中间件，自定义一个403页面，提示没有权限）<br>
商城系统：<br>
	数据统计（先引入ECharts插件，后台各种查询最后return返回JSON数据，前端获取后端的JSON数据在页面显示）<br>
商品管理（实现基本的增删改查，商品介绍使用Maradown编辑阅读器，商品相册使用Webupload支持多图拖动上传）<br>
品牌管理（实现基本的增删改查，使用Ajax实现页面无刷新技术）<br>
分类管理（在分类里面做一个一对多关联，在模板里依此把所有的循环出来，在模型中封装查找子类的方法，控制器中调用此方法实现一级分类下有二级分类不能删除）<br>
订单管理（记录买家购车的详细信息，具体实现流程如下：当买家选购好商品（车系）后 点击下单，此时要往数据库的订单表插入数据，当买家付款后，卖家就实现配送信息等）<br>
物流运费（实现一些基本的增删改查）<br>
会员管理（记录所有使用微信关注公众号的会员，记录openid，图像，昵称等信息）<br>
商品回收站  （商品管理的删除并非彻底删除，而是删除到回收站，使用Laravel的软删除，这里可以还原和彻底删除）<br>
广告中心：<br>
广告管理（基本的增删改查，Ajax实现页面无刷新技术）<br>
分类管理（在分类里面做一个一对多关联，在模型中封装查找广告的方法，控制器中调用此方法实现分类下有广告不能删除）<br>
广告回收站（广告管理的删除并非彻底删除，而是删除到回收站，使用Laravel的软删除，这里可以还原和彻底删除）<br>
微信管理：<br>
	自定义菜单（Laravel安装easyWechat，注册服务生成配置文件，配置路由，创建控制器，实现增删改查）<br>
定位：<br>
	地图定位（使用高德的API接口调用地图）<br>
前端页面内容如下：<br>
商城首页（轮播图和一些基本的查询）<br>
订单管理（使用Ajax实时查询订单状态）<br>
购 物 车（使用vue计算购物信息，页面实时改变）<br>
收货地址（一个用户有多个收货地址，模型定义关联关系）<br>
微信关键字回复（在.env文件中设置token，用于验证微信与服务器项目是否对接，在中间件WeChat.php中设置用户session信息并添加中间件同时核心里面注册该中间件在config文件夹中的WeChat.php中开启OAuth配置，在api.php中配置微信前端接口路由并创建控制器和方法，模型设置黑名单，过滤微信不需要的字段，修改微信公众平台测试号中的接口配置信息，最后设置各种事件，查询需要的数据）  
采用用户授权获取用户相关信息，如：openid，昵称，性别，头像等  <br>
开发工具：phpstorm  Laragon<br>
涉及技术： html，css，jquery，ajax，分页，Amaze UI，Redis，ECharts，easyWechat，Maradown，Webupload
