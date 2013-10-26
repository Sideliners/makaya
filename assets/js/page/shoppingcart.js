$(function(){
    $('.remove-item').on('click', function(){
        var item = $(this).attr('data-item-id');
        var ask = confirm("Are your sure to remove the item from your cart?");

        if(ask == true){
            window.location = site_url + 'cart/remove/' + item;
        }
    });

    $('.update-qty').on('click', function(){
        var item_qty = $(this).parent().children(':first-child').val();
        var item_id = $(this).parent().children(':nth-child(2)').attr('id');

        var ask = confirm("Are your sure to update your cart?");

        if(ask == true){
            if(isNaN(item_qty)){
                alert('Invalid Parameters');
                return false;
            }
            else{
                window.location = site_url + 'cart/update/' + item_qty + '/' + item_id
            }
        }
    });
});
