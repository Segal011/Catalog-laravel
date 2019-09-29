
@extends('layouts.app')

@section('content')
<div class="container">

<h1>Edit {{ $product->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT')) }}

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
        {{ Form::label('description', 'Description') }}
        <textarea id="description" name="description"></textarea>
        <textarea class="description" name="description"></textarea>
        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}">
        </script>
        <script>
            tinymce.init({
                selector:'textarea.description',
                plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                ],
                toolbar: 'undo redo | styleselect | bold italic | link | alignleft aligncenter alignright | link image',

               
            });
    </script>
    </div>

    <div class="form-group">
        {{ Form::label('enable', 'Enable') }}
        <input type="checkbox" value="enable" name="enable" {{ $product->status == '1' ? 'checked' : '' }}>
    </div>

    <div class="form-group">
    {!! Form::file('image', null) !!}
    </div>
    {{ Form::submit('Saves', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection
