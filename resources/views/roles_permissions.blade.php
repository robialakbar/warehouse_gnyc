@extends('layouts.main')

@section('title', __("Roles' Permissions"))

@section('custom-css')
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h2 class="mb-3">Roles & Permissions</h2>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="m-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPermissionModal">
                    Create Permission
                </button>
            </div>

            <!-- Create Permission Modal -->
            <div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog" aria-labelledby="createPermissionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{ route('roles_permissions.save') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createPermissionModalLabel">Create Permission</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="new_permission_role" class="form-control" required>
                                        @foreach(\App\Models\RolePermission::ROLE_LABELS as $roleId => $label)
                                            <option value="{{ $roleId }}">{{ ucfirst($label) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="permission">Permission Name</label>
                                    <input type="text" name="new_permission_name" class="form-control" placeholder="e.g. edit-product" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="create_new_permission" value="1" class="btn btn-primary">Add Permission</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Save Changes Form -->
            <form id="rolesPermissionsForm" method="POST" action="{{ route('roles_permissions.save') }}">
                @csrf

                <div class="accordion" id="permissionsAccordion">
                    @forelse($roles_permissions as $roleLabel => $permissions)
                        <div class="card">
                            <div class="card-header" id="heading-{{ $loop->index }}">
                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-{{ $loop->index }}">
                                        {{ ucfirst($roleLabel) }}
                                    </button>
                                    <span class="badge badge-primary">{{ count($permissions) }} permission(s)</span>
                                </h5>
                            </div>

                            <div id="collapse-{{ $loop->index }}" class="collapse show" data-parent="#permissionsAccordion">
                                <div class="card-body">
                                    @foreach($permissions as $permission)
                                        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-1">
                                            <!-- Checkbox for Permissions -->
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="permissions[{{ $roleLabel }}][]"
                                                    value="{{ $permission['id'] }}"
                                                    id="perm_{{ $permission['id'] }}"
                                                    @if($permission['deleted_at'] == null) checked @endif
                                                >
                                                <label class="form-check-label" for="perm_{{ $permission['id'] }}">
                                                    {{ $permission['permission'] }}
                                                </label>
                                            </div>

                                            <!-- Delete Icon for Permission -->
                                            <form action="{{ route('roles_permissions.delete', $permission['id']) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Permission">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">No permissions found.</div>
                    @endforelse
                </div>

                <!-- Save Button -->
                <div class="text-right mt-3">
                    <button onClick="document.getElementById('rolesPermissionsForm').submit();" type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('custom-js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
