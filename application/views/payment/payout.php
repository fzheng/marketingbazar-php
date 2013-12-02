
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://www.paypalobjects.com/js/external/apdg.js"></script>

<h2>Pay Winner</h2>

<p>
Payment Amount: $<?= $competition['award'] ?>
</p>
<?php if(!empty($attendees)):?>
<p>Choose Winner:</p>
<form id="prepare_payment_form" action="javascript:void(0);" method="POST">
<?php foreach($attendees as $attendee): ?>
<input type="radio" name="winner_email" value="<?= $attendee['email'] ?>"><?= $attendee['username']?>&nbsp;(<?= $attendee['email'] ?>)</input>
<br/>
<?php endforeach; ?>
<input id="amount" type="hidden" name="amount" value="<?= $competition['award'] ?>"/>
<br/>
<input id="prepare_payment" type="submit" name="prepare_payment" value="Prepare payment with PayPal" />
<img id="loader" src="/www/images/20loader.gif" style="margin-left: 5px; display:none;"/>
</form>

<form id="execute_payment_form" action="javascript:void(0);" method="post" target="PPDGFrame" style="display: none;">
   <input id="execute_payment" type="submit" name="execute_payment" value="Execute payment with PayPal" disabled="disabled" />
</form>
<?php endif; ?>

<br/>
<br/>

<script>
$(function() {
	$('#prepare_payment').off('click').on('click', function(e) {
		e.preventDefault();
		var paypal_api = "https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay?expType=light&payKey=";
		var ajaxurl = '/payment/prepare';
		var amount = $('#amount').val();
		var email = $('input[name=winner_email]:checked', '#prepare_payment_form').val();

		if(!amount || !email) {
			alert('Unable to determine reward amount or user selection. Please try again at another time.');
			return false;
		}
		
		var agree = confirm('Prepare payment of $' + amount + ' for ' + email + '?');

		if(!agree) {
			return false;
		}

		/*
		$('#prepare_payment').attr('disabled', true);
		$('#prepare_payment_form input[type=radio]').each(function() {
			$(this).attr('disabled', 'true');
		});
		*/
		$('#loader').show();
		$.ajax({
			type: "POST",
			url: ajaxurl,
			dataType: 'json',
			data: {amount: amount, email: email},
			success: function(response, textStatus, jqXHR) {
				$('#loader').hide();
				if(!response || !response.paykey) {
					alert('There was an error processing your payment. Please try again at another time.');
					return false;
				}
				
			  	//Initialize PayPal embedded payment flow. 
			   	// Not loading it on document ready so that we only have it if user prepares payment, 
			   	// not just loads the page ...
			   	var dgFlow = new PAYPAL.apps.DGFlowMini({trigger: "execute_payment"});

			   	//Store PayKey in the form action and enable execute payment button
			   	$("#execute_payment_form").attr("action", paypal_api + response.paykey);
			   	$("#execute_payment").removeAttr("disabled");
			   	$('#execute_payment_form').submit();	
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('#loader').hide();
				alert('We are unable to process the payment preparation at this time. We apologize for the inconvenience.');
				console.log(arguments);
				return false;
			}
		});

	});
});
</script>
