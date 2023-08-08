<x-guest-layout>
    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Product Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="product_name" :value="old('product_name')"
                required autofocus autocomplete="product_name" />
            <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Product Status')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="product_status"
                :value="old('product_status')" required autocomplete="product_status" />
            <x-input-error :messages="$errors->get('product_status')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="product_price" :value="__('Product Price')" />

            <x-text-input id="password" class="block mt-1 w-full" type="number" name="product_price" :value="old('product_price')" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('product_price')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="product_price" :value="__('Product Deatil')" />

            <textarea id="password" class="block mt-1 w-full  rounded-md h-64 " style="resize:none;"  :value="old('product_detail')" type="text" name="product_detail"></textarea>

            <x-input-error :messages="$errors->get('product_detail')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="product_seller" :value="__('Product Seller')" />

            <x-text-input id="product_seller" class="block mt-1 w-full" type="text" :value="old('product_seller')" name="product_seller" required
                autocomplete="product_seller" />

            <x-input-error :messages="$errors->get('product_seller')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="product_image" :value="__('Product Photo')" />

            <input id="product_seller" class="block mt-1 w-full" multiple type="file" accept="image/*" 
                name="product_image[]"  />

            <x-input-error :messages="$errors->get('product_image')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-4">
                {{ __('Add Product') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
