@extends('frontend.layouts.master')

@section('content')
    <!--=============================
                BREADCRUMB START
            ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>cart view</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#">cart view</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                BREADCRUMB END
            ==============================-->


    <!--============================
                CART VIEW START
            ==============================-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s"
                    style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                    <div class="fp__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <th class="fp__pro_img">
                                            Image
                                        </th>

                                        <th class="fp__pro_name">
                                            details
                                        </th>

                                        <th class="fp__pro_status">
                                            price
                                        </th>

                                        <th class="fp__pro_select">
                                            quantity
                                        </th>

                                        <th class="fp__pro_tk">
                                            total
                                        </th>

                                        <th class="fp__pro_icon">
                                            <a class="clear_all" href="{{ route('cart.destroy') }}">clear all</a>
                                        </th>
                                    </tr>
                                    @forelse (Cart::content() as $product)
                                        <tr>
                                            <td class="fp__pro_img"><img
                                                    src="{{ asset($product->options->product_info['image']) }}"
                                                    alt="{{ $product->name }}" class="img-fluid w-100">
                                            </td>

                                            <td class="fp__pro_name">
                                                <a
                                                    href="{{ route('product.show', $product->options->product_info['slug']) }}">{{ $product->name }}</a>
                                                <span>
                                                    {{ @$product->options->product_size['name'] }}
                                                    {{ @$product->options->product_size['price'] ? '(' . currencyPosition(@$product->options->product_size['price']) . ')' : '' }}
                                                </span>
                                                @foreach ($product->options->product_options as $cartProductOption)
                                                    <p>
                                                        {{ $cartProductOption['name'] }}
                                                        ({{ currencyPosition($cartProductOption['price']) }})
                                                    </p>
                                                @endforeach
                                            </td>

                                            <td class="fp__pro_status">
                                                <h6>{{ currencyPosition($product->price) }}</h6>
                                            </td>

                                            <td class="fp__pro_select">
                                                <div class="quentity_btn">
                                                    <button class="btn btn-danger decrement"><i class="fal fa-minus"
                                                            aria-hidden="true"></i></button>
                                                    <input class="quantity" data-id="{{ $product->rowId }}" type="text" placeholder="1" value="{{ $product->qty }}">
                                                    <button class="btn btn-success increment"><i class="fal fa-plus"
                                                            aria-hidden="true"></i></button>
                                                </div>
                                            </td>

                                            <td class="fp__pro_tk">
                                                <h6 class="product_cart_total">
                                                    {{ currencyPosition(productTotal($product->rowId)) }}
                                                </h6>
                                            </td>

                                            <td class="fp__pro_icon">
                                                <a class="remove_cart_product" href="#" data-id="{{ $product->rowId }}"><i class="far fa-times" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="fp__pro_name" style="width: 100%">Cart is Empty</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s"
                    style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                    <div class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>
                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit">apply</button>
                        </form>
                        <a class="common_btn" href=" #">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                CART VIEW END
            ==============================-->
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('.increment').on('click', function(){
            let inputField = $(this).siblings(".quantity");
            let currentValue = parseInt(inputField.val());
            inputField.val(++currentValue);



            let rowId = inputField.data("id");
            cartQtyUpdate(rowId, currentValue, function(response){
                let productTotal = response.product_total;
                inputField.closest("tr")
                    .find(".product_cart_total")
                    .text("{{ currencyPosition(":productTotal") }}"
                    .replace(":productTotal", productTotal));
            });
        });

        $('.decrement').on('click', function(){
            let inputField = $(this).siblings(".quantity");
            let currentValue = parseInt(inputField.val());
            if(currentValue > 1){
                inputField.val(--currentValue);

                let rowId = inputField.data("id");
                cartQtyUpdate(rowId, currentValue, function(response){
                    let productTotal = response.product_total;
                    inputField.closest("tr")
                        .find(".product_cart_total")
                        .text("{{ currencyPosition(":productTotal") }}"
                        .replace(":productTotal", productTotal));
                });
            }
        });

        function cartQtyUpdate(rowId, qty, callback){
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: '{{ route("cart.quantity-update") }}',
                data: {
                    'rowId' : rowId,
                    'qty' : qty
                },
                beforeSend: function(){
                    loaderShow();
                },
                success: function(response){
                    if(callback && typeof callback === 'function'){
                        callback(response);
                        updateSidebarCart();
                    }
                },
                error: function(xhr, status, error){
                    let errorMessage = xhr.responseJSON.message;
                    loaderHide();
                    toastr.error(errorMessage);
                },
                complete: function(){
                    loaderHide();
                }
            })
        }

        $('.remove_cart_product').on('click', function(e){
            e.preventDefault();
            let rowId = $(this).data("id");
            removeCartProduct(rowId);
            $(this).closest('tr').remove();
        })

        function removeCartProduct(rowId){
            $.ajax({
                method: 'GET',
                url: '{{ route("cart-product-remove", ":rowId") }}'.replace(':rowId', rowId),
                beforeSend: function(){
                    loaderShow();
                },
                success: function(response){
                    if(response.status === 'success'){
                        updateSidebarCart(function(){
                            toastr.success(response.message);
                            loaderHide();
                        });
                    }
                },
                error: function(xhr, status, error){
                    let errorMessage = xhr.responseJSON.message;
                    loaderHide();
                    toastr.error(errorMessage);
                },
                complete: function(){
                    loaderHide();
                }
            })
        }
    });
</script>

@endpush