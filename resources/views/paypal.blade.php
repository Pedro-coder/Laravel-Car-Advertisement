<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">
    <input type="hidden" name="business" value="sumit.wgt@gmail.com"> 
    <input type="hidden" name="cmd" value="_xclick"> 
    <input type="hidden" name="item_name" value="trasfer"> 
    <input type="hidden" name="item_number" value="order#01">
    <input type="hidden" name="amount" value="1000">   
    <input type="hidden" name="currency_code" value="USD">   
    <input type="hidden" name="cancel_return" value="http://demo.expertphp.in/payment-cancel"> 
    <input type="hidden" name="return" value="http://127.0.0.1:8000/payment-status">
</form>
<SCRIPT>document.frmTransaction.submit();</SCRIPT>