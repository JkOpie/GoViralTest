

@if (isset($order_items))
    @foreach ($order_items as $order_item)
        <tr class="product_items" id="order_item_{{$order_item->id}}">
            <td> <span class="product_name">{{$order_item->product_name}}</span></td>
            <td>RM <span class="cost_per_item">{{$order_item->cost_per_item}}</span></td>
            <td>
                <div class="position-relative">
                    @if ($first_order->status == "pending")
                        <button class="position-absolute btn btn-primary product_quantity right" onclick="product_item_cal({{$order_item->id}}, 'plus')">+</button>
                    @endif
                        <span class="quantity">{{$order_item->quantity}}</span> 
                    @if ($first_order->status == "pending")
                        <button class="position-absolute btn btn-danger product_quantity left" onclick="product_item_cal({{$order_item->id}}, 'minus')">-</button>
                    @endif
                    
                </div>
            </td>
            <td>RM <span class="cost">{{ $order_item->cost_per_item * $order_item->quantity }}</span></td>
        </tr>
    @endforeach
@endif

<script>
    function product_item_cal(id, operation){

        var quantity = $('#order_item_'+id).find('.quantity').text();
        var cost_per_item = $('#order_item_'+id).find('.cost_per_item').text();
        var current_quantity = 0;
        var current_cost = 0

        if(operation == 'minus'){
            current_quantity = parseInt(quantity) - 1;
        }else if(operation == 'plus'){
            current_quantity = parseInt(quantity) + 1;
        }

        console.log(quantity);

        if(current_quantity > 0 ){

            $('#order_item_'+id).find('.quantity').text(current_quantity);
            current_cost = parseInt(cost_per_item) * parseInt(current_quantity);

            $.ajax({
                url: '/orderitems/'+id,
                method: "put",
                data: {
                    "quantity" : current_quantity,
                    "cost" : current_cost,
                },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {  
                    $('.subtotal').text(response.subtotal);
                    $('.no_items').text(response.number_of_items);
                    $('.total').text(response.total);
                }
            });

        }else{

            $.ajax({
                url: '/orderitems/'+id,
                method: "delete",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {  
                    $('#order_item_'+id).remove();

                    $('.subtotal').text(response.subtotal);
                    $('.no_items').text(response.number_of_items);
                    $('.total').text(response.total);
                }
            });
        }

        $('#order_item_'+id+' td:nth-child(4)').find('.cost').text( current_cost );

    }
</script>

