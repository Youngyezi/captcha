# Captcha for Lumen

基于  [Captcha for Laravel 5](https://github.com/mewebstudio/captcha "Captcha for Laravel 5") 修改而来的


>A simple [Laravel 5](http://www.laravel.com/) service provider for including the [Captcha for Laravel 5](https://github.com/mewebstudio/captcha).

## 源于

Captcha for Laravel 5 作者很久没有更新了，同时 Captcha 在 Lumen 有很多错误

由此我基于原 Captcha 包进行了一些错误修复来集成 Lumen 。 同时删除了一些个人觉得太过冗余的东西，让使用更加方便和自由

## 安装


	composer require youngyezi/captcha

## 使用


>新版的包已经删除了 session 支持，完全交给业务自由选择存储方式
>
>个人觉得这样更方便来解耦业务，尤其 Lumen 大多时候用来做 Api 开发，并不需要开启 Session 服务



### 注册服务 `bootstrap\app.php`

	$app->register(Youngyezi\Captcha\CaptchaServiceProvider::class);


  	// 添加别名
	$app->alias('captcha', 'Youngyezi\Captcha\CaptchaServiceProvider');
	
### 配置文件


复制 `config/captcha.php` 至 项目 `config`  文件下


## For Example

### 验证码生成
	
	//  创建验证码
	//  配置文件 key($config)
    //  返回 验证码 captcha 和相关 key
    $data = app('captcha')->create();
        
    //  自定义储存 key （如 redis ，session 等）
    
    ....
    
    //  返回验证码图片 img

### 验证码校验

	// 通过 code 和 key 来校验
	$captcha = $request->input('captcha');
	
	// 获取自定义存储的 key 值
	$key = { ... };
		
	if(app('captcha')->check($captcha, $key) === false) {
   		   //校验失败
   	}
