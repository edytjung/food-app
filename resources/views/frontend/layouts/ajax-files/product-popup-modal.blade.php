<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
<form action="" id="model_add_to_cart_form">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
<div class="fp__cart_popup_img">
    <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100">
</div>
<div class="fp__cart_popup_text">
    <a href="{{ route('product.show', $product->slug) }}" class="title">{{ $product->name }}</a>
    <p class="rating">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star-half-alt"></i>
        <i class="far fa-star"></i>
        <span>(201)</span>
    </p>
    <h4 class="price">
        @if ($product->offer_price > 0)
            <input type="hidden" name="base_price" value="{{ $product->offer_price }}" />
            {{ currencyPosition($product->offer_price) }}
            <del>{{ currencyPosition($product->price) }}</del>
        @else
            <input type="hidden" name="base_price" value="{{ $product->price }}" />
            {{ currencyPosition($product->price) }}
        @endif
    </h4>
    @if ($product->productSizes->count())
        <div class="details_size">
            <h5>select size</h5>
            @foreach ($product->productSizes as $productSize)
                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           value="{{ $productSize->id }}"
                           data-price="{{ $productSize->price }}"
                           name="product_size"
                           id="size-{{ $productSize->id }}">
                    <label class="form-check-label" for="size-{{ $productSize->id }}">
                        {{ $productSize->name }} <span>+ {{ currencyPosition($productSize->price) }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    @endif
    @if ($product->productOptions->count())
        <div class="details_extra_item">
            <h5>select option <span>(optional)</span></h5>
            @foreach ($product->productOptions as $productOption)
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="product_option[]"
                           value="{{ $productOption->id }}"
                           data-price="{{ $productOption->price }}"
                           id="option-{{ $productOption->id }}">
                    <label class="form-check-label" for="option-{{ $productOption->id }}">
                        {{ $productOption->name }} <span>+ {{ currencyPosition($productOption->price) }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    @endif

    <div class="details_quentity">
        <h5>select quantity</h5>
        <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
            <div class="quentity_btn">
                <button class="btn btn-danger decrement"><i class="fal fa-minus"></i></button>
                <input id="quantity" name="quantity" type="text" placeholder="1" value="1" readonly>
                <button class="btn btn-success increment"><i class="fal fa-plus"></i></button>
            </div>
            <h3 id="total_price">
                @if ($product->offer_price > 0)
                    {{ currencyPosition($product->offer_price) }}
                @else
                    {{ currencyPosition($product->price) }}
                @endif
            </h3>
        </div>
    </div>
    <ul class="details_button_area d-flex flex-wrap">
        <li><button type="submit" class="common_btn">add to cart</button></li>
    </ul>
</div>
</form>
<script>
    $(document).ready(function(){
        $('input[name="product_size"]').on('change', function(){
            updateTotalPrice();
        });

        $('input[name="product_option[]"]').on('change', function(){
            updateTotalPrice();
        });



        $('.increment').on('click', function(e){
            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());
            e.preventDefault();
            quantity.val(++currentQuantity);
            // console.log(currentQuantity);
            updateTotalPrice();
        });

        $('.decrement').on('click', function(e){
            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());
            e.preventDefault();
            if(currentQuantity > 1){
                quantity.val(--currentQuantity);
            }
            updateTotalPrice();
        });

        // Function Update Total Price base on selected options
        function updateTotalPrice(){
            let basePrice = parseFloat($('input[name="base_price"]').val());
            let selectedSizePrice = 0;
            let selectedOptionsPrice = 0;

            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());

            // calculate Product Size Price
            let selectedSize = $('input[name="product_size"]:checked');
            if(selectedSize.length >0){
                selectedSizePrice = parseFloat(selectedSize.data("price"));
            }

            // calculate Product Option Price
            let selectedOption = $('input[name="product_option[]"]:checked');
            $(selectedOption).each(function(){
                selectedOptionsPrice += parseFloat($(this).data("price"));
            });

            let totalPrice = (basePrice + selectedSizePrice + selectedOptionsPrice) * currentQuantity;
            $('#total_price').text("{{ config('settings.site_currency_icon') }}" + totalPrice);
        }

        $("#model_add_to_cart_form").on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            // console.log(formData);
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: '{{ route("add-to-cart") }}',
                data: formData,
                success: function(response){

                },
                error: function(xhr, status, error){
                    console.error(error)
                },
            })
        });
    }); // end of document ready
</script>
