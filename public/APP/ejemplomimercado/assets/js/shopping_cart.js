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
}function updateIncCart(a,e,t){var r=$("#qty_table_"+e).val(),n={qty:r,rowId:a};if("scale_one"===t&&r>=1500)return console.log("Ha superado la cantidad"),null;$.ajax({url:"carrito/updateIncProduct",method:"POST",data:n,beforeSend:function(a){mprogress.set(.4)}}).done(function(a){viewCartFloatingBoxHeader.html(a.viewShoppingCartInHeader),viewContainerCart.html(a.viewContainerCart),viewCartSummary.html(a.viewCartSummary),parseFloat(a.cartTotal)>$("#cart_rule_purchase").val()&&$("#message_cart").fadeOut("slow"),mprogress.end()}).fail(function(a){mprogress.end()})}function updateDecCart(a,e){var t=$("#qty_table_"+e).val();if(t>=1){var r={qty:t,rowId:a};$.ajax({url:"/carrito/updateDecProduct",method:"POST",data:r,beforeSend:function(a){mprogress.set(.4)}}).done(function(a){viewCartFloatingBoxHeader.html(a.viewShoppingCartInHeader),viewContainerCart.html(a.viewContainerCart),viewCartSummary.html(a.viewCartSummary),mprogress.end()}).fail(function(a){mprogress.end()})}}function removeProductInTable(a){var e={rowId:a};$.ajax({url:"/carrito/removeProductInTable",method:"post",data:e,beforeSend:function(a){mprogress.set(.4),showLoading($("#cart_table"))},complete:function(){hideLoading($("#cart_table")),mprogress.end()}}).done(function(a){setTimeout(function(){viewCartFloatingBoxHeader.html(a.viewShoppingCartInHeader),viewContainerCart.html(a.viewContainerCart),viewCartSummary.html(a.viewCartSummary)},500),0==a.cartTotal&&$(".container-message-in-shopping-cart").hide()}).fail(function(a){mprogress.end(),hideLoading($("#cart_table"))})}var cartTable=$("#cart_table"),viewCartFloatingBoxHeader=$("#shopping-cart"),viewContainerCart=$("#containerCart"),viewCartSummary=$("#cart_summary");