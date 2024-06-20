<script>
    // load product modal
    function loadProductModal(productId){
        $.ajax({
            method: 'GET',
            url: '{{ route("load-product-modal", ":productId") }}'.replace(':productId', productId),
            beforeSend: function(){
                loaderShow();
            },
            success: function(response){
                $(".load_product_modal_body").html(response);
                // $('#cardModal').modal('show');

            },
            error: function(xhr, status, error){
                console.error(error);
            },
            complete: function(){
                loaderHide();
            }
        })
    }

    // side bar cart
    function updateSidebarCart(callback = null){
        $.ajax({
            method: 'GET',
            url: '{{ route("get-cart-products") }}',
            success: function(response){
                $('.cart_contents').html(response);
                let cartTotal = $('#cart_total').val();
                let cartCount = $('#cart_product_count').val();
                $('.cart_subtotal').text("{{ currencyPosition(':cartTotal') }}".replace(':cartTotal', cartTotal));
                $('.cart_count').text(cartCount);
                if(callback && typeof callback === 'function'){
                    callback();
                }
            },
            error: function(xhr, status, error){
                console.error(error);
            }
        });
    }

    function removeProductFromSidebar(rowId){
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
                toastr.error(errorMessage);
            },
        })
    }

    function loaderShow(){
        $('.overlay-container').removeClass('d-none');
        $('.overlay').addClass('active');
    }

    function loaderHide(){
        $('.overlay').removeClass('active');
        $('.overlay-container').addClass('d-none');
    }
</script>
