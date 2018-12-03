# Blog_V2 API 文档
[TOC]
## 用户

### 用户注册

#### 请求地址

 &hearts; `post` : `api/v1/register`

#### 请求参数
| 名称 | 类型 | 描述 |
|:----:|:----:|------|
| name    | string    |  用户名  |
| email    | string  |  邮箱  |
| password | string | 密码 |

#### 返回体

```json5
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vd3d3LmJvYi5jb20vYXBpL3YxL2xvZ2luIiwiaWF0IjoxNTQzNTYxOTQwLCJleHAiOjE1NDM1NjU1NDAsIm5iZiI6MTU0MzU2MTk0MCwianRpIjoiREdGUUZDaTdpdmE1bnhqdyIsInN1YiI6NiwicHJ2IjoiODY2NWFlOTc3NWNmMjZmNmI4ZTQ5NmY4NmZhNTM2ZDY4ZGQ3MTgxOCJ9._v10ZX9y6GA90R-T-pGSHeEAcsVkRTzvRD_yrbljwhA",
    "token_type": "bearer",
    "expires_in": 3600
}
```
#### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| access_token    | string      | yes       |  token  |
| category_id    | string      | yes       |  token类型  |
| expires_in    | string      | yes       |  过期时间  |

### 用户登陆

#### 请求地址

 &hearts; `post` : `api/v1/login`

#### 请求参数
| 名称 | 类型 | 描述 |
|:----:|:----:|------|
| email    | string  |  邮箱  |
| password | string | 密码 |

#### 返回体

```json5
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9._v10ZX9y6GA90R-T-pGSHeEAcsVkRTzvRD_yrbljwhA",
    "token_type": "bearer",
    "expires_in": 3600
}
```
#### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| access_token    | string      | yes       |  token  |
| category_id    | string      | yes       |  token类型  |
| expires_in    | string      | yes       |  过期时间  |


### 个人信息

#### 请求地址

 &hearts; `post` : `api/v1/me`

#### 请求参数

无

#### 返回体

```json5
{
    "id": 6,
    "phone": null,
    "name": "Bob5",
    "avatar": null,
    "uuid": "2e24dc6a-a259-325c-a19a-32bb48bb3fc0",
    "deleted_at": null,
    "created_at": "2018-11-30 15:11:55",
    "updated_at": "2018-11-30 15:11:55",
    "email": "1233@qq.com"
}
```
#### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| id    | int      | yes       |  用户ID  |
| phone    | string      | yes       |  手机号  |
| name    | string      | yes       |  用户名  |
| avatar    | string      | yes       |  头像  |
| uuid    | string      | yes       |  UUID  |
| email    | string      | yes       |  邮箱  |

### 获取新token

#### 请求地址

 &hearts; `post` : `api/v1/refresh`

#### 请求参数

无

#### 返回体

```json5
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9._v10ZX9y6GA90R-T-pGSHeEAcsVkRTzvRD_yrbljwhA",
    "token_type": "bearer",
    "expires_in": 3600
}
```
#### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| access_token    | string      | yes       |  token  |
| category_id    | string      | yes       |  token类型  |
| expires_in    | string      | yes       |  过期时间  |


## 文章列表

### 请求地址

 &hearts; `get` : `api/v1/article`

### 请求参数
| 名称 | 类型 | 描述 |
|:----:|:----:|------|
| limit    | int    |  每页个数 默认为10条  |
| offset    | int  |  从第几个开始  |
| category_id | int | 分类ID |
| tag_id | int | 标签ID |
| title | string | 标题 |

### 返回体

