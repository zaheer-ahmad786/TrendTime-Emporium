@extends('layouts.admin')

@section('content')
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Category infomation</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}"><div class="text-tiny">Dashboard</div></a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{route('admin.categories')}}"><div class="text-tiny">Categories</div></a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">New Category</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.categories')}}" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset class="name">
                    <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Category name" name="name" tabindex="0" value="{{old('name')}}" aria-required="true" required="">
                </fieldset>
                @error("name") <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                <fieldset class="name">
                    <div class="body-title">Category Sku <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Category Sku" name="sku" tabindex="0" value="{{old('sku')}}" aria-required="true" required="">
                </fieldset>
                @error("sku") <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Description <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Description " name="description" tabindex="0" value="{{old('description')}}" aria-required="true" required="">
                </fieldset>
                @error("description") <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Price <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="number" placeholder="Price " name="price" tabindex="0" value="{{old('price')}}" aria-required="true" required="">
                </fieldset>
                @error("price") <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imagepreview" style="display:none">                            
                            <img src="{{asset('images/upload/upload-1.png')}}" class="effect8" alt="">
                        </div>
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset> 
                @error("image") <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
        <!-- /new-category -->
    </div>
    <!-- /main-content-wrap -->
</div>                    

</div>
<script>
    function previewImage(event) {
        let output = document.getElementById('imagePreview');
        output.src = URL.createObjectURL(event.target.files[0]); // Create a preview of the uploaded image
        output.style.display = 'block'; // Show the preview image
    }
</script>
@endsection