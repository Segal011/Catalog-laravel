
@extends('layouts.app')

@section('content')
<div class="container">

<h1>Edit {{ $product->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name'), }}
    </div>

    <div class="form-group">
        {{ Form::label('sku', 'SKU number') }}
        {{ Form::text('sku') }}
    </div>

    <div class="form-group">
        {{ Form::label('base_price', 'Base price') }}
        {{ Form::text('base_price') }}
    </div>   
    
    <div class="form-group">
        {{ Form::label('discount', 'Discount') }}
        {{ Form::text('discount') }}
    </div>   
    
    <div class="form-group">
        <textarea name="description" id="description" rows="10" cols="80">{{ $product->description}}</textarea>

    </div>

    <div class="form-group">
        {{ Form::label('enable', 'Enable') }}
        <input type="checkbox" value="enable" name="enable" {{ $product->status == '1' ? 'checked' : '' }}>
    </div>

                
    <div class="form-group">
        <input type="file" name="file" />
    </div>
    {{ Form::submit('Saves', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
@endsection
