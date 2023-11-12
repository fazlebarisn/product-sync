(function ($) {
    $(document).ready(function () {
        
        // when change quantity, cart will auto update
        $('div.woocommerce').on('change', 'input.qty', function(){
            var enableUpdate = CT_Data.settings.others.cart_auto_update;
            if(enableUpdate){
                $('[name="update_cart"]').trigger('click');
            }
        });
  
    });
  })(jQuery);
  