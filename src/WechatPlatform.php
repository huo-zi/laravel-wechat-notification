<?php
namespace Huozi\LaravelWechatNotification;

use Huozi\LaravelWechatNotification\Messages\MiniProgramTemplateMessage;
use Huozi\LaravelWechatNotification\Messages\OfficateAccountTemplateMessage;

class WechatPlatform
{

    /**
     *
     * @var \EasyWeChat\OpenPlatform\Application
     */
    private $platform;

    public function __construct($platform)
    {
        $this->platform = $platform;
    }

    public function officateAccount($appId, $refreshToken = null, $accessToken = null)
    {
        $app = $appId instanceof \Closure ? $appId($this->platform) : $this->platform->officialAccount($appId, $refreshToken, $accessToken);
        return new OfficateAccountTemplateMessage($app);
    }

    public function miniProgram($appId, $refreshToken = null, $accessToken = null)
    {
        $app = $appId instanceof \Closure ? $appId($this->platform) : $this->platform->miniProgram($appId, $refreshToken, $accessToken);
        return new MiniProgramTemplateMessage($app);
    }

}
