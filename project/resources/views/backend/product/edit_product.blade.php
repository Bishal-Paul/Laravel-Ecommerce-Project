@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Edit Product</h4>
                        
                        @if(session('message'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('message')}}.
                        </div>
                        @endif

                        <form class="form-horizontal" role="form" method="post" action="{{ url('update-product') }}" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group row">
                                <label for="product_name" class="col-3 col-form-label">Product Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ $product->product_name }}">
                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-3 col-form-label">Product Slug</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ $product->slug }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_id" class="col-3 col-form-label">Category</label>
                                <div class="col-9">
                                    
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach($category as $cat)
                                        <option @if($product->category_id == $cat->id) selected @endif value="{{ $cat->id ?? "NULL" }}">{{ $cat->category_name ?? "NULL" }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subcategory_id" class="col-3 col-form-label">Sub Category </label>
                                <div class="col-9">
                                    <select class="form-control" name="subcategory_id" id="subcategory_id"> 
                                        <option @if($product->subcategory_id) selected @endif value="{{ $product->subcategory->id ?? "NULL" }}">{{ $product->subcategory->subcategory_name ?? "NULL" }}</option>
                                     </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_price" class="col-3 col-form-label">Product Price</label>
                                <div class="col-9">
                                    <input type="number" class="form-control @error('product_price') is-invalid @enderror" name="product_price" value="{{ $product->product_price }}">
                                    @error('product_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discount_price" class="col-3 col-form-label">Product Price</label>
                                <div class="col-9">
                                    <input type="number" class="form-control @error('discount_price') is-invalid @enderror" name="discount_price" value="{{ $product->discount_price }}">
                                    @error('discount_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_quantity" class="col-3 col-form-label">Product Quantity</label>
                                <div class="col-9">
                                    <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" name="product_quantity" value="{{ $product->product_quantity ?? 'NULL' }}">
                                    @error('product_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_summary" class="col-3 col-form-label">Product Summary</label>
                                <div class="col-9">
                                    <textarea name="product_summary" class="form-control">{{ $product->product_summary ?? "NULL" }}</textarea>
                                    @error('product_summary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_description" class="col-3 col-form-label">Product Description</label>
                                <div class="col-9">
                                    <textarea name="product_description" class="form-control">{{ $product->product_description ?? "NULL" }}</textarea>
                                    @error('product_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_size" class="col-3 col-form-label">Product Size</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('product_size') is-invalid @enderror" name="product_size" value="{{ $product->product_size ?? 'NULL' }}">
                                    @error('product_size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_color" class="col-3 col-form-label">Product Color</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('product_color') is-invalid @enderror" name="product_color" value="{{ $product->product_color ?? 'NULL' }}">
                                    @error('product_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_thumbnail" class="col-3 col-form-label">Preview Product Thumbnail</label>
                                <div class="col-9">
                                    <img src="{{ asset('thumbnail/product/'.$product->product_thumbnail ?? 'NULL') }}" alt="{{ $product->product_name }}" width="100px">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_thumbnail" class="col-3 col-form-label">Add New Thumbnail</label>
                                <div class="col-9">
                                <input type="file" class="form-control @error('product_thumbnail') is-invalid @enderror" name="product_thumbnail">
                                    @error('product_thumbnail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-0 justify-content-end row text-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
@endsection


@section('footer_js')
<script>
        $('#product_name').keyup(function(){
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

        $('#category_id').change(function(){
            var cat_id = $(this).val();

            if (cat_id) {
                $.ajax({
                    type:"GET",
                    url:"{{ url('api/get-category-list')}}/"+cat_id,
                    success:function(res){
                        if(res){
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option> Select One </option>');
                            $.each(res, function(key,value){
                                $('#subcategory_id').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                            });
                        }
                        else{
                            $('#subcategory_id').empty(); 
                        }
                    }
                });
            }
            else{
                 $('#subcategory_id').empty();
            }
        });
</script>
@endsection