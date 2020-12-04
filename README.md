# laravel-wechat-notification
这是一个laravel框架下使用微信模板消息作为notification通道的composer包

使用方式：
public function via($notifiable)
{
    return ['official_account'];
}

public function toOfficialAccount()
{
    return WechatMessage::officialAccount('app_name')->template('templateId')->data(['fisrt'=>'...']);
}
