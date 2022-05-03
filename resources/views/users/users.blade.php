@extends('layouts.dash')
@push('js')
    <script>

        $(function() {
            var _ModalTitle = $('#user-modal-title'),
                _Form = $('#user-form');

            // edit   product
            $(document).on('click', '.edit-user-btn', function() {
                var _Btn = $(this);
                var _id = _Btn.attr('acs-id'),
                    _Form = $('#user-form');

                if (_id !== '') {
                    $.ajax({
                        url: _Btn.attr('source'),
                        type: 'get',
                        dataType: 'json',
                        beforeSend: function() {
                            _ModalTitle.text('Edit');
                        },
                        success: function(data) {
                            console.log(data);
                            // populate the modal fields using data from the server
                            $('#name').val(data['name']);
                            $('#email').val(data['email']);
                            $("#user_group").val(data['user_group']).change();
                            $('#id').val(data['id']);

                            // set the update url
                            var action =  '/admin/users/update';
                            // action = action + '/' + season_id;
                            // console.log(action);
                            _Form .attr('action', action);

                            // open the modal
                            $('#user-modal').modal('show');
                        }
                    });
                }
            });

            $(document).on('click', '.add-user-btn', function() {
                var _Form = $('#user-form');

                _ModalTitle.text('Add');

                $('#id').val('');
                $('#name').val('');
                $('#email').val('');
                $("#user_group").val('').change();

                // set the add url
                var action = '/admin/users/create';
                //console.log(action);
                _Form .attr('action', action);
                $('#user-modal').modal('show');
            });




        });
    </script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">list</i>
                        </div>
                        <h4 class="card-title">All Users</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <button class="btn btn-primary btn-sm add-user-btn">
                                <i class="fa fa-plus"></i> Add New User
                            </button>
                        </div>
                        @include('layouts.common.success')
                        @include('layouts.common.warnings')
                        <div id="successView" class="alert alert-success" style="display:none;">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong><span id="successData"></span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{$user->id}}
                                        </td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{optional($user->role)->name}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>

                                        <td>
                                            <button class="btn btn-info btn-sm edit-user-btn"
                                                    source="{{route('edit-user' ,   $user->id)}}"
                                                    item-id="{{$user->id}}">Edit</button>

                                            <form action="{{url('admin/users/delete')}}" style="display: inline;" method="POST"
                                                  class="del_user_form">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>

    {{--modal--}}
    <div class="modal fade" id="user-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <span id="user-modal-title">Add </span> New User</h4>
                </div>
                <div class="modal-body" >
                    <form action="{{ url('admin/users/create') }}" method="post" id="user-form" enctype="multipart/form-data">
                       @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group ">
                                    {{--<label class="control-label" for="user_role" style="line-height: 6px;">User Role</label>--}}

                                        <div class="dropdown bootstrap-select show-tick">
                                            <select class="selectpicker" data-style="select-with-transition" title="Choose User Group" tabindex="-98"
                                                    name="user_group" id="user_group" required>
                                                @foreach( $userGroups as $userGroup)
                                                    <option value="{{ $userGroup->id  }}">{{ $userGroup->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="email" class="form-control pb-0 mt-2" name="email" id="email" required/>
                                </div>
                            </div>

                        </div>



                        <input type="hidden" name="id" id="id"/>
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
                            <button class="btn btn-success" id="save-brand"><i class="material-icons">save</i> Save</button>
                        </div>

                    </form>
                    {{--hidden fields--}}

                </div>

                <!--<div class="modal-footer">-->
                <!---->
                <!--</div>-->
            </div>
        </div>
    </div>
@endsection
