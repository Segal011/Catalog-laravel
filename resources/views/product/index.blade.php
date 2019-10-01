@extends('layouts.app')

@section('content')
<div class="container">


<h2>PRODUCTS</h2>
<br>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@auth
    {{ Form::open(array('route' => 'configs', 'method' => 'POST')) }}
        <div>
            <i class="form-group">
                {{ Form::label('tax_rate', 'Tax rate %') }}
                {{ Form::text('tax_rate', config('services.catalog.tax_rate')) }}
            </i>
            <i class="form-group">
                {{ Form::label('tax_flag', 'Tax inclusion flag') }}
                <input type="checkbox" name="enable" value={{config('services.catalog.tax_flag')}}>
            </i>
            <i class="form-group">
                {{ Form::label('discount', 'Discount sum') }}
                {{ Form::text('discount', config('services.catalog.discount')) }}
            </i>
            <i class="form-group">
                {{ Form::label('discount_p', 'Discount %') }}
                {{ Form::text('discount_p', config('services.catalog.discount_p')) }}        
            </i>
            {{ Form::submit('Change!', array('class' => 'btn btn-primary')) }}

        </div>
    {{ Form::close() }}

    <br>
    {{ Form::open(array('route' => 'destroyAll', 'method' => 'POST')) }}

    {{ csrf_field() }}    
    {{ Form::hidden('_method', 'DELETE') }}

    <a class="btn btn-small btn-info" href="{{ URL::to('products/create') }}">Add new product</a>

    <button type="submit" name="your_name" value="your_value" class="btn btn-small btn-info">Delete multiple products</button>
@endauth

<table class="table table-striped table-bordered" >
    <thead >
        <tr>
            <td>Image</td>
            <td>Name</td>
            <td>SKU</td>
            @auth
            <td>status</td>
            <td>Base price</td>
            <td>Discount</td>
            @endauth
            <td>Price</td>
            <td style="width:128px;">Review</td>
            <td>Comments</td>
            <td colspan="2">Actions</td>
            @auth
            <td>Delete</td>
            @endauth

        </tr>
    </thead>
    <tbody >
    @foreach($products as $product)
        @if (!Auth::check() && $product->status == 1 || Auth::check())

        <tr style= > 
            <td>
            <img src="{{URL::asset('public/file/'.$product->image)}}"  height="100" width="100"></td>
            <td >{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            @auth
            <td>{{ $product->status }}</td>
            <td>{{ $product->base_price }}</td>
            <td>{{ $product->discount }}</td>
            @endauth
            @if($product->price != $product->special_price)
            <td> <i style = "text-decoration:line-through;"> {{ $product->price }}</i><i> {{ $product->special_price }}<i></td>
            @else
            <td>{{ $product->price }}</td>
            @endif
            <td> @include('product.stars') ({{$product->stars_count}})</td>            
            <td>Comments ({{count($product->reviews)}})</td>
            <td><a class="btn btn-small btn-success" href="{{ URL::to('products/' . $product->id) }}">Show</a></td>
            @auth

            <td><a class="btn btn-small btn-info" href="{{ URL::to('products/' . $product->id . '/edit') }}">Edit</a></td>
            <td>{{Form::checkbox('list[]',$product->id)}}</td>
            @endauth

        </tr>
        @endif

    @endforeach
    </tbody>
</table>

</form>

</div>

@endsection
