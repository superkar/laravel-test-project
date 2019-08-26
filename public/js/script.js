
$('.product_price').on('click', function() {
    if($(this).html() != $(this).attr('price-data')) return;
    $('.product_price').html(function() { return $(this).attr('price-data'); });
    $(this).html('<input type="text" product-id="' + $(this).attr('product-id')+ '" value="' + $(this).attr('price-data') + '" onchange="change_value(this)" />');
})

function change_value(element) 
{
    var new_value = parseInt(element.value);
    if(isNaN(new_value) || new_value <= 0) 
    {
        alert('Значение должно быть целым положительным числом!!!');
        return;
    }
    $.post({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/products/' + $(element).attr('product-id'),
        data: 'price=' + new_value + '&_method=PUT',
        success: function(data, status) {
            $('[product-id=' + $(element).attr('product-id') + ']').attr('price-data', new_value);
            $('[product-id=' + $(element).attr('product-id') + ']').html($('[product-id=' + $(element).attr('product-id') + ']').attr('price-data'));
        }
    });   
}
