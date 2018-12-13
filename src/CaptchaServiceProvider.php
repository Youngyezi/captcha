<?php
namespace Youngyezi\Captcha;


use Illuminate\Support\ServiceProvider;
/**
 * Class CaptchaServiceProvider
 * @package Mews\Captcha
 */
class CaptchaServiceProvider extends ServiceProvider {
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function boot()
    {
        // Publish configuration files
        $this->publishes([
            __DIR__.'/../config/captcha.php' => config_path('captcha.php')
        ], 'config');

        // Validator extensions
        $this->app['validator']->extend('captcha', function($attribute, $value, $parameters)
        {
            return $this->app['captcha']->check($value);
        });

        $this->app['validator']->extend('captcha_api', function($attribute, $value, $parameters)
        {
            return app('captcha')->check_api($value, $parameters[0]);
        });
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Merge configs
        $this->mergeConfigFrom(
            __DIR__.'/../config/captcha.php', 'captcha'
        );

        // Bind captcha
        $this->app->bind('captcha', function($app)
        {
            return new Captcha(
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Illuminate\Config\Repository'],
                $app['Intervention\Image\ImageManager'],
                $app['Illuminate\Session\SessionManager'],
                $app['Illuminate\Hashing\BcryptHasher'],
                $app['Illuminate\Support\Str']
            );
        });
    }
}