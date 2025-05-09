<?php

use App\Models\User;

if (!function_exists('user_has_permission')) {
    function user_has_permission(int|User $user, string $permission): bool
    {
        if (is_int($user)) {
            $user = User::with('roles_permissions')->find($user);
        } elseif (!$user->relationLoaded('roles_permissions')) {
            $user->load('roles_permissions');
        }

        return $user->roles_permissions
            ->whereNull('deleted_at')
            ->pluck('permission')
            ->contains($permission);
    }
}
