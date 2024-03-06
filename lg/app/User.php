<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company', 'address', 'phone', 'mobile', 'avatar', 'account_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function opportunities()
    {
        return $this->hasMany("App\Opportunity");
    }

    function notifications()
    {
        return $this->belongsToMany("App\Notification", "users_notifications", "user_id", "notification_id")->where("dismissed", false);

    }

    function allNotifications()
    {
        return $this->belongsToMany("App\Notification", "users_notifications", "user_id", "notification_id");
    }

    function setMessages()
    {
        return $this->hasMany("App\Contacts", "user_id", "id");
    }

    function level()
    {

        $target = $this->target();
        if ($target)
            return Level::find($target->level_id);
        return false;
    }

    function target()
    {
        $q = DB::select(DB::raw("SELECT
                              t.*,
                              l.id as level_id
                            FROM levels l
                              INNER JOIN
                              (SELECT
                                 `users`.`id`                   AS `user_id`,
                                 `users`.`name`                 AS `user_name`,
                                 SUM(opportunities.total_price) AS `total_target`
                               FROM users
                                 INNER JOIN `opportunities` ON `users`.`id` = `opportunities`.`user_id`
                                 AND `opportunities`.`status`=2
                               WHERE `users`.`deleted_at` IS NULL
                               GROUP BY users.id, users.name) t ON t.total_target >= l.min AND t.total_target <= l.target ORDER BY l.id DESC LIMIT 1"));
        if ($q) {
            return $q[0];
        }
        return false;
    }
}
