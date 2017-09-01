$('#addToCart').click(function () {
    $.ajax(
        {
            url: '/iMAG/addToCart',
            data: {id: $(this).attr("data-productId")},
            method: "POST",
            dataType: "json",
            success: function (data) {
                $('span.glyphicon-shopping-cart').next().text(data.totalProducts + ' Items');
                console.log(data);
            }
        }
    )
});