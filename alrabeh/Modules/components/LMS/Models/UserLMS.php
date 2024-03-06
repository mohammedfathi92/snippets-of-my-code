<?php

namespace Modules\Components\LMS\Models;


use Illuminate\Notifications\Notifiable;
use Modules\Components\CMS\Models\Content;
use Modules\Components\Utility\Traits\Rating\ReviewRateable as ReviewRateableTrait;
use Modules\Foundation\Traits\HashTrait;
use Modules\Foundation\Traits\Hookable;
use Modules\Foundation\Traits\Language\Translatable;
use Modules\Foundation\Traits\ModelHelpersTrait;
use Modules\Foundation\Traits\ModelPropertiesTrait;
use Modules\Foundation\Transformers\PresentableTrait;
use Modules\Settings\Traits\CustomFieldsModelTrait;
use Modules\User\Contracts\TwoFactorAuthenticatableContract;
use Modules\User\Models\User;
use Modules\User\Traits\TwoFactorAuthenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;
use Spatie\Permission\Traits\HasRoles;
use Yajra\Auditable\AuditableTrait;


class UserLMS extends User implements HasMediaConversions, TwoFactorAuthenticatableContract
{

    use TwoFactorAuthenticatable, Notifiable, HashTrait, HasRoles, ModelPropertiesTrait,
        Hookable, PresentableTrait, LogsActivity, HasMediaTrait, AuditableTrait,
        CustomFieldsModelTrait, ModelHelpersTrait, ReviewRateableTrait, Translatable;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'user.models.user';
    protected $table = "users";

    protected static $logAttributes = ['name', 'email'];

    protected static $ignoreChangedAttributes = ['remember_token'];

    protected $appends = ['picture', 'picture_thumb'];

    protected $dates = ['trial_ends_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'two_factor_options'
    ];

    protected $casts = [
        'address'                  => 'json',
        'notification_preferences' => 'array',
        'properties'               => 'json'
    ];

    public function __construct(array $attributes = [])
    {
        $config = config($this->config);

        if (isset($config['presenter'])) {
            $this->setPresenter(new $config['presenter']);
            unset($config['presenter']);
        }

        foreach ($config as $key => $val) {
            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
            }
        }

        return parent::__construct($attributes);
    }

    public function address($type)
    {
        return $this->address[$type] ?? [];
    }

    public function getConfirmedAttribute()
    {
        return !is_null($this->confirmed_at);
    }

    public function display_address($type)
    {
        $address = $this->address[$type];

        if (!$address) {
            return "";
        }
        $display_address = "";

        $display_address .= $address['address_1'] . "<br>";

        if ($address['address_2']) {
            $display_address .= $address['address_2'] . "<br>";
        }
        $display_address .= $address['city'] . ' ' . $address['state'] . ' ' . $address['zip'] . "<br>";
        $display_address .= $address['country'];
        return $display_address;
    }

    public function saveAddress($address, $type)
    {
        $user_address = $this->address;
        if (!is_array($user_address)) {
            $user_address = [];
        }
        $user_address[$type] = $address;
        $this->address = $user_address;
        $this->save();
    }

    public function hasPermissionTo($permission, $guardName = null): bool
    {
        if (isSuperUser()) {
            return true;
        }

        if (is_string($permission)) {
            $permission = app(Permission::class)->findByName(
                $permission,
                $guardName ?? $this->getDefaultGuardName()
            );
        }

        if (!$permission) {
            return false;
        }

        return $this->hasDirectPermission($permission) || $this->hasPermissionViaRole($permission);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getPictureAttribute()
    {
        $media = $this->getFirstMedia('user-picture');
        if ($media) {
            return $media->getUrl();
        } else {
            $id = $this->attributes['id'] ?? 1;
            $avatar = 'avatar_' . ($id % 10) . '.png';
            return asset(config($this->config . '.default_picture') . $avatar);
        }
    }

    public function getPictureThumbAttribute()
    {
        $media = $this->getFirstMedia('user-picture');
        if ($media) {
            return $media->getUrl('thumb');
        } else {
            $id = $this->attributes['id'] ?? 1;
            $avatar = 'avatar_' . ($id % 10) . '.png';
            return asset(config($this->config . '.default_picture') . $avatar);
        }
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10);
    }

    public function posts()
    {
        return $this->morphToMany(Content::class, 'postable');

    }

    public function getDashboardURL()
    {
        $dashoard_url = 'dashboard';
        $dashoard_url = \Filters::do_filter('dashboard_url', $dashoard_url);
        return url($dashoard_url);

    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class, 'user_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'user_id');

    }


    public function logs()
    {
        return $this->hasMany(Logs::class, 'user_id');
    }


}
