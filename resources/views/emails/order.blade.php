<!--email template after order-->
<table>

        <tr>
            <td>Order</td>
        </tr>
        <tr>
            <td>
                <br />
            </td>
        </tr>
        <tr>
            <td>You have successfully bought {{ $order->currency_amount }} {{ $order->currency->name }}.</td>
        </tr>
        <tr>
            <td>Exchange rate: {{ $order->exchange_rate }}.</td>
        </tr>
        <tr>
            <td>Surcharge amount: {{ $order->surcharge_amount }}.</td>
        </tr>
        <tr>
            <td>Discount amount: {{ $order->exchange_rate }}.</td>
        </tr>
        <tr>
            <td>Paid amount in USD: {{ $order->paid_amount_usd }}.</td>
        </tr>
        <tr>
            <td>
                <br />
            </td>
        </tr>
        <tr>
            <td>Menu-exchange</td>
        </tr>
        
</table>