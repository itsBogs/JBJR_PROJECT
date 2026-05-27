<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserAccount extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user_accounts';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'is_active',
        'must_change_password',
        'avatar',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'user_account_id');
    }
}               