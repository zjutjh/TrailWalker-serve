<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Helpers\UserState;

/**
 * @property mixed openid
 * @property null yx_group_id
 * @method static where(string $string, $captain_id)
 */
class User extends Model
{

    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'openid', 'id_card', 'birthday','healthycode_base64'
    ];


    protected $fillable = [
        'name', 'id_card', 'email', 'sex', 'qq', 'wx_id', 'height', 'birthday', 'phone', 'campus', 'school', 'sid', 'logo', 'identity', 'height', 'healthycode','healthycode_base64'
    ];

    protected $dates = [
        'start_at',
        'end_at'
    ];

    /**
     * 获得当前用户
     * @return User|null
     */
    public static function current()
    {
        $openid = session('openid');
        if ($openid === null) {
            return null;
        }
        $user = User::where("openid", $openid)->first();
        return $user;
    }

    /**
     * 获取所在的组
     * @return Group
     */
    public function group()
    {
        if ($this->group_id)
            return Group::where('id', $this->group_id)->first();

        return null;
    }


    /**
     * 获取报名人数
     * @return mixed
     */
    static public function getUserCount()
    {
        return User::where('state', '>', 0)->count();
    }

    /**
     * 离开队伍
     * @return bool
     */
    public function leaveGroup()
    {
        $this->group_id = null;
        $this->state = UserState::no_entered;
        return parent::save();
    }


    /**
     * 设置身份证信息
     * @param $value
     */
    public function setIdCardAttribute($value)
    {
        //$this->attributes['sex'] = iidGetSex($value);
        //$this->attributes['birthday'] = iidGetBirthday($value);
        //$this->attributes['id_card'] = encrypt_iid($value);
        $this->attributes['id_card'] = $value;
    }

    /**
     * 加入队伍
     * @param $groupId
     * @return bool
     */
    public function addGroup($groupId)
    {
        $this->group_id = $groupId;
        $this->update(['state' => UserState::member]);
        return parent::save();
    }
}