```json5
[
    {
        "id": 96,
        "category_id": 4,
        "title": "windows下安装Vagrant Homestead (laravel/homestead)",
        "keywords": "windows,Vagrant,Homestead",
        "content": "测试数据",
        "click": 308,
        "thumb": "http://file.bobcoder.cc/2018-11-23_1542964637_5bf7c59daa963.png",
        "created_at": "2018-11-20 11:51:32",
        "updated_at": "2018-11-30 11:06:14",
        "recommend": 0,
        "status": 1,
        "tags": [
            {
                "id": 19,
                "name": "php",
                "sort": 0,
                "created_at": "2018-11-26 16:07:26",
                "updated_at": "2018-11-26 16:07:26",
                "pivot": {
                    "article_id": 96,
                    "tag_id": 19
                }
            }
        ],
        "category": {
            "id": 4,
            "name": "PHP",
            "parent_id": 0,
            "sort": 0,
            "created_at": "2018-11-21 15:56:57",
            "updated_at": "2018-11-21 15:56:57"
        }
    },
    {
        "id": 95,
        "category_id": 4,
        "title": "Laravel5.5+dingo+JWT 开发后台 API",
        "keywords": "laravel,api",
        "content": "测试数据",
        "click": 358,
        "thumb": "http://file.bobcoder.cc/2018-11-23_1542964593_5bf7c571d000a.png",
        "created_at": "2018-11-14 15:33:39",
        "updated_at": "2018-11-29 15:31:19",
        "recommend": 0,
        "status": 1,
        "tags": [
            {
                "id": 3,
                "name": "Laravel",
                "sort": 0,
                "created_at": "2018-11-26 16:07:26",
                "updated_at": "2018-11-26 16:07:26",
                "pivot": {
                    "article_id": 95,
                    "tag_id": 3
                }
            }
        ],
        "category": {
            "id": 4,
            "name": "PHP",
            "parent_id": 0,
            "sort": 0,
            "created_at": "2018-11-21 15:56:57",
            "updated_at": "2018-11-21 15:56:57"
        }
    }
]
```
### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| id    | int      | yes       |  未读条数  |
| category_id    | int      | yes       |  分类ID  |
| title    | string      | yes       |  文章标题  |
| keywords    | string      | yes       |  关键字  |
| content    | text      | yes       |  内容  |
| thumb    | string      | yes       |  缩略图  |
| created_at    | string      | yes       |  创建时间  |
| recommend    | int      | yes       |  是否推荐 1:是 0:否 |
| status    | int      | yes       |  状态 1:是 2:否|
| tags    | array      | yes       |  标签  |
| tags.id    | int      | yes       |  标签ID  |
| tags.name    | string      | yes       |  标签名称  |
| category   | array      | yes       |  分类  |
| category.id    | int      | yes       |  分类ID  |
| category.name  | string      | yes       |  分类名称  |


## 获取广告位

### 请求地址

 &hearts; `get` : `api/v1/adverts`

### 请求参数
| 名称 | 类型 | 描述 |
|:----:|:----:|------|
| position_id    | int    | 广告位置ID 默认为1(首页)  |

### 返回体

```json5
[
    {
        "id": 4,
        "title": "banner1",
        "thumb": "http://file.bobcoder.cc/2018-11-25_1543134283_5bfa5c4b5c6f6.jpg",
        "link": null,
        "sort": 0,
        "position_id": 1,
        "description": null,
        "created_at": "2018-11-25 16:25:08",
        "updated_at": "2018-11-25 16:25:08"
    },
    {
        "id": 5,
        "title": "banner2",
        "thumb": "http://file.bobcoder.cc/2018-11-25_1543134316_5bfa5c6cec7dc.jpg",
        "link": null,
        "sort": 0,
        "position_id": 1,
        "description": null,
        "created_at": "2018-11-25 16:25:19",
        "updated_at": "2018-11-25 16:25:19"
    },
    {
        "id": 6,
        "title": "banner3",
        "thumb": "http://file.bobcoder.cc/2018-11-25_1543134326_5bfa5c760b65e.jpg",
        "link": null,
        "sort": 0,
        "position_id": 1,
        "description": null,
        "created_at": "2018-11-25 16:25:27",
        "updated_at": "2018-11-25 16:25:27"
    }
]
```
### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| id    | int      | yes       |  ID  |
| title    | string      | yes       |  广告标题  |
| thumb    | string      | yes       |  图片链接  |
| link    | string      | yes       |  跳转链接  |
| sort    | int      | yes       |  排序  |
| position_id    | int      | yes       |  位置ID  |
| description    | text      | yes       |  广告描述  |


## 获取所有标签

### 请求地址

 &hearts; `get` : `api/v1/tag`

### 请求参数
无
 
### 返回体

