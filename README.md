# laravel-wechat-notification
这是一个laravel框架下使用微信模板消息作为notification通道的composer包,使用前请先熟读[larave-消息通知](https://learnku.com/docs/laravel/8.x/notifications/9396)

使用方式：
1. 继承了notification的通知类：
* 增加公众号/小程序渠道：
<pre><code>public function via($notifiable)
{
    return ['official_account', 'mini_program'];
}</code></pre>
* 公众号发送模板消息：
<pre><code>public function toOfficialAccount()
{
    return WechatMessage::officialAccount('app_name')->template('templateId')->url($url)->data(['fisrt'=>'...']);
}</code></pre>
* 小程序发送模板消息：
<pre><code>public function toMiniProgram()
{
    return WechatMessage::miniProgram('app_name')->template($templateId)->formId($formId)->data([
        'first' => ''
        //
    ]);
}</code></pre>
2. 使用了triat“Notifiable”的model可以增加返回当前model对应的openid的方法：
* 返回公众号openid
<pre><code>public function routeNotificationForOfficialAccount($notification)
{
    // 返回当前model的公众号openid
    return ;
}</code></pre>
* 返回小程序openid
<pre><code>public function routeNotificationForMiniProgram($notification)
{
    // 返回当前model的小程序openid
    return ;
}</code></pre>
