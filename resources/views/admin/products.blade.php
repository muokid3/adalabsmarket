@extends('layouts.dash')

@push('js')
    <script>
        $(document).on('submit', '.del_product_form', function() {
            if (confirm('Are you sure you want to delete the product?')) {
                return true;
            }
            return false;
        });

        $(document).on('click', '.add-product-btn', function() {
            var _Form = $('#product-form');

            $('#id').val('');
            $('#product_name').val('');
            $('#price').val('');
            $('#is_featured').prop('checked', false);

            // set the add url
            var action = '/admin/products';
            //console.log(action);
            _Form .attr('action', action);
            $('#product-modal').modal('show');
        });

        $(document).on('click', '.edit-product-btn', function() {
            var _Btn = $(this);
            var _id = _Btn.attr('item-id'),
                _Form = $('#product-form');

            if (_id !== '') {
                $.ajax({
                    url: _Btn.attr('source'),
                    type: 'get',
                    dataType: 'json',

                    success: function(data) {
                        console.log(data);
                        // populate the modal fields using data from the server
                        $('#category_id').val(data['category_id']).trigger('change');
                        $('#product_name').val(data['product_name']);
                        $('#price').val(data['price']);

                        if (data['is_featured'] === 1){
                            $('#is_featured').prop('checked', true);
                        }else {
                            $('#is_featured').prop('checked', false);
                        }
                        $('#id').val(data['id']);

                        // set the update url
                        var action = '/admin/product/update';
                        //console.log(action);
                        _Form .attr('action', action);

                        // open the modal
                        $('#product-modal').modal('show');
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
                                <h4 class="card-title ">Products</h4>
                                <button class="btn btn-success btn-sm add-product-btn">
                                    Add Product
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Featured</th>
                                        <th>Action</th>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{\Illuminate\Support\Facades\Storage::url($product->image_url)}}" alt="..." width="70px">
                                            </td>
                                            <td>
                                                {{$product->product_name}}
                                            </td>
                                            <td>
                                                {{optional($product->category)->category_name}}
                                            </td>
                                            <td>
                                                {{$product->price}}
                                            </td>
                                            <td>
                                                {{$product->is_featured ? 'YES' : 'NO'}}
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-product-btn"
                                                        source="{{route('edit-product' ,  $product->id)}}"
                                                        item-id="{{$product->id}}">Edit</button>

                                               <form action="{{url('admin/products/delete')}}" style="display: inline;" method="POST"
                                                     class="del_product_form">
                                                   @csrf
                                                   <input type="hidden" name="product_id" value="{{$product->id}}">
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



    <div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Product Category</h4>
                </div>
                <div class="modal-body" >
                    <form action="{{ url('admin/products') }}" method="POST" id="product-form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="selectpicker" data-style="select-with-transition" title="Product category"
                                            name="category_id" id="category_id" >
                                        <option disabled> Select Category</option>
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_name" class="bmd-label-floating">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name">
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="bmd-label-floating">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" name="is_featured" id="is_featured">
                                        <span class="toggle"></span>
                                        Is Featured
                                    </label>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <label for="image">Select Image:</label>
                                    <input type="file" id="image" class="form-control" name="image" >
                                </div>
                            </div>

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
