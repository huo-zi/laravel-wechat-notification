<?php
namespace Huozi\LaravelWechatNotification\Messages;

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
        return new OfficateAccountTemplateMessage($this->platform->officialAccount($appId, $refreshToken, $accessToken));
    }

    public function miniProgram($appId, $refreshToken = null, $accessToken = null)
    {
        return new MiniProgramTemplateMessage($this->platform->miniProgram($appId, $refreshToken, $accessToken));
    }

}
