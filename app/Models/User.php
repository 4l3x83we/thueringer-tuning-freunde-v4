<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use App\Models\Intern\Admin\LoginHistories;
use App\Models\Intern\Kalender\Kalender;
use App\Notifications\WillkommenNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, ReceivesWelcomeNotification, LogsActivity;

    protected $table = 'users';

    protected static $logAttributes = ['name', 'email'];

    protected static $ignoreChangedAttributes = ['password', 'updated_at'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'user';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Sie haben {$eventName} Benutzer";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login_ip',
        'last_login_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function fahrzeuges()
    {
        return $this->hasMany(Fahrzeug::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function teams()
    {
        return $this->hasOne(Team::class, 'user_id');
    }

    public function sendWelcomeNotification(Carbon $validUntil)
    {
        $this->notify(new WillkommenNotification($validUntil));
    }

    public function login_histories()
    {
        return $this->hasMany(LoginHistories::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('User')
            ->dontSubmitEmptyLogs();
    }

    public static function userActivity($id)
    {
        return self::where('id', $id)->first()->name;
    }
}
