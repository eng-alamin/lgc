<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const STATUS_PENDING   = 0;
    const STATUS_APPROVED  = 1;
    const STATUS_DEACTIVE  = 2;
    const STATUS_SUSPENDED = 3;
    const STATUS_BANNED    = 4;
    const STATUS_DELETED   = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

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
            'password' => 'hashed',
            'data' => 'array',
        ];
    }

    public function getRedirectRoute()
    {
        return match((string)$this->type) {
            'client' => 'dashboard',
            'agent' => 'agent/dashboard',
            'receptionist' => 'receptionist/dashboard',
            'writer' => 'writer/account/overview',
            'employee' => 'employee/dashboard',
            'admin' => 'admin/dashboard',
            'coo' => 'coo/dashboard',
            'cfo' => 'cfo/dashboard',
            'ceo' => 'ceo/dashboard',
            'super_admin' => 'admin/dashboard',
        };
    }
    public function isOnline(): bool
    {
        return Cache::has('user-is-online:' . $this->id);
    }
    public function isAgent()
    {
        return $this->type === 'agent';
    }
    public function isWriter()
    {
        return $this->type === 'writer';
    }
    public function isReceptionist()
    {
        return $this->type === 'receptionist';
    }
    public function isEmployee()
    {
        return $this->type === 'employee';
    }
    public function isAdmin()
    {
        return in_array($this->type, ['admin', 'super_admin']);
    }

    public function isSuperAdmin()
    {
        return $this->type === 'super_admin';
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
