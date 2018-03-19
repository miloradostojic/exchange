/* 
 * Custom JS
 */

function checkIfNumber(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function calculateAmount() {
    var currency = $('#currency').val();
    var amount = $('#amount').val();
    
    if ( currency && amount > 0){
        $.ajax({
            type: "GET",
            url: "/exchange/calculate",
            data:{currency: currency, amount: amount},
            dataType: "json",
            success: function(data) {
                $(".payment-div").empty();
                $(".payment-div").append('<p>You need to pay '+data.to_pay+' USD with '+data.surcharge_percent+'% surcharge and '+data.discount_percent+'% discount, which is total <b>'+data.total_to_pay+'</b>  USD.</p>\
                                           <input class="btn btn-primary" type="button" value="Purchase" onclick = "purchase()"/>' );
            }
        });
    }else{
        $(".payment-div").empty();
    }
}

function purchase() {
    var currency = $('#currency').val();
    var currencyName = $('#currency option:selected').text();
    var amount = $('#amount').val();
    
    if ( currency && amount > 0){
        $.ajax({
            type: "POST",
            url: "/exchange/purchase",
            data:{currency: currency, amount: amount},
            dataType: "json",
            success: function() {
                $('#modal-text').text(amount+' '+currencyName);
                $('#purchaseModal').modal('show');
            }
        });
    }
}



