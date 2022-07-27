# laravel-wechat-notification
这是一个laravel框架下基于[laravel-wechat](https://github.com/overtrue/laravel-wechat)使用微信消息通知作为notification通道的composer包,使用前请先熟读[laravel-消息通知](https://learnku.com/docs/laravel/8.x/notifications/9396)  
目前已支持：  
* 公众号模板消息
* 小程序模板消息
* 开放平台公众号模板消息
* 开放平台小程序模板消息
* 企业微信消息
* 企业微信开放平台消息

## 使用方式： ###

### 0. 添加composer包：

```
composer require "huo-zi/laravel-wechat-notification"
```

### 1. 在继承了`notification`的通知类中可以使用如下方法：

* 设置发送[指定频道](https://learnku.com/docs/laravel/8.x/notifications/9396#490165)：

```php
public function via($notifiable)
{
    /*
     * 支持的via列表
     * official_account：公众号
     * mini_program：小程序
     * open_official_account：开放平台公众号
     * open_mini_program：开放平台小程序
     * work：企业微信
     * open_work：开放平台企业微信
     */
    return ['official_account', 'mini_program'];
}
```

* 使用公众号发送模板消息：

```php
public function toOfficialAccount()
{
    return WechatMessage::officialAccount('app_name')->template('templateId')->url($url)->data(['fisrt'=>'...']);
}
```

* 使用小程序发送模板消息：

```php
public function toMiniProgram()
{
    return WechatMessage::miniProgram('app_name')->template($templateId)->formId($formId)->data([
        'first' => ''
        //
    ]);
}
```

* 使用开放平台公众号发送模板消息：

```php
public function toOpenOfficialAccount()
{
    return WechatMessage::openFlatform($name)->officateAccount($appId, $refreshToken, $accessToken)->template('templateId');
}
// 或使用闭包创建开放平台的公众号对象
public function toOpenOfficialAccount()
{
    return WechatMessage::openFlatform($name)->officateAccount(function ($open) {
        return $open->officateAccount($appId, $refreshToken, $accessToken);
    })->template('templateId');
}
// 或创建好开放平台对象后使用
public function toOpenOfficialAccount()
{
    return (new WechatPlatform($openPlatform))->officateAccount($appId, $refreshToken, $accessToken)->template($templateId);
}
```

* 使用开放平台小程序发送模板消息：

```php
public function toOpenMiniProgram()
{
    return WechatMessage::openFlatform($name)->miniProgram($appId, $refreshToken, $accessToken)->template($templateId);
}
```

* 使用企业微信发送消息：

```php
public function toWork()
{
    return WechatMessage::work($name)->message($message)->ofAgent($agentId);
}
```

* 使用开放平台企业微信发送消息：

```php
public function toOpenWork()
{
    return WechatMessage::openWork($name)->work($authCorpId, $permanentCode)->message($message)->ofAgent($agentId);
    // 同样也支持创建好开放平台对象后使用及闭包创建work对象
    $messenger = (new WechatOpenWork($openWork))->work(function($openWork) {
        return $openWork->work($authCorpId, $permanentCode);
    });
    return $messenger->message($message)->ofAgent($agentid);
}
```

### 2. 在使用了`triat` `Notifiable`的模型里增加获取对应`openid/userid`的方法：

可以参考官方文档里发送邮件通知时[自定义收件人](https://learnku.com/docs/laravel/8.x/notifications/9396#ac905f)

* 获取公众号`openid`

```php
public function routeNotificationForOfficialAccount($notification)
{
    // 返回当前model的公众号openid
    return $this->openid;
}
```

* 获取小程序`openid`

```php
public function routeNotificationForMiniProgram($notification)
{
    // 返回当前model的小程序openid
}
```

* 获取开放平台公众号`openid`

```php
public function routeNotificationForOpenOfficialAccount($notification)
{
    // 返回对应开放平台公众号用户的openid
}
```

* 获取开放平台小程序`openid`

```php
public function routeNotificationForOpenMiniProgram($notification)
{
    // 返回对应开放平台小程序用户的openid
}
```

* 获取企业微信`userid`

```php
public function routeNotificationForWork($notification)
{
    // 返回当前model的企业微信userid
    return ;
}
```

* 获取开放平台企业微信`userid`

```php
public function routeNotificationForOpenWork($notification)
{
    // 返回对应开放平台企业用户userid
    return ;
}
```
### 3. 可参考官方文档：[发送通知](https://learnku.com/docs/laravel/8.x/notifications/9396#fd6d4c)

使用`Notifiable`特性的`notify`方法可以给用户实例[发送通知](https://learnku.com/docs/laravel/8.x/notifications/9396#37688f)：

```php
use App\Notifications\WorkNotify;

$user->notify(new WorkNotify(new Text('你好啊~')));
```

使用`Notification`facade 给多个可接收通知的实体[发送通知](https://learnku.com/docs/laravel/8.x/notifications/9396#dc8524)

```php
Notification::send($users, new WorkNotify(new Markdown('#你好啊~')));
```

License
------------
Licensed under [The MIT License (MIT)](LICENSE).
