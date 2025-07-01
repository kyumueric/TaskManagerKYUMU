@extends('layouts.partials')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1 class="text-center">Admin Dashboard</h1>
    </section>

    <section class="content">
        <!-- Centered Stats Boxes -->
        <div class="row justify-content-center">
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 class="text-center">{{ $stats['users_count'] }}</h3>
                        <p class="text-center">Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 class="text-center">{{ $stats['groups_count'] }}</h3>
                        <p class="text-center">Groups</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                    <a href="{{ route('admin.groups.index') }}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 class="text-center">{{ $stats['tasks_count'] }}</h3>
                        <p class="text-center">Tasks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="{{ route('tasks.index') }}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 class="text-center">{{ $stats['statuses_count'] }}</h3>
                        <p class="text-center">Statuses</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('admin.statuses.index') }}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Centered Editable Tasks Table Section -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-2 border-bottom">
                        <h5 class="mb-0 font-weight-bold">Task Management</h5>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="collapse" data-target="#taskTable">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 15%; min-width: 120px">User</th>
                                        <th style="width: 10%; min-width: 100px">Role</th>
                                        <th style="width: 20%; min-width: 150px">Task</th>
                                        <th style="width: 15%; min-width: 120px">Status</th>
                                        <th style="width: 15%; min-width: 120px">Complexity</th>
                                        <th style="width: 15%; min-width: 120px">Group</th>
                                        <th style="width: 10%; min-width: 80px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                    <tr data-task-id="{{ $task->id }}" class="border-bottom">
                                        <td class="align-middle text-nowrap">{{ $task->user->name }}</td>
                                        <td class="align-middle p-1">
                                            <select class="form-control form-control-sm role-select" data-user-id="{{ $task->user->id }}">
                                                <option value="0" {{ !$task->user->is_admin ? 'selected' : '' }}>User</option>
                                                <option value="1" {{ $task->user->is_admin ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </td>
                                        <td class="align-middle text-truncate p-1" style="max-width: 150px;" title="{{ $task->title }}">{{ $task->title }}</td>
                                        <td class="align-middle p-1">
                                            <select class="form-control form-control-sm status-select" data-task-id="{{ $task->id }}">
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status->id }}" {{ $task->status_id == $status->id ? 'selected' : '' }}>
                                                        {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="align-middle p-1">
                                            <select class="form-control form-control-sm complexity-select" data-task-id="{{ $task->id }}">
                                                @foreach($complexities as $complexity)
                                                    <option value="{{ $complexity->id }}" {{ $task->complexity_id == $complexity->id ? 'selected' : '' }}>
                                                        {{ $complexity->name }} ({{ $complexity->level }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="align-middle p-1">
                                            <select class="form-control form-control-sm group-select" data-user-id="{{ $task->user->id }}" multiple style="width: 100%;">
                                                @foreach($groups as $group)
                                                    <option value="{{ $group->id }}" 
                                                        {{ $task->user->groups->contains($group->id) ? 'selected' : '' }}>
                                                        {{ $group->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="align-middle text-center p-1">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit fa-xs"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger delete-task" data-task-id="{{ $task->id }}" title="Delete">
                                                    <i class="fas fa-trash fa-xs"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Custom Pagination -->
                        <div class="card-footer bg-white py-2 border-top">
                            <div class="d-flex justify-content-center">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0">
                                        @if ($tasks->currentPage() > 1)
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $tasks->previousPageUrl() }}" aria-label="Previous">
                                                    Previous
                                                </a>
                                            </li>
                                        @endif
                                        
                                        @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                                            <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        
                                        @if ($tasks->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $tasks->nextPageUrl() }}" aria-label="Next">
                                                    Next
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<style>
    /* Compact table styling */
    .table-sm td, .table-sm th {
        padding: 0.4rem 0.6rem;
    }
    
    /* Smaller form controls */
    .form-control-sm {
        min-height: calc(1.5em + 0.5rem + 2px);
        padding: 0.25rem 0.5rem;
        font-size: 0.8125rem;
    }
    
    /* Tight row spacing */
    .table tbody tr {
        height: 42px;
    }
    
    /* Compact pagination */
    .pagination-sm .page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.8125rem;
    }
    
    /* Select2 compact styling */
    .select2-container--bootstrap-5 .select2-selection {
        min-height: 30px;
        padding: 0.25rem 0.5rem;
    }
    
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered {
        display: flex;
        flex-wrap: wrap;
        gap: 2px;
        padding: 0;
    }
    
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
        margin: 0;
        padding: 0 4px;
        font-size: 0.75rem;
    }
    
    /* Card styling */
    .card {
        border-radius: 0.35rem;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.1);
    }
</style>

<script>
$(document).ready(function() {
    // Initialize select2 for groups with compact styling
    $('.group-select').select2({
        width: '100%',
        placeholder: "Select groups",
        allowClear: true,
        theme: 'bootstrap-5',
        dropdownCssClass: 'select2-dropdown-sm',
        minimumResultsForSearch: 5
    });

    // Update user role
    $('.role-select').change(function() {
        const userId = $(this).data('user-id');
        const isAdmin = $(this).val() === '1';
        
        $.ajax({
            url: '/admin/users/' + userId + '/update-role',
            method: 'PUT',
            data: {
                is_admin: isAdmin,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success('User role updated successfully');
                setTimeout(() => location.reload(), 1000);
            },
            error: function(xhr) {
                toastr.error('Error updating user role');
            }
        });
    });

    // Update task status
    $('.status-select').change(function() {
        const taskId = $(this).data('task-id');
        const statusId = $(this).val();
        
        $.ajax({
            url: '/tasks/' + taskId + '/update-status',
            method: 'PUT',
            data: {
                status_id: statusId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success('Task status updated successfully');
            },
            error: function(xhr) {
                toastr.error('Error updating task status');
            }
        });
    });

    // Update task complexity
    $('.complexity-select').change(function() {
        const taskId = $(this).data('task-id');
        const complexityId = $(this).val();
        
        $.ajax({
            url: '/tasks/' + taskId + '/update-complexity',
            method: 'PUT',
            data: {
                complexity_id: complexityId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success('Task complexity updated successfully');
            },
            error: function(xhr) {
                toastr.error('Error updating task complexity');
            }
        });
    });

    // Update user groups
    $('.group-select').change(function() {
        const userId = $(this).data('user-id');
        const groupIds = $(this).val() || [];
        
        $.ajax({
            url: '/admin/users/' + userId + '/update-groups',
            method: 'PUT',
            data: {
                group_ids: groupIds,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success('User groups updated successfully');
            },
            error: function(xhr) {
                toastr.error('Error updating user groups');
            }
        });
    });

    // Delete task
    $('.delete-task').click(function() {
        const taskId = $(this).data('task-id');
        
        if (confirm('Are you sure you want to delete this task?')) {
            $.ajax({
                url: '/tasks/' + taskId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success('Task deleted successfully');
                    $('tr[data-task-id="' + taskId + '"]').remove();
                },
                error: function(xhr) {
                    toastr.error('Error deleting task');
                }
            });
        }
    });
});
</script>
@endsection