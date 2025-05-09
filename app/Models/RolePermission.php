<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use SoftDeletes;

    protected $table = 'roles_permissions';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'role',
        'permission',
    ];

    protected $appends = ['role_label'];

    /**
     * Map of role integers to readable labels
     */
    public const ROLE_LABELS = [
        0 => 'admin',
        1 => 'user',
    ];

    /**
     * Accessor for role_label (used in array/json output)
     */
    public function getRoleLabelAttribute(): string
    {
        return self::ROLE_LABELS[$this->role] ?? 'unknown';
    }

    /**
     * Optional: reverse relation to users by role (many users can share the same role)
     */
    public function userRole()
    {
        return $this->belongsTo(User::class, 'role', 'role');
    }
}
