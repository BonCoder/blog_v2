
## 安装步骤
- git clone  https://github.com/BonCoder/Bob-Admin.git
- 复制.env.example为.env
- 配置.env里的数据库连接信息
- composer update
- php artisan migrate
- php artisan db:seed
- php artisan key:generate
- php artisan jwt:secret
- 登录后台：/admin   帐号：root  密码：123456

## 图片展示
- 后台主页
![Image text](https://raw.githubusercontent.com/github-muzilong/laravel55-layuiadmin/master/public/images/1.png)
- 用户
![Image text](https://raw.githubusercontent.com/github-muzilong/laravel55-layuiadmin/master/public/images/2.png)
- 权限
![Image text](https://raw.githubusercontent.com/github-muzilong/laravel55-layuiadmin/master/public/images/3.png)
- 消息推送
![Image text](https://raw.githubusercontent.com/github-muzilong/laravel55-layuiadmin/master/public/images/4.png)

type：用于说明commit的类别，规定为如下几种 
- feat：新增功能；
- fix：修复bug；
- docs：修改文档；
- refactor：代码重构，未新增任何功能和修复任何bug；
- build：改变构建流程，新增依赖库、工具等（例如webpack修改）；
- style：仅仅修改了空格、缩进等，不改变代码逻辑；
- perf：改善性能和体现的修改；
- chore：非src和test的修改；
- test：测试用例的修改；
- ci：自动化流程配置修改；
- revert：回滚到上一个版本；