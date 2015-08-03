<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		Joomla.Plugin
* @subpackage	Rb_EcommerceProcessor.Stripe
* @contact		team@readybytes.in
* @author		mManishTrivedi
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$bank_name 			= 	@$displayData['payment_data']['bank_name'];
$account_number 	= 	@$displayData['payment_data']['account_number'];
$invoice_number 	=	@$displayData['payment_data']['invoice_number'];
$amount				=	@$displayData['payment_data']['amount'];

?>
	
<div class="well clearfix">
		<span class="payment-errors hide"></span>
		
		<div class="form-group">
		    <div class="control-label">
		    	<label>
			      <span class="required-label"><?php echo JText::_('PLG_RB_ECOMMERCEPROCESSOR_OFFLINE_FORM_OFFLINE_PAYMENT_MODE_LABEL');?></span>
			    </label>
		    </div>
	        
	        <select class="form-control" name="payment_data[from]" required="true" data-rb-processor-offline="payment-data-from" >
	        	<option value="cash" ><?php echo JText::_('PLG_RB_ECOMMERCEPROCESSOR_OFFLINE_FORM_OFFLINE_PAYMENT_MODE_CASH'); ?> </option>
				<option value="cheque"><?php echo JText::_('PLG_RB_ECOMMERCEPROCESSOR_OFFLINE_FORM_OFFLINE_PAYMENT_MODE_CHEQUE'); ?> </option>
				<option value="dd"><?php echo JText::_('PLG_RB_ECOMMERCEPROCESSOR_OFFLINE_FORM_OFFLINE_PAYMENT_MODE_DEMAND_DRAFT'); ?> </option>
	        </select>
	        
		</div>

        <div class="form-group" data-rb-processor-offline="payment-data-id-div">
		     <div class="control-label">
		    	<label>
		      		<span class="required-label"><?php echo JText::_('PLG_RB_ECOMMERCEPROCESSOR_OFFLINE_FORM_DD_OR_CHEQUE_NUMBER_LABEL');?></span>
		     	</label>
			</div>
			<input type="text"  name="payment_data[id]" class="form-control" data-rb-processor-offline="payment-data-id" id="payment-data-id" required="true" autocomplete="off" />
			<span for="payment-data-id" class="rb-error hide"><?php echo  JText::_('PLG_RB_ECOMMERCEPROCESSOR_OFFLINE_ERROR_DD_NUMBER_NOT_VALID'); ?></span>	            
        </div>
	
	
		<div class="form-group">
		    <div class="control-label">
				<label>
			   		<span class="required-label"><?php echo JText::_('PLG_RB_ECOMMERCEPROCESSOR_OFFLINE_FORM_BANK_NAME_LABEL');?></span>
			   	</label>
			</div>
			<input type="text"  name="payment_data[bank_name]" value="<?php echo $bank_name; ?>" class="form-control" readonly="true" />	            
        </div>
        
        
        <div class="form-group">
			<div class="control-label">
		    	<label>
		     		<span class="required-label"><?php echo JText::_('PLG_RB_ECOMMERCEPROCESSOR_OFFLINE_ACCOUNT_NUMBER_LABEL');?></span>
		    	</label>
			</div>
			<input	type="text"  name="payment_data[account_number]" class="form-control"
					value="<?php echo$account_number; ?>" readonly="true" 
			/>	
			            
        </div>
        
        <input type="hidden"  name="payment_data[invoice_number]" class="input-xlarge" value="<?php echo $invoice_number; ?>" />
        <input type="hidden"  name="payment_data[amount]" class="input-xlarge"  value="<?php echo $amount; ?>" />

</div>
	
<script>
	(function($){

		var onChangeOfflinePaymentDataFrom = 
			function(value)
			{
				//$('[data-rb-processor-offline="payment-data-id"]').prop('readonly',false);
				$('[data-rb-processor-offline="payment-data-id-div"]').show();
				$('[data-rb-processor-offline="payment-data-id-div"]').find('[data-rb-processor-offline="payment-data-id"]').prop('required',true);

				// if selected value is cash then no need any cheque or dd number
				if ($('[data-rb-processor-offline="payment-data-from"]').val() == 'cash') {
					//$('[data-rb-processor-offline="payment-data-id"]').prop('readonly',true);
					$('[data-rb-processor-offline="payment-data-id-div"]').hide();
					$('[data-rb-processor-offline="payment-data-id-div"]').find('[data-rb-processor-offline="payment-data-id"]').removeAttr('required');
				};					
			} 

			$('[data-rb-processor-offline="payment-data-from"]').on('change', function() {
				onChangeOfflinePaymentDataFrom();
			});
			
			onChangeOfflinePaymentDataFrom();
		
		})(rb.jQuery);
</script>
