@php $rating = $product->stars; @endphp  
@foreach(range(1,5) as $i)
        @if($rating >0)
            @if($rating >0.5)
                <img src={{asset('img/star_full.png')}} width="20">
            @else           
                <img src={{asset('img/star_half.png')}} width="20">
            @endif
        @else
            <img src={{asset('img/star_empty.png')}} width="20">
        @endif
        @php $rating--; @endphp
    </span>
@endforeach

<!-- @php $rating = $product->stars; @endphp  
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
@endforeach -->

