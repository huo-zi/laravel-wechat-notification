# laravel-wechat-notification
这是一个laravel框架下使用微信模板消息作为notification通道的composer包,使用前请先熟读[laravel-消息通知](https://learnku.com/docs/laravel/8.x/notifications/9396)

### 使用方式： ###
0. 添加composer包：
<pre><code>composer require "huo-zi/laravel-wechat-notification"</code></pre>

1. 在继承了`notification`的通知类中可以使用如下方法：
* 增加公众号/小程序渠道：
<pre><code>public function via($notifiable)
{
    return ['official_account', 'mini_program'];
}</code></pre>
* 使用公众号发送模板消息：
<pre><code>public function toOfficialAccount()
{
    return WechatMessage::officialAccount('app_name')->template('templateId')->url($url)->data(['fisrt'=>'...']);
}</code></pre>
* 使用小程序发送模板消息：
<pre><code>public function toMiniProgram()
{
    return WechatMessage::miniProgram('app_name')->template($templateId)->formId($formId)->data([
        'first' => ''
        //
    ]);
}</code></pre>
2. 使用了`triat` `Notifiable`的`model`可以增加获取当前`model`对应`openid`的方法：
* 返回公众号`openid`
<pre><code>public function routeNotificationForOfficialAccount($notification)
{
    // 返回当前model的公众号openid
    return ;
}</code></pre>
* 返回小程序`openid`
<pre><code>public function routeNotificationForMiniProgram($notification)
{
    // 返回当前model的小程序openid
    return ;
}</code></pre>
