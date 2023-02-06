<?php

namespace App;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['image'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', "'confirm-password'"
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_login_at',
    ];

    public function lastLogin()
    {
        $lastLogin = $this->last_login_at ?? null;

        if ($lastLogin == null) {
            $lastLogin = trans("lang.user_not_loged_in");
        } else {
            $lastLogin =  $lastLogin->diffForHumans();
        }

        return $lastLogin;
    }

    // get profile image src
    public function getImageAttribute()
    {
        return url($this->path);
    }

}
