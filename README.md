# laravel-wechat-notification
这是一个laravel框架下基于[laravel-wechat](https://github.com/overtrue/laravel-wechat)使用微信消息通知作为notification通道的composer包,使用前请先熟读[laravel-消息通知](https://learnku.com/docs/laravel/8.x/notifications/9396)  
目前已支持：  
* 公众号模板消息
* 小程序模板消息
* 开放平台公众号模板消息
* 开放平台小程序模板消息
* 企业微信消息
* 企业微信开放平台消息
### 使用方式： ###
0. 添加composer包：
<pre><code>composer require "huo-zi/laravel-wechat-notification"</code></pre>

1. 在继承了`notification`的通知类中可以使用如下方法：
* 增加公众号/小程序渠道：
<pre><code>public function via($notifiable)
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
* 使用开放平台公众号发送模板消息：
<pre><code>public function toOpenOfficialAccount()
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
}</code></pre>
* 使用开放平台小程序发送模板消息：
<pre><code>public function toOpenMiniProgram()
{
    return WechatMessage::openFlatform($name)->miniProgram($appId, $refreshToken, $accessToken)->template($templateId);
}</code></pre>
* 使用企业微信发送消息：
<pre><code>public function toWork()
{
    return WechatMessage::work($name)->message($message)->ofAgent($agentId);
}</code></pre>
* 使用开放平台企业微信发送消息：
<pre><code>public function toOpenWork()
{
    return WechatMessage::openWork($name)->work($authCorpId, $permanentCode)->message($message)->ofAgent($agentId);
    // 同样也支持创建好开放平台对象后使用及闭包创建work对象
    $messenger = (new WechatOpenWork($openWork))->work(function($openWork) {
        return $openWork->work($authCorpId, $permanentCode);
    });
    return $messenger->message($message)->ofAgent($agentid);
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
* 返回开放平台公众号`openid`
<pre><code>public function routeNotificationForOpenOfficialAccount($notification)
{
    // 返回对应开放平台公众号用户的openid
}</code></pre>
* 返回开放平台小程序`openid`
<pre><code>public function routeNotificationForOpenMiniProgram($notification)
{
    // 返回对应开放平台小程序用户的openid
}</code></pre>
* 返回企业微信`userid`
<pre><code>public function routeNotificationForWork($notification)
{
    // 返回当前model的企业微信userid
    return ;
}</code></pre>
* 返回开放平台企业微信`userid`
<pre><code>public function routeNotificationForOpenWork($notification)
{
    // 返回对应开放平台企业用户userid
    return ;
}</code></pre>
