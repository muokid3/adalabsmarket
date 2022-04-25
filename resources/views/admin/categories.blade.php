@extends('layouts.dash')

@push('js')
    <script>
        $(document).on('submit', '.del_category_form', function() {
            if (confirm('Are you sure you want to delete the category?')) {
                return true;
            }
            return false;
        });

        $(document).on('click', '.add-category-btn', function() {
            var _Form = $('#category-form');

            $('#id').val('');
            $('#category_name').val('');

            // set the add url
            var action = '/admin/categories';
            //console.log(action);
            _Form .attr('action', action);
            $('#category-modal').modal('show');
        });

        $(document).on('click', '.edit-category-btn', function() {
            var _Btn = $(this);
            var _id = _Btn.attr('item-id'),
                _Form = $('#category-form');

            if (_id !== '') {
                $.ajax({
                    url: _Btn.attr('source'),
                    type: 'get',
                    dataType: 'json',

                    success: function(data) {
                        console.log(data);
                        // populate the modal fields using data from the server
                        //$('#category_id').val(data['category_id']).trigger('change');;
                        $('#category_name').val(data['category_name']);
                        $('#id').val(data['id']);

                        // set the update url
                        var action = '/admin/category/update';
                        //console.log(action);
                        _Form .attr('action', action);

                        // open the modal
                        $('#category-modal').modal('show');
                    }
                });
            }
        });

    </script>
@endpush

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-icon card-header-rose">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title ">Product Categories</h4>
                                <button class="btn btn-success btn-sm add-category-btn">
                                    Add Category
                                </button>
                            </div>
                            <div class="card-body">

                                @include('layouts.common.error')
                                @include('layouts.common.info')
                                @include('layouts.common.success')
                                @include('layouts.common.warnings')
                                @include('layouts.common.warning')

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Created At
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>
                                                {{$category->id}}
                                            </td>
                                            <td>
                                                {{$category->category_name}}
                                            </td>
                                            <td>
                                                {{$category->created_at}}
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-category-btn"
                                                        source="{{route('edit-category' ,  $category->id)}}"
                                                        item-id="{{$category->id}}">Edit</button>

                                               <form action="{{url('admin/categories/delete')}}" style="display: inline;" method="POST"
                                                     class="del_category_form">
                                                   @csrf
                                                   <input type="hidden" name="category_id" value="{{$category->id}}">
                                                   <button class="btn btn-danger btn-sm">Delete</button>
                                               </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Product Category</h4>
                </div>
                <div class="modal-body" >
                    <form action="{{ url('admin/categories') }}" method="POST" id="category-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category_name" class="bmd-label-floating">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                        </div>

                        {{--hidden fields--}}
                        <input type="hidden" name="id" id="id"/>
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
                            <button class="btn btn-success" type="submit" id="save-brand"><i class="material-icons">save</i> Save</button>
                        </div>
                    </form>

                </div>

                <!--<div class="modal-footer">-->
                <!---->
                <!--</div>-->
            </div>
        </div>
    </div>

@endsection
