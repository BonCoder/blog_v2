# Blog_V2 API 文档
[TOC]
## 文章列表

`api/v1/article`

### 请求方法

`get `

### 请求参数
| 名称 | 类型 | 描述 |
|:----:|:----:|------|
| limit    | int    |  每页个数 默认为10条  |
| offset    | int  |  从第几个开始  |
| category_id | int | 分类ID |
| tag_id | int | 标签ID |
| title | string | 标题 |


### HTTP状态码

200

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

`api/v1/adverts`

### 请求方法

`get `

### 请求参数
| 名称 | 类型 | 描述 |
|:----:|:----:|------|
| position_id    | int    | 广告位置ID 默认为1(首页)  |

### HTTP状态码

200

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

`api/v1/tag`

### 请求方法

`get `

### 请求参数
无

### HTTP状态码

200

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

`api/v1/links`

### 请求方法

`get `

### 请求参数
无

### HTTP状态码

200

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

`api/v1/article/{article}`

### 请求方法

`get `

### 请求参数
| 名称     | 类型     | 描述     | 
|----------|:--------:|:--------:|
|   article      | int      | 文章ID    |

### HTTP状态码

200

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