```json5
[
    {
        "id": 1,
        "name": "爬虫",
        "sort": 0,
        "created_at": "2018-11-21 15:59:33",
        "updated_at": "2018-11-21 15:59:33"
    },
    {
        "id": 14,
        "name": "nginx",
        "sort": 0,
        "created_at": "2018-11-26 16:07:26",
        "updated_at": "2018-11-26 16:07:26"
    },
    {
        "id": 15,
        "name": "css",
        "sort": 0,
        "created_at": "2018-11-26 16:07:26",
        "updated_at": "2018-11-26 16:07:26"
    }
]
```
### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| id    | int      | yes       |  ID  |
| name    | string      | yes       |  标签名称  |
| sort    | int      | yes       |  排序ID  |


## 获取所有友链

### 请求地址

 &hearts; `get` : `api/v1/links`

### 请求参数
无

### 返回体

```json5
[
    {
        "id": 1,
        "name": "Bob`s Blog",
        "link": "https://www.bobcoder.cc",
        "email": "bob@bobcoder.cc",
        "status": 1,
        "sort": 0,
        "created_at": "2018-11-29 12:03:05",
        "updated_at": "2018-11-29 13:40:28"
    }
]
```
### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| id    | int      | yes       |  ID  |
| name    | string      | yes       |  名称  |
| link    | string      | yes       |  链接  |
| email    | string      | yes       |  邮箱  |
| status    | int      | yes       |  状态 1:开启 0:关闭|
| sort    | int      | yes       |  排序ID  |


## 文章详情

### 请求地址

 &hearts; `get` : `api/v1/article/{article}`

### 请求参数
| 名称     | 类型     | 描述     | 
|----------|:--------:|:--------:|

### 返回体

```json5
[
    {
        "id": 1,
        "category_id": 5,
        "title": "【Java】 JDBC连接MYSQL数据库教程",
        "keywords": "JDBC,MYSQL",
        "content": "测试数据",
        "click": 364,
        "thumb": "http://file.bobcoder.cc/2018-11-21_1542791857_5bf522b191a9b.png",
        "created_at": "2017-07-04 11:23:46",
        "updated_at": "2018-11-29 15:31:19",
        "recommend": 0,
        "status": 1,
        "tags": [
            {
                "id": 20,
                "name": "mysql",
                "sort": 0,
                "created_at": "2018-11-26 16:07:26",
                "updated_at": "2018-11-26 16:07:26",
                "pivot": {
                    "article_id": 1,
                    "tag_id": 20
                }
            },
            {
                "id": 22,
                "name": "java",
                "sort": 0,
                "created_at": "2018-11-21 16:59:29",
                "updated_at": "2018-11-21 16:59:29",
                "pivot": {
                    "article_id": 1,
                    "tag_id": 22
                }
            }
        ],
        "category": {
            "id": 5,
            "name": "Java",
            "parent_id": 0,
            "sort": 0,
            "created_at": "2018-11-21 15:57:03",
            "updated_at": "2018-11-21 15:57:03"
        }
    }
]
```
### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| id    | int      | yes       |  未读条数  |
| category_id    | int      | yes       |  分类ID  |
| title    | string      | yes       |  文章标题  |
| keywords    | string      | yes       |  关键字  |
| content    | text      | yes       |  内容  |
| thumb    | string      | yes       |  缩略图  |
| created_at    | string      | yes       |  创建时间  |
| recommend    | int      | yes       |  是否推荐 1:是 0:否 |
| status    | int      | yes       |  状态 1:是 2:否|
| tags    | array      | yes       |  标签  |
| tags.id    | int      | yes       |  标签ID  |
| tags.name    | string      | yes       |  标签名称  |
| category   | array      | yes       |  分类  |
| category.id    | int      | yes       |  分类ID  |
| category.name  | string      | yes       |  分类名称  |


## 获取文章评论列表

### 请求地址

 &hearts; `get` : `api/v1/article/{article}/comments`

### 请求参数
| 名称     | 类型     | 描述     | 
|----------|:--------:|:--------:|
|   limit      | int      | 请求数据条数  默认15条    |
|   offset     | int      | 用来翻页的记录id  默认为0  |

### 返回体

```json5
[
    {
        "id": 4,
        "user_id": 4,
        "target_user": 1,
        "reply_user": 6,
        "commentable_type": "App\\Models\\Article",
        "commentable_id": 1,
        "content": "我觉得你说的很有道理22222",
        "created_at": "2018-12-03 14:44:57",
        "updated_at": "2018-12-03 14:44:57",
        "user": {
            "id": 4,
            "phone": null,
            "name": "Bob2",
            "avatar": null,
            "uuid": "41fc277c-5d6b-3670-8f3e-e510cc882bf2",
            "deleted_at": null,
            "created_at": "2018-11-30 15:07:15",
            "updated_at": "2018-11-30 15:07:15",
            "email": "1231@qq.com"
        },
        "reply": {
            "id": 6,
            "phone": null,
            "name": "Bob5",
            "avatar": null,
            "uuid": "2e24dc6a-a259-325c-a19a-32bb48bb3fc0",
            "deleted_at": null,
            "created_at": "2018-11-30 15:11:55",
            "updated_at": "2018-11-30 15:11:55",
            "email": "1233@qq.com"
        }
    }
]
```
### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| id    | int      | yes       |  评论ID  |
| user_id    | int      | yes       |  评论者ID  |
| target_user    | string      | yes       |  作者ID  |
| reply_user    | string      | yes       |  被回复者ID  |
| commentable_id    | text      | yes       |  文章ID  |
| content    | string      | yes       |  内容  |
| created_at    | string      | yes       |  创建时间  |
| user    | array      | yes       |  评论者  |
| user.id    | int      | yes       |  评论者ID  |
| user.name    | string      | yes       |  昵称  |
| user.avatar    | string      | yes       |  头像  |
| user.email    | string      | yes       |  邮箱  |
| reply    | array      | yes       |  被回复者  |
| reply.id    | int      | yes       |  被回复者ID  |
| reply.name    | string      | yes       |  昵称  |
| reply.avatar    | string      | yes       |  头像  |
| reply.email    | string      | yes       |  邮箱  |

## 文章评论

### 请求地址

 &hearts; `post` : `api/v1/article/{article}/comments`

### 请求参数
| 名称     | 类型     | 描述     | 
|----------|:--------:|:--------:|
|   content      | text      | 评论内容    |
|   reply_user      |  int      | 被评论者ID (不传默认为0) |
|   parent_id      |  int      | 上级评论ID (不传默认为0) |

### 返回体

```json5
{
    "code": 1,
    "message": "评论成功",
    "comment": {
        "user_id": 3,
        "reply_user": 0,
        "target_user": 1,
        "parent_id": 0,
        "content": "我觉得你说的很有道理-4",
        "commentable_type": "App\\Models\\Article",
        "commentable_id": 1,
        "updated_at": "2018-12-03 16:32:14",
        "created_at": "2018-12-03 16:32:14",
        "id": 6
    }
}
```
### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| code    | int      | yes       |  状态码  |
| message    | string      | yes       |  返回信息  |
| comment    | string      | yes       |  返回信息  |
| comment.id    | int      | yes       |  返回信息  |
| comment.user_id    | int      | yes       |  评论者ID  |
| comment.reply_user    | int      | yes       |  被评论者ID  |
| comment.target_user    | int      | yes       |  作者ID |
| comment.parent_id    | int      | yes       |  父级ID  |
| comment.content    | string      | yes       |  内容  |
| comment.commentable_id    | int      | yes       |  文章ID  |

## 站点基本信息

### 请求地址

 &hearts; `get` : `api/v1/site` 

### 请求参数

无
   
### 返回体

```json5
{
    "title": "Bob的博客-PHP-Java-mysql--Bob的博客|技术博客|个人博客",
    "keywords": "Bob的博客,Linux,Windows,bobcoder,个人主页,php,java,技术博客,个人博客,mysql,nginx,Bob,laravel",
    "description": "Bob的博客是一个关注网站建设、网络推广、Html5+css3、Java、PHP、Mysql等技术分享的博客,提供博主在学习成果和工作中经验总结，是一个互联网从业者值得收藏的网站。",
    "copyright": "2017-2019 https://www.bobcoder.cc/ All Rights Reserved |  蜀ICP备17022542号-1",
    "phone": "18040363559",
    "city": "四川成都"
}
```
### 返回字段

| name     | type     | must     | description |
|----------|:--------:|:--------:|:--------:|
| title    | string      | yes       |  标题  |
| keywords    | string      | yes       |  关键字  |
| description    | string      | yes       |  描述  |
| copyright    | string      | yes       |  版权  |
| city    | string      | yes       |  城市  |
| phone    | string      | yes       |  手机号  |
