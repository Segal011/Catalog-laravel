@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron text-center">
            <img src="{{URL::asset('public/file/'.$product->image)}}"  height="300" width="300"></td>

            <div>Name: {{ $product->name }}</div>
            <div>SKU: {{ $product->sku }}</div>
            @auth
            <div>Status: {{ $product->status == 1? "enable" : "disable" }}</div>
            <div>Base price:{{ $product->base_price }}</div>
            <div>Discount: {{ $product->discount }}</div>
            @endauth 
            @if($product->price != $product->special_price)
            <td>Kaina: <i style = "text-decoration:line-through;"> {{ $product->price }}</i><i> {{ $product->special_price }}<i></td>
            @else
            <td>Kaina: {{ $product->price }}</td>
            @endif

            <div>Description</div>
            <div><?php echo $product->description?></div>
         
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
<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
@endsection
