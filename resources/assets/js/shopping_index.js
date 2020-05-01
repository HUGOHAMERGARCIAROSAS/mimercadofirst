let quickViewModal = $('.quick-view-modal-container');
let quickViewModalBanner = $('#quick_view_modal_container_banner');
quickViewModal.on('show.bs.modal', function (e) {
    mprogress.start();
});
quickViewModal.on('shown.bs.modal', function (e) {
    mprogress.end();
});
quickViewModal.on('hide.bs.modal', function (e) {
    mprogress.end();
});
quickViewModalBanner.on('show.bs.modal', function (e) {
    mprogress.start();
});
quickViewModalBanner.on('shown.bs.modal', function (e) {
    mprogress.end();
});
quickViewModalBanner.on('hide.bs.modal', function (e) {
    mprogress.end();
});

// container overlay for loadingoverlay.js
let cartFloatingBoxRemove = $(".cart-floating-box-remove");

// cart info in header
let cartInfo = $("#cart-info");
let cartFloatingBox = $("#cart-floating-box");
let cartFloatingBoxFixed = $("#cart-floating-box-fixed");
let cartItems = $(".cart-items");
let calculationDetails = $(".calculation-details");

// cart validate
let contentCart = $(".content-cart");
let emptyCart = $(".empty-cart");

// products scale
const productScale = {
    SCALE_INTEGER: "scale_integer",
    SCALE_DECIMAL: "scale_decimal",
    SCALE_ONE: "scale_one",
    SCALE_ZERO_TWO: "scale_zero_two",
    SCALE_ZERO_FIVE: "scale_zero_five",
    SCALE_SIX: "scale_six",
    SCALE_TWELVE: "scale_twelve",
    SCALE_TWENTY_FIVE: "scale_twenty_five",
    SCALE_FIFTY: "scale_fifty",
    SCALE_ONE_HUNDRED: "scale_one_hundred",
};

function validateScaleDecimals(scale, qty) {
    if (scale === productScale.SCALE_ZERO_TWO) {
        qty = (qty / 0.25);
    } else if (scale === productScale.SCALE_ZERO_FIVE) {
        qty = (qty / 0.5);
    } else if (scale === productScale.SCALE_SIX) {
        qty = (qty / 6);
    } else if (scale === productScale.SCALE_TWELVE) {
        qty = (qty / 12);
    } else if (scale === productScale.SCALE_TWENTY_FIVE) {
        qty = (qty / 25);
    } else if (scale === productScale.SCALE_FIFTY) {
        qty = (qty / 50);
    } else if (scale === productScale.SCALE_ONE_HUNDRED) {
        qty = (qty / 100);
    }

    return qty;
}

function addProductWithQuantifyToShoppingCartModal(productId, scale) {
    let qty = $("#qty_modal_" + productId).val();
    qty = validateScaleDecimals(scale, qty);
    addProduct(productId, qty);
}

function addProductWithQuantifyToShoppingCart(productId, scale) {
    let qty = $("#qty_" + productId).val();

    if (scale === "scale_one" && qty > 100) {
        console.log("Ha superado la cantidad")
    } else {
        qty = validateScaleDecimals(scale, qty);
        addProduct(productId, qty);
    }
}

function addProductWithQuantifyToShoppingCartSlider(productId, scale) {
    let qty = $("#qty_slider_" + productId).val();
    qty = validateScaleDecimals(scale, qty);
    addProduct(productId, qty);
}

function addProductWithQuantifyToShoppingBanner(productId, scale) {
    let qty = $("#qty_banner_" + productId).val();
    qty = validateScaleDecimals(scale, qty);
    addProduct(productId, qty);
}

function addProduct(productId, qty) {
    let data = {
        'productId': productId,
        'qty': qty,
    };

    $.ajax({
        url: "/carrito/addProductWithQuantify",
        method: 'post',
        data: data,
        beforeSend: (result) => {
            mprogress.set(0.4);
            showLoading(cartFloatingBoxFixed);
        }
    }).done((result) => {
        showShoppingCart();
        cartHtml(result);
        addMessageOfSuccess(productId);
        hideLoading(cartFloatingBoxFixed);
        mprogress.end();
    }).fail((error) => {
        mprogress.end();
        hideLoading(cartFloatingBoxFixed);
    });
}

function addMessageOfSuccess(productId) {
    $("#badge_success_confirmation_" + productId).show();
    $("#quick_view_modal_container_" + productId).modal('hide');
    $("#quick_view_modal_container_banner_offer_" + productId).modal('hide');
}

function closeMessageSuccess(productId) {
    $("#badge_success_confirmation_" + productId).hide();
}

function cartHtml(result) {
    cartInfo.html(result.viewCartInfo);
    cartItems.html(result.viewCartItems);
    calculationDetails.html(result.viewCartCalculationDetails);
}

function showShoppingCart() {
    emptyCart.hide();
    contentCart.show();
}

function showEmptyShoppingCart(result) {
    if (!result.cartCount) {
        contentCart.hide();
        emptyCart.show();
    }
}

function removeProductToShoppingCart(item) {
    let data = {
        'rowId': item.rowId,
    };

    $.ajax({
        url: "/carrito/removeProduct",
        method: 'post',
        data: data,
        beforeSend: (result) => {
            mprogress.set(0.4);
            showLoading(cartFloatingBoxRemove);
        }
    }).done((result) => {
        showEmptyShoppingCart(result);
        cartHtml(result);
        closeMessageSuccess(item.id);
        hideLoading(cartFloatingBoxRemove);
        mprogress.end();
    }).fail((error) => {
        mprogress.end();
        hideLoading(cartFloatingBoxRemove);
    });
}


(function () {
    "use strict";

    $('body').on('click', '.qty-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var scale = $button.parent().find('input').data('scale');
        var qty = 1;

        if (scale === productScale.SCALE_ZERO_TWO) {
            qty = 0.25;
        } else if (scale === productScale.SCALE_ZERO_FIVE) {
            qty = 0.5;
        } else if (scale === productScale.SCALE_SIX) {
            qty = 6;
        } else if (scale === productScale.SCALE_TWELVE) {
            qty = 12;
        } else if (scale === productScale.SCALE_TWENTY_FIVE) {
            qty = 25;
        } else if (scale === productScale.SCALE_FIFTY) {
            qty = 50;
        } else if (scale === productScale.SCALE_ONE_HUNDRED) {
            qty = 100;
        } else {
            qty = 1;
        }

        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + qty;
        } else {

            if (oldValue > qty) {
                var newVal = parseFloat(oldValue) - qty;
            } else {
                newVal = qty;
            }
        }

        $button.parent().find('input').val(newVal);
    });
})();