<?php
namespace Huozi\LaravelWechatNotification;

use Huozi\LaravelWechatNotification\Messages\WechatWorkMessage;

class WechatOpenWork
{

    public $openWork;

    /**
     * @param \EasyWeChat\OpenWork\Application $openWork
     */
    public function __construct($openWork)
    {
        $this->openWork = $openWork;
    }

    /**
     * Undocumented function
     *
     * @param mixed $authCorpId
     * @param string $permanentCode
     */
    public function work($authCorpId, $permanentCode = null)
    {
        $work = $authCorpId instanceof \Closure ? $authCorpId($this->openWork) : $this->openWork->work($authCorpId, $permanentCode);
        return new WechatWorkMessage($work->message);
    }

    
}

