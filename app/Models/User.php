<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'school_id',
        'role_id',

        'username',
        'name',
        'email',
        'password',
        'photo',
        'phone',
        'alternative_phone',
        'gender',
        'dob',
        'nid',
        'passport',
        'religion',
        'present_address',
        'permanent_address',
        'bio',
        'blood_group',

        'profile_complete',
        'timezone',
        'language',
        'theme_mode',

        'status',
        'ban_reason',
        'ban_until',
        'last_login_at',
        'email_verified_at',
        'post_code',
        'brn',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'status'            => 'boolean',
        ];
    }

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => getImage($value),
        );
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => getImage($value),
        );
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id', 'id');
    }

    public function routines()
    {
        return $this->hasMany(Routine::class, 'teacher_id', 'id');
    }

    public function proxyRoutines()
    {
        return $this->hasMany(Routine::class, 'proxy_teacher_id', 'id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

}
