<?php

namespace App\Notifications;

use App\WechatTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;


class Wechat extends Notification implements ShouldQueue
{
    use Queueable;
    private $data;

    public function __construct($data = WechatTemplate::Test)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return [\App\Channels\wechatChannel::class];
    }

    public function toWechat($notifiable)
    {

        $data = $this->data;
        $data['keyword3'] = date('Y-m-d H:i:s', time());
        return [
            'openid' => $notifiable->openid,
            'url' => 'https://walk.zjutjh.com',
            'data' => $data
        ];
    }
}
