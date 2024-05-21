<?php
namespace App\Models\AdminModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// CGPT stuff
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class Admin extends Model
class Admin extends Authenticatable
{
    // use HasFactory;
    use Notifiable;
    
    protected $fillable = [
        'username', 'name', 'email', 'password', 'account_active', 'role_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }
}
