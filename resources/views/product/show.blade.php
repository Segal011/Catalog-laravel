@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron text-center">
            <div>{{ $product->name }}</div>
            <div>{{ $product->sku }}</div>
            <div>{{ $product->status }}</div>
            <div>{{ $product->base_price }}</div>
            <div>{{ $product->discount }}</div>
            <div>{{ $product->description }}</div>
 
         
        <div class="placeholder">
            @php $rating = $product->stars; @endphp  
            @foreach(range(1,5) as $i)
                    @if($rating >0)
                        @if($rating >0.5)
                            <a href="{{URL::to('products/'. $product->id .'/rate/'. $i)}}"><img src={{asset('img/star_full.png')}} width="20"></a>
                        @else           
                            <a href="{{URL::to('products/'. $product->id .'/rate/'. $i)}}"><img src={{asset('img/star_half.png')}} width="20"></a>
                        @endif
                    @else
                        <a href="{{URL::to('products/'. $product->id .'/rate/'. $i)}}"><img src={{asset('img/star_empty.png')}} width="20"></a>
                    @endif
                    @php $rating--; @endphp
                </span>
            @endforeach
        </div>
    </div>
    @include('review.index')

</div>
@endsection
