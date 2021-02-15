@extends('backend.master')

@section('content')
    <!-- Start Page content -->
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Add Product</h4>
                        
                        @if(session('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif

                        <form method="post" action="{{url('post-product')}}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label for="product_name" class="col-3 col-form-label">Product Name *</label>
                                <div class="col-9">
                                    <input type="text" id="product_name" class="form-control @error('product_name') is-invalid @enderror" name="product_name" placeholder="Ex: Home & Garden">
                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="slug" class="col-3 col-form-label">Product Slug *</label>
                                <div class="col-9">
                                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category_id" class="col-3 col-form-label">Product Category *</label>
                                <div class="col-9">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
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
                                <label for="subcategory_id" class="col-3 col-form-label">Product Sub Category</label>
                                <div class="col-9">
                                    <select name="subcategory_id" id="subcategory_id" class="form-control"></select>  
                                    @error('subcategory_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_price" class="col-3 col-form-label">Product Price *</label>
                                <div class="col-9">
                                    <input type="number" name="product_price" class="form-control @error('product_price') is-invalid @enderror">
                                    @error('product_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discount_price" class="col-3 col-form-label">Discount Price </label>
                                <div class="col-9">
                                    <input type="number" name="discount_price" class="form-control @error('discount_price') is-invalid @enderror">
                                    @error('discount_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_quantity" class="col-3 col-form-label">Product Quantity *</label>
                                <div class="col-9">
                                    <input type="number" name="product_quantity" class="form-control @error('product_quantity') is-invalid @enderror">
                                    @error('product_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_summary" class="col-3 col-form-label">Short Summary *</label>
                                <div class="col-9">
                                    <textarea name="product_summary" class="form-control @error('product_summary') is-invalid @enderror"></textarea>
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
                                    <textarea name="product_description" class="form-control @error('product_description') is-invalid @enderror" cols="10" rows="5"></textarea>
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
                                    <input type="text" name="product_size" class="form-control @error('product_size') is-invalid @enderror">
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
                                    <input type="text" name="product_color" class="form-control @error('product_color') is-invalid @enderror">
                                    @error('product_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_thumbnail" class="col-3 col-form-label">Product Thumbnail *</label>
                                <div class="col-9">
                                    <input type="file" name="product_thumbnail" class=" @error('product_thumbnail') is-invalid @enderror">
                                    @error('product_thumbnail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_image" class="col-3 col-form-label">Add More Images *</label>
                                <div class="col-9">
                                    <input type="file" multiple name="product_image[]" class=" @error('product_image') is-invalid @enderror">
                                    @error('product_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="flash_sale" class="col-3 col-form-label"></label>
                                <div class="col-9">
                                    <input type="checkbox" name="flash_sale" value="2" class=" @error('flash_sale') is-invalid @enderror" style="height: 15px;"><span style="margin: 0px 10px;font-size: 20px;">Add to FlashSale</span>
                                
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end row text-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
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