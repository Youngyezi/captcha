# Lumen 验证码

基于  [Captcha for Laravel 5](https://github.com/mewebstudio/captcha "Captcha for Laravel 5") 修改而来的


>A simple [Laravel 5](http://www.laravel.com/) service provider for including the [Captcha for Laravel 5](https://github.com/mewebstudio/captcha).

### 源于

Captcha for Laravel 5 作者很久没有更新了，同时 Captcha 在 Lumen 有很多错误

由此我基于原 Captcha 包进行了一些错误修复来集成 Lumen 。 同时删除了一些个人觉得太过冗余的东西，让使用更加方便和自由

### 安装


	composer require youngyezi/captcha

### 使用


注册服务 `bootstrap\app.php`

	$app->register(Youngyezi\Captcha\CaptchaServiceProvider::class);


添加别名

	$app->alias('captcha', 'Youngyezi\Captcha\CaptchaServiceProvider');


### For Example

添加验证码获取路由
	
	
	$router->get('/captcha', function (Youngyezi\Captcha\Captcha $captcha){

	// 创建验证码

	// 配置文件 key($config),默认 default
	// 直接返回验证码图片
	    return $captcha->create($config);

	// Api 模式
	// 返回 验证码 captcha 和相关 key， 后端服务通过 captcha 和 key 来校验
	return $captcha->create($config, true);
	});

校验
	
	// 需要开启 session 服务
       $captcha = $request->input('captcha');
	
	if(app('captcha')->check($captcha) === false) {
   		
		//校验失败
    	}


	//通过 code 和 key 来校验
	$captcha = $request->input('captcha');
	$key     = $request->input('key');
		
	if(app('captcha')->check_api($captcha, $key) === false) {
   		
		//校验失败
   	 }

### 最后

此包在 Lumen 5.5 下开发，如果有其他问题或 bug， 请告知。
