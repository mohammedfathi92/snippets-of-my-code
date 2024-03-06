<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Traits\Hookable;
use Packages\Foundation\Traits\HashTrait;
use Packages\Foundation\Traits\ModelHelpersTrait;
use Packages\Foundation\Transformers\PresentableTrait;
use Packages\Modules\CMS\Models\Content;
use Packages\Settings\Traits\CustomFieldsModelTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;
use Spatie\Permission\Traits\HasRoles;
use Yajra\Auditable\AuditableTrait;
use Packages\User\Traits\TwoFactorAuthenticatable;
use Packages\User\Contracts\TwoFactorAuthenticatableContract;
use Spatie\Translatable\HasTranslations;
use Packages\Modules\ERP\Models\Country;
use Packages\Modules\ERP\Models\City;


class UserErp extends Authenticatable implements HasMediaConversions, TwoFactorAuthenticatableContract
{
    use TwoFactorAuthenticatable, Notifiable, HashTrait, HasRoles,
        Hookable, PresentableTrait, LogsActivity, HasMediaTrait, AuditableTrait, CustomFieldsModelTrait, ModelHelpersTrait, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'user.models.user';

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

    protected $table = "users";

        public $translatable = ['translated_name','translated_nick_name', 'user_notes', 'about_user'];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'two_factor_options'
    ];

    protected $casts = [
        'address' => 'json',
        'notification_preferences' => 'array'
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



   public function getPassportImageAttribute()
    {
        $media = $this->getFirstMedia('passport-image');
        if ($media) {
            return $media->getUrl();
        } else {
            return asset(config($this->config . '.default_image'));
        }
    }




    public function getPictureThumbAttribute()
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

    public function nationality(){
        return $this->belongsTo(Country::class, 'nationality_id');
    }
  public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
     public function agent(){
        return $this->belongsTo(self::class, 'agent_id');
    }

   public function accounts(){
        return $this->hasMany(Account::class, 'user_id');
    }
}

