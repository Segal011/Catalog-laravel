@extends('layouts.app')

@section('content')
<div class="container">
<h1>All the products</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<form action="destroyAll" method="post">
{{ csrf_field() }}    

    <a class="btn btn-small btn-info" href="{{ URL::to('products/create') }}">Add new product</a>

    <button type="submit" name="your_name" value="your_value" class="btn btn-small btn-info">Delete multiple products</button>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>SKU</td>
            <td>status</td>
            <td>Base price</td>
            <td>Special price</td>
            <td>Description</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->base_price }}</td>
            <td>{{ $product->discount }}</td>
            <td>{{ $product->description }}</td>

            <td><a class="btn btn-small btn-success" href="{{ URL::to('products/' . $product->id) }}">Show</a></td>
            <td><a class="btn btn-small btn-info" href="{{ URL::to('products/' . $product->id . '/edit') }}">Edit</a></td>
            <td>  
                {{ Form::open(array('url' => 'products/' . $product->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
            </td>
            <td><input type="checkbox" name="delete_list[]" value="{{$product->id}}"></td>
               
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</form>

</div>
@endsection
