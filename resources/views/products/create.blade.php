@extends('layout')

@section('title', 'Produit')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <link rel="stylesheet" href="{{asset('vendor/tcg/voyager/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/tcg/voyager/assets/js/skins/lightgray/content.min.css')}}">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Add Product</span>
    @endcomponent

    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif
        @php
        $user=auth()->user();
        @endphp
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="products-section container">
        <div class="sidebar">


        </div> <!-- end sidebar -->
        <div class="my-profile ">
            <div class="products-header flex">
                <h1 class="stylish-heading">Add Product</h1>

                <h3 class="pr-3" ></h3>
            </div>




        </div>
        <div class="row">
            <div class="">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="/prod" method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->

                        @csrf


                        <div class="panel-body">


                            <!-- Adding / Editing -->




                            <div class="form-group  ">

                                <label for="name">name</label>
                                <input required="" type="text" class="form-control" name="name" placeholder="name" value="">


                            </div>

                            <div class="form-group  ">

                                <label for="name">slug</label>
                                <input required="" type="text" class="form-control" name="slug" placeholder="slug" value="">


                            </div>

                            <div class="form-group  ">

                                <label for="name">Details</label>
                                <input required="" type="text" class="form-control" name="details" placeholder="Details" value="">


                            </div>

                            <div class="form-group  ">

                                <label for="name">price</label>
                                <input type="number" class="form-control" name="price" required="" step="any" placeholder="price" value="">


                            </div>

                            <div class="form-group  ">

                                <label for="name">Description</label>
                                <textarea id="email" type="text" name="description"
                                          placeholder="Description" rows="4" cols="80" ></textarea>




                            </div>



                            <div class="form-group  ">

                                <label for="name">Image</label>
                                <div data-field-name="image">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img src="" d data-id="72" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input type="file" name="image" accept="image/*">


                            </div>

                            <div class="form-group  ">

                                <label for="name">Quantity</label>
                                <input type="number" class="form-control" name="quantity" required="" step="any" placeholder="Quantity" value="10">


                            </div>

                            <div class="form-group  ">

                                <label for="name">Images</label>
                                <br>

                                <input type="file" name="images[]" multiple="multiple" accept="image/*">


                            </div>



                            <div class="form-group">
                                <label>Categories</label>
                                @php($categories=\App\Category::all())
                                <select name="categories">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>                                    @endforeach
                                </select>
                            </div> <!-- end form-group -->

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
        var params = {}
        var $image

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable ?? '')
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', function (e) {
                $image = $(this).siblings('img');

                params = {

                }

                $('.confirm_delete_name').text($image.data('image'));
                $('#confirm_delete_modal').modal('show');
            });

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.media.delete') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing image.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>
@stop
@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
    <script src="{{asset('vendor/tcg/voyager/assets/js/app.js')}}
@endsection
