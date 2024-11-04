@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brand infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands') }}">
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Brand</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.brand.store',$brand->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$brand->id}}" />
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand name" name="name" tabindex="0"
                            value="{{ old('name') }}" aria-required="true">
                    </fieldset>
                    @error('name')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand Slug" name="slug" tabindex="0"
                            value="{{ old('slug') }}" aria-required="true">
                    </fieldset>
                    @error('slug')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                    <fieldset class="container">
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow row">
                           
                            <div id="upload-file" class="item up-load col">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*"
                                        class="form-control" onchange="previewImage(event)">
                                </label>
                            </div>
                            <div class="col m-5">
                                <!-- Brand Image -->
                                <img id="imagePreview" style="display:none;">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                        </div>
                    </fieldset>
                    @error('image')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">update</button>
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
