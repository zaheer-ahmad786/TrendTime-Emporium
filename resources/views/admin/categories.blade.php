@extends('layouts.admin')

@section('content')
<style>
    .table-striped  th:nth-child(1), .table-striped  td:nth-child(1) {
        width: 100px;   
    }
    .table-striped  th:nth-child(2), .table-striped  td:nth-child(2) {
        width: 250px;   
    }
</style>
<div class="main-content-inner">                            
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Categories</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>                                                                           
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All Category</div>
                </li>
            </ul>
        </div>
        
        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{route('admin.categories.add')}}"><i class="icon-plus"></i>Add new</a>
            </div>
            <div class="wg-table table-all-user">
                @if(Session::has('status'))
                    <p class="alert alert-success">{{Session::get('status')}}</p>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $categories)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{asset('uploads/brands')}}/{{$categories->image}}" alt="" class="image">
                                </div>
                                <div class="name">
                                    <a href="#" class="body-title-2">{{$categories->name}}</a>                                       
                                </div>  
                                <div class="name">
                                    <a href="#" class="body-title-2">{{$categories->sku}}</a>                                       
                                </div>  
                                <div class="name">
                                    <a href="#" class="body-title-2">{{$categories->description}}</a>                                       
                                </div>  
                            </td>
                            <td>{{$categories->price}}</td>
                            <td>
                                {{-- <a href="{{route('admin.brand.products',['brand_slug'=>$brand->slug])}}" target="_blank">{{$brand->products()->count()}}</a> --}}
                            </td>
                            <td>
                                <div class="list-icon-function">                                        
                                    <div class="item edit">
                                        <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-success"> <i class="icon-edit-3"></i></a>    
                                    </div>
                                    <div class="item text-danger delete">
                                            
                                                 <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $categories->id }}">
                        <i class="icon-trash-2"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{ $categories->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this brand?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.brand.delete', $categories->id) }}" method="get" style="display:inline;">
                                        @csrf
                                       
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                                    </div>
                                    
                                </div>
                            </td>
                        </tr>
                        @endforeach                                  
                    </tbody>
                </table>   
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">                
                {{$categories->links('pagination::bootstrap-5')}}
            </div>
        </div>
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