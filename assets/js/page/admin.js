// JavaScript Document

function show_details(type, id){
	$('#highlights #modal_name').show();
	uri = type + '/detail';
	
    if(isNaN(id)){
        $('#detailsModal .modal-body').html('<center>Invalid parameters</center>');
        return false;
    }
    $('#detailsModal #add_to_cart').show().attr('data-product-id', id);

	$('#detailsModal').modal('show');
}

$(function(){
	$('#detailsModal #cancel_modal').on('click', function(){
		$('#highlights #read_more').show();
		$('#highlights #category_name').show();
		$('#highlights #modal_name').hide();
		$('#highlights #name').show();
		$('#detailsModal #add_to_cart').hide();
	});

    $('body').on('click', '#add_to_cart', function(event){
		
        var prod_id = $(this).attr('data-product-id');

        if(isNaN(prod_id)){
            alert('Invalid Parameters');
            return false;
        }

        $('#detailsModal #modal-msg').html('<i class="icon-spinner icon-spin icon-2x"></i> Adding to cart...');

        $.post(site_url + 'cart/add', {
            pid : prod_id
        }, function(data){			
            if(data.status > 0){
                $('#detailsModal #modal-msg').html('<span class="label label-success">' + data.response + '</span> <a href="' + site_url + 'shopping-cart">View cart now</a>');				
            }
            else{
                alert(data.response);
            }
        }, 'json');
    });
	
    $('body').on('click', '.add_to_cart', function(event){
        var prod_id = $(this).attr('data-product-id');

        if(isNaN(prod_id)){
            alert('Invalid Parameters');
            return false;
        }

        $('#modal-msg-' + prod_id ).html('<i class="icon-spinner icon-spin"></i> Adding to cart...');

        $.post(site_url + 'cart/add', {
            pid : prod_id
        }, function(data){
            if(data.status > 0){
                $('#modal-msg-' + prod_id).html('<span class="label label-success">' + data.response + '</span> <a href="' + site_url + 'shopping-cart">View cart now</a>');
            }
            else{
                alert(data.response);
            }
        }, 'json');
    });
	
	$('body').on('change', '#donation-recipient-type', function(event){
		donation_recipient_type = $("#donation-recipient-type").val();
		if (donation_recipient_type != '0') {			
			$.post(site_url + "support/get_recipients/" + donation_recipient_type, {				
			}, function(data){
				alert(data.status);
				if(data.status > 0){
					alert(data.response);
				}
			}, 'json');
		} else {
			alert("No Receipients");// remove options of conation recipients
		}
    });
});
