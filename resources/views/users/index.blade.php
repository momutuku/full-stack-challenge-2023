@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Users</h1>
                    </div>
                    {{-- <div>@include('partials.filterReferrals') @include('partials.createReferralButton')</div> --}}
                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <table class="table" id="users">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email No</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }} </td>
                                        <td>{{ $user->email }} </td>
                                        <td>{{ $user->role }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-footer">
                        <p><b>Total Users:</b> {{ $users->count() }}</p>
                       <a class="btn btn-success" href="/register">Register</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @can('edituser')
        <!-- Comment Form Modal -->
        <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel">Edit Deatils for: <span id="username"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/users/update">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="comment">Name:</label>
                                <input type="text" id="uname" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label for="comment">Email:</label>
                                <input type="email" id="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="comment">Role:</label>
                                <select name="role" id="roles">
                                    <option value="admin">Admin</option>
                                    <option value="executive">Executive</option>
                                    <option value="supervisor">Supervisor</option>
                                </select>
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" value="Save"> SAVE</button>
                                

                            </div>
                        </form>
                        <form method="POST" action="/users/delete">
                            {{ csrf_field() }}
                            <input type="hidden" id="delemail" name="email">
                            <button type="submit" class="btn btn-danger" id="deleteButton">DELETE</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endcan
    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {

            $('#saveButton').on('click', function() {
                console.log('Cilcked');
                document.getElementById('action').value = 'save';
            });

            var table = $j('#users').DataTable();

            table.on('click', 'tbody tr', function() {
                var data = table.row(this).data();
                var username = data[0];

                $('#username').text(data[0]);
                $('#uname').val(username);
                $('#email').val(data[1]);
                $('#delemail').val(data[1]);
                $('#roles').val(data[2]);
                console.log(data[1]);
                $('#commentModal').modal('show');
            });
        });
    </script>
@endsection
