let cartTable = $("#cart_table");
let viewCartFloatingBoxHeader = $('#shopping-cart');
let viewContainerCart = $("#containerCart");
let viewCartSummary = $("#cart_summary");

function updateIncCart(rowId, id, scale) {
    let qty = $('#qty_table_' + id).val();

    let data = {
        'qty': qty,
        'rowId': rowId,
    };

    if (scale === "scale_one" && qty >= 1500) {
        console.log("Ha superado la cantidad");
        return null;
    }

    $.ajax({
        url: "carrito/updateIncProduct",
        method: 'POST',
        data: data,
        beforeSend: (result) => {
            mprogress.set(0.4);
        }
    }).done((result) => {
        viewCartFloatingBoxHeader.html(result.viewShoppingCartInHeader);
        viewContainerCart.html(result.viewContainerCart);
        viewCartSummary.html(result.viewCartSummary);

        let cartTotal = parseFloat(result.cartTotal);
        let minimumPurchase = ($("#cart_rule_purchase").val());
        if (cartTotal > minimumPurchase) {
            $("#message_cart").fadeOut("slow");
        }
        mprogress.end();
    }).fail((error) => {
        mprogress.end();
    });
}

function updateActual(rowId, id, scale) {
    let qty = $('#qty_table_' + id).val();

    let data = {
        'qty': qty,
        'rowId': rowId,
    };

    if (scale === "scale_one" && qty >= 1500) {
        console.log("Ha superado la cantidad");
        return null;
    }

    $.ajax({
        url: "carrito/updateActual",
        method: 'POST',
        data: data,
        beforeSend: (result) => {
            mprogress.set(0.4);
        }
    }).done((result) => {
        viewCartFloatingBoxHeader.html(result.viewShoppingCartInHeader);
        viewContainerCart.html(result.viewContainerCart);
        viewCartSummary.html(result.viewCartSummary);

        let cartTotal = parseFloat(result.cartTotal);
        let minimumPurchase = ($("#cart_rule_purchase").val());
        if (cartTotal > minimumPurchase) {
            $("#message_cart").fadeOut("slow");
        }
        mprogress.end();
    }).fail((error) => {
        mprogress.end();
    });
}

function updateDecCart(rowId, id) {
    let qty = $('#qty_table_' + id).val();

    if (qty >= 1) {
        let data = {
            'qty': qty,
            'rowId': rowId,
        };

        $.ajax({
            url: "/carrito/updateDecProduct",
            method: 'POST',
            data: data,
            beforeSend: (result) => {
                mprogress.set(0.4);
            }
        }).done((result) => {
            viewCartFloatingBoxHeader.html(result.viewShoppingCartInHeader);
            viewContainerCart.html(result.viewContainerCart);
            viewCartSummary.html(result.viewCartSummary);
            mprogress.end();
        }).fail((error) => {
            mprogress.end();
        });
    }
}

function removeProductInTable(rowId) {
    let data = {
        'rowId': rowId,
    };

    $.ajax({
        url: "/carrito/removeProductInTable",
        method: 'post',
        data: data,
        beforeSend: (result) => {
            mprogress.set(0.4);
            showLoading($("#cart_table"));
        },
        complete: () => {
            hideLoading($("#cart_table"));
            mprogress.end();
        },
    }).done((result) => {
        setTimeout(function () {
            viewCartFloatingBoxHeader.html(result.viewShoppingCartInHeader);
            viewContainerCart.html(result.viewContainerCart);
            viewCartSummary.html(result.viewCartSummary);
        }, 500);
        if (result.cartTotal == 0) {
            $(".container-message-in-shopping-cart").hide();
        }
    }).fail((error) => {
        mprogress.end();
        hideLoading($("#cart_table"));
    });
}
