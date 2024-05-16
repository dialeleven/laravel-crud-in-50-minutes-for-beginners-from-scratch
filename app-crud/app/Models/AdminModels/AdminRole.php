<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'role_id');
    }
}
