function deleteProduct(id) {
    $.ajax(
        {
            url: '/iMAG/ajax-remove-from-cart',
            data: {id: id},
            method: "POST",
            dataType: "json",
            success: function (data) {
                $('span.glyphicon-shopping-cart').next().text(data.totalProducts + ' Items');
                $("tr.product_" + id).remove();
                $("h3.total").text(data.totalPrice + ' Lei');
                console.log(data);
            }
        }
    )
}