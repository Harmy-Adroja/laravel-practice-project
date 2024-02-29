<?php

namespace App\Models;

use App\Models\User;
use Laravel\Passport\HasApiTokens;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'avatar',
        'password',
        
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

    public function getIsAdminAttribute(): bool
    {
        $admins = ['harmy.adroja@gmail.com'];
        return in_array($this->email, $admins);
    }

    public function tickets(): hasMany
    {
        return $this->hasMany(Ticket::class);
    }

    // public function getUsernameAttribute($username)
    // {
    //     return $this->attributes['username'] = strtoupper($username);
    // }
   
    

//     public function setPasswordAttribute($password)
// {
//     //dd(Hash::make($password));
//     //if(Hash::needsRehash($password)) 
//         $password = Hash::make($password);

//     $this->attributes['password'] = $password;
// }
}
