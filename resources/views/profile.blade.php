@extends('layout')

@section('title', 'My Profile')

@section('extra-css')

    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <style>
    .myDiv {
        width: 600px;
        word-wrap: break-word;
    }
    </style>
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Profiles</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>{{$user->name}}</span>
    @endcomponent

    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @php
            if ($follows ?? ''==true) {
                $faa=1;
            }
            else {
                $faa=0;
            }
        @endphp


    <div class="container">

        <div class="row">
            <div class="p-5">
                <img src="{{productImage($user->profile->image)}}" alt="{{asset('poly.png')}}" width="250" height="250" class="rounded-circle">    </img>
            </div>
            <div class="col-2"><br><br><br>
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-content-center">
                    <h1 >{{$user->name}}</h1>
                        <example-component></example-component>
                        @guest
                        @else
                    @if (Auth()->user()->id!=$user->id)

                            @if($follows ?? ''==true)

                             <div class="pl-2">
                                         <button id="followbtn" class="btn btn-primary ml-2" onclick="followuser()" >Unfollow</button>
                             </div>

                        @else
                                <div class="pl-2">
                                    <button id="followbtn" class="btn btn-primary ml-2" onclick="followuser()" >Follow</button>
                                </div>
                            @endif
                            <div class="pl-2 align-content-center">
                                <button class="btn btn-primary ml-2" onclick="chat()" >Chatwith</button>
                            </div>

                    @endif
                        @endguest
                    </div>
                </div>
                <div class="d-flex">
                    <div class="pr-4"><strong>{{$products->count()}}</strong>Products</div>
                    <div  class="pr-4"><strong id="followcount">{{$user->profile->followers->count()}}</strong>followers</div>
                    <div class="pr-4"><strong>{{$user->following->count()}}</strong>following</div>
                </div>
                <div class="product-section-information" width="200">

                </div>

                <div class="myDiv pt-4" >

                    <p><strong>Description:</strong>{{$user->profile->description}}</p>
                </div>
                <div class="pr-lg-4 pt-1">
                    <strong>Address:</strong> {{$user->profile->address}}
                </div>
            </div>
        </div>
        </div>

    </div>

    <div class="products text-center">
        <h1 class="">Product list</h1>

        <div class="might-like-section">
        <div class="container">
            <div class="might-like-grid">
                @foreach ($products as $product)
                    <a href="{{ route('shop.show', $product->slug) }}" class="might-like-product">
                        <img src="{{ productImage($product->image) }}" alt="product">
                        <div class="might-like-product-name">{{ $product->name }}</div>
                        <div class="might-like-product-price">{{ $product->presentPrice() }}</div>
                    </a>
                @endforeach

            </div>
        </div>
    </div>


    </div>

    <script>

        function chat() {
            window.open('/chatify/{{$user->id}}', '_blank');
        }

        let filterstatus={{$faa}};
        function followuser() {
            console.log(filterstatus);
            if(filterstatus)
                document.getElementById("followbtn").innerText = 'Follow';
            else
                document.getElementById("followbtn").innerText = 'Unfollow';
            filterstatus=!filterstatus;


            axios.post('/follow/{{$user->id}}').then(
                response => {
                    console.log(response.data);
                }
            );
        }
        function buttonText() {
            
        }




    </script>

@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection