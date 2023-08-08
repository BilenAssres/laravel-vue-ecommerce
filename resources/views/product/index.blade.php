<x-guest-layout>

    <div class="grid grid-cols-3 justify-center my-4">
        @foreach ($products as $product)
            <div class="shadow">
                <div id="img" class="flex">
                    {{-- do crousel here --}}
                    @foreach ($product->images as $image)
                        <div class=" duration-700 ease-in-out" data-carousel-item>
                            <img src="/storage/{{ $image->img_url }}" alt="">
                        </div>
                    @endforeach
                </div>
                <div id="deatil" class="my-1 rounded">
                    <div class="text-center">
                        <h1 class="text-xl">
                            {{ $product->product_name }}
                        </h1>
                    </div>
                    <div class=" justify-between">
                        {{$product->product_price}}
                        {{$product->product_status}}
                        {{$product->product_seller}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-guest-layout>
