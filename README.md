# 短链接生成

这是一个简单的短链接生成程序, 通过PHP实现, 采用sqlite, 无需安装, 只需要一个PHP环境即可使用

原项目是 [CRZ.im](https://github.com/Caringor/CRZ.im)

作了以下修改:
* 增加了后台管理功能
* 修改了API功能

## 部署

1. 本地部署
   ```sh
   git clone https://github.com/stozn/short-link.git
   cd short-link
   php -S localhost:80
   ```
2. 服务器部署
   直接将项目放到你的网站目录下即可使用



## 设置

* config.php 文件可以更改站点设置,包括站点名和短链接ID长度
* password 文件夹的名字可以更改, 这个是后台的链接
   例如修改为 admin, 则后台访问链接为 http://localhost/admin
    *请注意不要泄漏这个访问的链接



## API 

* 请求方法：GET
* 请求参数：
  * url: 需要缩短的网址
  * pure: 是否只返回纯文本的短链接（可选）
* 返回格式：默认为json，若设置了pure参数则返回text
* 请求样例：
  * http://localhost/api/?url=http://www.baidu.com
  * http://localhost/api/?pure&url=http://www.baidu.com
* 返回样例：
   ```json
   {
      "success":"true",
      "content":"http:\/\/localhost\/96"
   }
   ```
   ```
   http://localhost/96
  ```
   


## 后台功能

后台链接：http://localhost/｛password｝
默认为 http://localhost/password

1. 查看所有的链接
2. 搜索指定链接
3. 删除指定链接
4. 手动指定链接ID
5. 清空所有链接


