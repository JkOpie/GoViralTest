<div class="container-fluid">

    <div class="row">
        <div class="col-12 text-end">
            <button class="btn btn-primary" onclick="createNewOrder()">Create New Order</button>
        </div>
        <div class="col-12 col-md-9 pt-4">
            <div class="p-6 dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg w-100">
                <div class="row">
                    <div class="col-12 d-block d-md-none">
                        <div class="d-flex align-items-center justify-content-center py-3">
                            <div class="ml-4 text-lg leading-7 font-semibold text-white">Product</div>
                        </div>

                        <div class="row ">

                            <div class="col-6" 
                                @if (isset($first_order))
                                    @if ($first_order->status == "pending")
                                        onclick="add_product('Dutch Lady', 2, 1, {{$first_order->id}})"
                                    @endif
                                @endif
                                >
                            
                                <div class="product_item">
                                    <span>Dutch Lady</span>
                                </div>
                            </div>

                            <div class="col-6" 
                                @if (isset($first_order))
                                    @if ($first_order->status == "pending")
                                        onclick="add_product('Farm Fresh', 3, 1, {{$first_order->id}})"
                                    @endif
                                @endif
                                >
                                <div class="product_item" >
                                    <span>Farm Fresh</span>
                                </div>
                            </div>

                            <div class="col-6" 
                                @if (isset($first_order))
                                    @if ($first_order->status == "pending")
                                        onclick="add_product('Almond Milk', 4, 1, {{$first_order->id}})"
                                    @endif
                                @endif
                               
                                >
                                <div class="product_item">
                                    <span>Almond Milk</span>
                                </div>
                            </div>

                            <div class="col-6" 
                                @if (isset($first_order))
                                    @if ($first_order->status == "pending")
                                        onclick="add_product('Goodday Milk', 5, 1, {{$first_order->id}})"
                                    @endif
                                @endif
                                >
                                <div class="product_item">
                                    <span>Goodday Milk</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-md-6 cashier_border">

                        <div class="d-flex align-items-center flex-column">
                            <div class="ml-4 text-lg leading-7 font-semibold text-white">POS</div>
                            <div class="ml-4 text-lg leading-7 font-semibold text-white">Cashier</div>
                        </div>

                        <hr class="text-white">

                        <table class="table text-white table-borderless text-center">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody>

                                @include('order_items')

                                <tr class="subtotal_divider">
                                    <td colspan="4">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Subtotal</td>
                                    <td colspan="2"></td>
                                    <td class="text-center">RM <span class="subtotal"> {{ $calc_total['subtotal'] ?? 0.00}} </span></td>
                                </tr>
                                <tr>
                                    <td class="text-center">No. of items</td>
                                    <td colspan="2"></td>
                                    <td class="text-center"> <span class="no_items"> {{$calc_total['number_of_items'] ?? 0}}</span></td>
                                </tr>
                                <tr class="tax">
                                    <td class="text-center">Tax</td>
                                    <td colspan="2"></td>
                                    <td class="text-center">6%</td>
                                </tr>
                                <tr class="service_charge">
                                    <td class="text-center">Service Charge</td>
                                    <td colspan="2"></td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Total</td>
                                    <td colspan="2"></td>
                                    <td class="text-center"> RM <span class="total"> {{$calc_total['total'] ?? 0.00}}</span> </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            @if (isset($first_order))
                                @if ($first_order->status == "pending")
                                    <button class="btn btn-danger btn-cancel me-5" onclick="cancel_order({{$first_order->id}})">Cancel</button>
                                    <button class="btn btn-primary btn-checkout" onclick="checkout_order({{$first_order->id}})">Checkout</button>
                                @elseif($first_order->status == "completed")
                                    <button class="btn btn-success btn-checkout" onclick="refund({{$first_order->id}})">Refund</button>
                                @endif
                            @endif
                          
                        </div>

                    </div>

                    <div class="col-4 col-md-6 d-none d-md-block">
                        <div class="d-flex align-items-center justify-content-center py-3">
                            <div class="ml-4 text-lg leading-7 font-semibold text-white">Product</div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6" 
                                @if (isset($first_order))
                                    @if ($first_order->status == "pending")
                                        onclick="add_product('Dutch Lady', 2, 1, {{$first_order->id}})"
                                    @endif
                                @endif
                                >
                            
                                <div class="product_item">
                                    <span>Dutch Lady</span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6" 
                                @if (isset($first_order))
                                    @if ($first_order->status == "pending")
                                        onclick="add_product('Farm Fresh', 3, 1, {{$first_order->id}})"
                                    @endif
                                @endif
                                >
                                <div class="product_item" >
                                    <span>Farm Fresh</span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6" 
                                @if (isset($first_order))
                                    @if ($first_order->status == "pending")
                                        onclick="add_product('Almond Milk', 4, 1, {{$first_order->id}})"
                                    @endif
                                @endif
                               
                                >
                                <div class="product_item">
                                    <span>Almond Milk</span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6" 
                                @if (isset($first_order))
                                    @if ($first_order->status == "pending")
                                        onclick="add_product('Goodday Milk', 5, 1, {{$first_order->id}})"
                                    @endif
                                @endif
                                >
                                <div class="product_item">
                                    <span>Goodday Milk</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 pt-4">
            <div class="dark:bg-gray-800 shadow sm:rounded-lg w-100 p-3">

                <div class="d-flex align-items-center justify-content-center py-3">
                    <div class="ml-4 text-lg leading-7 font-semibold text-white">Order</div>
                </div>
                
                <ul class="list-group">
                    @foreach ($orders as $key => $order)
                        <li class="list-group-item d-flex justify-content-between align-items-center @if($order->id == $first_order->id) active @endif" onclick="show_order({{$order->id}})">
                            <span >{{$order->reference_no}} ( {{$order->status}} )</span>
                            {{-- <button class="btn btn-danger" onclick="delete_order(this, {{$order->id}})"><i class="fa-solid fa-trash"></i></button> --}}
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="/transaction" method="post">
                    @csrf

                    <input type="hidden" name="order_id" 
                        @if (isset($first_order))
                            value="{{$first_order->id}}"
                        @endif
                    >

                    <div class="row align-items-center">
                        <div class="col-7">
                            <label>Total Paid Amount (RM)</label>
                        </div>
                        <div class="col-5">
                            <input type="number" name="paid_amount_cents" class="form-control" onkeyup="calc_change()">
                        </div>
                    </div>

                    <div class="row align-items-center pt-3">
                        <div class="col-7">
                            <label class="w-100">Total</label>
                        </div>
                        <div class="col-5">
                            RM <span class="transaction_total">0.00</span>
                        </div>
                    </div>

                    <div class="row align-items-center pt-3">
                        <div class="col-7">
                            <label class="col-6">Payment Method</label>
                        </div>
                        <div class="col-5">
                            <select name="payment_method" class="form-control col-6">
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-center pt-3">
                        <div class="col-7">
                            <label>Change</label> <br>
                        </div>
                        <div class="col-5">
                            RM <span class="transaction_change">0.00</span>
                            <input type="hidden" name="change" >
                        </div>
                    </div>

                    <div class="transaction_errors pt-3">
                        <span class="text-danger"></span>
                    </div>

                    <div class="text-end pt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit_tansaction" disabled>Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>

    var product = [];

    $('table tbody tr.product_items td:nth-child(1)').each( (k,v) => {

        if(!product.includes($(v).text().trim())){
            product.push($(v).text().trim())
        }
        
    });

    function delete_order(element , id){
        $.ajax({
            url: '/order/'+id,
            method: "delete",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (reponse) {  
                if(reponse == '1'){
                    window.location.replace("/");
                }
            }
        });
    }

    function add_product(product_name, cost_per_item, quantity, order_id){

        if(validate_product(product_name)){

            $.ajax({
                url: '/orderitems',
                method: "post",
                data: {
                    "order_id" : order_id,
                    "product_name": product_name,
                    "cost_per_item" : cost_per_item,
                    "quantity" : quantity
                },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {  
                    
                    $('table tbody').prepend(
                        $('<tr>').attr({'class':'product_items', 'id': 'order_item_'+response.orderitem.id}).append(
                            $('<td>').append(
                                $('<span>').addClass('product_name').text(response.orderitem.product_name)
                            ),
                            $('<td>').text('RM ').append(
                                $('<span>').addClass('cost_per_item').text(response.orderitem.cost_per_item)
                            ),
                            $('<td>').append(
                                $('<div>').addClass('position-relative').append(
                                    $('<button>').addClass('position-absolute btn btn-primary product_quantity right').attr('onclick',"product_item_cal("+response.orderitem.id+", 'plus')").text('+'),
                                    $('<span>').addClass('quantity').text(response.orderitem.quantity),
                                    $('<button>').addClass('position-absolute btn btn-danger product_quantity left').attr('onclick',"product_item_cal("+response.orderitem.id+", 'minus')").text('-'),
                                )
                            ),
                            $('<td>').text('RM ').append(
                                $('<span>').addClass('cost').text( parseInt(response.orderitem.cost_per_item) * parseInt(response.orderitem.quantity))
                            ),
                        )
                    )

                    $('.subtotal').text(response.data.subtotal);
                    $('.no_items').text(response.data.number_of_items);
                    $('.total').text(response.data.total);

                }
            });

            
        }

        
    }

    function validate_product(product_name){
        
        if(!product.includes(product_name.trim())){
            product.push(product_name.trim());
            return true;
        }

        return false;
    }

    function cancel_order(id){
        $.ajax({
            url: '/order/'+id,
            method: "delete",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (reponse) {  
                if(reponse == '1'){
                    window.location.replace("/");
                }
            }
        });
    }

    function checkout_order(id){

        $.ajax({
            url: '/calc-total/'+id,
            method: "get",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {  
                $('.transaction_total').text(response.total);
            }
        });
        
        var myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
        myModal.show();

    }

    function calc_change(){
        var total_paid_amount = $('input[name=paid_amount_cents]').val();
        console.log(total_paid_amount);
        var total = $('.transaction_total').text().trim();
        var change = 0

        if(total_paid_amount > 0 && total > 0){

            change = parseFloat(total_paid_amount) - parseFloat(total)
            $('.transaction_change').text(change.toFixed(2))

            if(change.toFixed(2) < 0){
                $('.transaction_errors span').text('Invalid total paid amount');
                $('.submit_tansaction').prop('disabled', true);
              
            }else{
                $('.transaction_errors span').text('');
                $('.submit_tansaction').prop('disabled', false);
               
            }

            $('input[name=change]').val(change);

        }

    }

    function createNewOrder(){
        $.ajax({
            url: '/order',
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {  
                window.location.replace("/order/"+response.id);
            }
        });
    }

    function refund(id){
        $.ajax({
            url: '/order/'+id,
            method: "put",
            data: {
                "status" : "refunded"
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {  
                window.location.replace("/order/"+response.id);
            }
        });
    }

    function show_order(id){
        window.location.replace("/order/"+id);
    }
</script>










