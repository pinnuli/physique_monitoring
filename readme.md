#physique_monitoring
安装步骤：

## 安装composer
>* ```curl -sS https://getcomposer.org/installer | php```
>* ```mv composer.phar /usr/local/bin/composer```

## 从git clone项目
## 安装依赖
>* ```在项目目录下执行composer install```

## 配置apache
>* 将根目录设置为 /自己web目录／hHR/public
>* 配置rewrite，否则会404或500

## 配置项目的目录权限
>* ```chmod -R 777 storage/* ```
>* ```chmod -R 777 bootstarp/cache/* ```

## 配置数据库
>* 复制.env.example 为.env
>* 修改.env中的数据库相关配置

##设置上传文件最大值
>* 打开php.ini文件，找到upload_max_filesize修改最大值

##集成 Intervention Image
>* 安装Fileinfo扩展和gd扩展
>* 执行 ```composer require intervention/image```
>* 打开config/app.php, ```Intervention\Image\ImageServiceProvider::class```到$providers数组, 添加``` 'Image' => Intervention\Image\Facades\Image::class ```到 $aliaes数组

