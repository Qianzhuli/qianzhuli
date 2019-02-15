# 钱助理网贷评级网站——前台系统
### 这是我的毕业设计，基于Yii2.0 advanced,项目完全开源，欢迎各位使用！
#### 如果你需要用到这个仓库，你需要做如下几件事：
1. git clone这个仓库到本地
2. 拷贝vendor目录到该项目文件夹下（vendor目录网上自己找一下）
3. 在项目文件夹下 composer update一下，自动安装一下如下拓展（不清楚composer？没关系，移步[http://www.phpcomposer.com](https://note.youdao.com/)）

```
  crazydb/yii2-ueditor(富文本)

  yii2-bootstrap-tags-input(标签)
```

4. window运行ini.bat初始化，linux运行ini

如遇到问题，可以联系 735407073@qq.com 

---


### 网站部分展示
#### 评级页(数据来源于爬虫，暂时用数据库按日期缓存，后续迁移至redis)：
![123](https://raw.githubusercontent.com/Qianzhuli/qianzhuli/master/readme_images/123.png)

#### 资讯列表页(支持分页)：
![fs](https://raw.githubusercontent.com/Qianzhuli/qianzhuli/master/readme_images/fs.png)

#### 资讯详情页（支持阅读量统计、资讯关联标签展示等）：
![xiangqing](https://raw.githubusercontent.com/Qianzhuli/qianzhuli/master/readme_images/xiangqing.png)

#### 资讯创建页（登录后可创建资讯，创建后自动提交后台审核，审核通过后按时间顺序展示在资讯页。支持添加预览图，支持所见即所得的编辑内容，支持给资讯加标签、分类）：
![xx](https://raw.githubusercontent.com/Qianzhuli/qianzhuli/master/readme_images/xx.png)

#### 用户个人资讯页（用户创建的资讯会在这里，并显示审核状态，后续做编辑功能）
![mine](https://raw.githubusercontent.com/Qianzhuli/qianzhuli/master/readme_images/mine.png)

#### 赞助页（emmmm...）
![dashang](https://raw.githubusercontent.com/Qianzhuli/qianzhuli/master/readme_images/dashang.png)

#### 登录、注册、个人中心等页面就不展示啦，反正大家也知道我做的挺好看的。。。hhhhh
（未完待续）