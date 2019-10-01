@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div>
    @foreach($product->reviews as $review)
        <strong>{{ $review->name }}</strong>
        <p>{{ $review->created_at }}</p>
        <p>{{ $review->body }}</p>
        @auth
        <p>
            {{ Form::open(array('url' => 'reviews/' . $review->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete this review', array('class' => 'btn btn-warning')) }}
            {{ Form::close() }}
         </p>
         @endauth
    @endforeach
</div>
<div>
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'reviews')) }}
{{ csrf_field() }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name') }}
           
            {{ Form::label('email', 'E-mail') }}
            {{ Form::text('email') }}

            {{ Form::label('body', 'Text') }}
            {{ Form::text('body') }}

            {!! Form::hidden('product_id', $product->id) !!}
            
            {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>

    
</div>