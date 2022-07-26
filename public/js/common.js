
function addCart(product_id) {
	
	$.ajax({

		url: 'index.php?page=cart_like&cart_product_id=' + product_id,
		
		dataType: 'json',
		
		success: function(json) {
			
			//alert(json);
			
			$('#cart_total').html(json['success']);
			
		}
		
	});
	
}

function addLike(product_id) {
	
	$.ajax({

		url: 'index.php?page=cart_like&like_product_id=' + product_id,
		
		dataType: 'json',
		
		success: function(json) {
			
			$('#like_total').html(json['success']);
			
			$('#like_button'+product_id).html('<i class="fa fa-check-circle"></i> লাইক');
			
		}
		
	});
	
}

function unLike(product_id) {
	
	if(confirm('আপনি কি নিশ্চিত?')==true) {
	
		$.ajax({

			url: 'index.php?page=cart_like&unlike_product_id=' + product_id,
			
			dataType: 'json',
			
			success: function(json) {
				
				$('#like_total').html(json['success']);
				
				$('#like_list'+product_id).remove();
				
			}
			
		});
	}
}
