<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    // Show the roles and permissions form
    public function roles_permissions()
    {
        // Fetch all roles and permissions, group them by role label
        $roles_permissions = RolePermission::withTrashed()->get()->groupBy('role_label')->toArray();
        return view('roles_permissions', compact('roles_permissions'));
    }

    // Save changes to the permissions
    public function role_permission_save(Request $request)
    {
        if ($request->has('create_new_permission')) {
            $roleId = $request->input('new_permission_role');
            $name = $request->input('new_permission_name');
        
            RolePermission::create([
                'role' => $roleId,
                'permission' => $name,
            ]);
        
            return back()->with('success', 'Permission created.');
        }

        $request->validate([
            'permissions' => 'nullable|array',
        ]);
    
        $submittedPermissions = $request->input('permissions', []);
    
        // Get all roles from the RolePermission::$roleLabels map
        foreach (RolePermission::ROLE_LABELS as $roleId => $roleLabel) {
            $submittedIds = $submittedPermissions[$roleLabel] ?? []; // Get submitted IDs for this role
    
            // Fetch all permissions for this role including trashed
            $allPermissions = RolePermission::withTrashed()
                ->where('role', $roleId)
                ->get();
    
            foreach ($allPermissions as $permission) {
                if (in_array($permission->id, $submittedIds)) {
                    // Restore if it was soft-deleted
                    if ($permission->trashed()) {
                        $permission->restore();
                    }
                } else {
                    // Soft-delete if it wasn't checked
                    if (!$permission->trashed()) {
                        $permission->delete();
                    }
                }
            }
        }
    
        return back()->with('success', 'Permissions updated successfully.');
    }
      

    // Delete a permission manually (this deletes a permission outright, not just soft deletes)
    public function role_permission_delete($id)
    {
        $permission = RolePermission::find($id);

        if ($permission) {
            $permission->forceDelete(); // Soft delete the permission
            return back()->with('success', 'Permission deleted successfully.');
        }

        return back()->with('error', 'Permission not found.');
    }
}
