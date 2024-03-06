@if(count($investor_product))
    @foreach($investor_product as $num=>$product)

        <tr>
            <td>
                [{{$num+=1}}]
                <input type="checkbox" name="item_{{$num}}" id="item_{{$num}}" onchange="select_item({{$num}})">
                {{$product->product->name}}
            </td>
            <td>
                {{$product->quantity}}
                <input type="hidden" name="main_quantity_{{$num}}" value="{{$product->quantity}}">
            </td>
            <td><input name="quantity_{{$num}}" disabled="" id="quantity_{{$num}}" onkeyup="data({{$num}});"
                       type="number" step="any" min="1" max="{{$product->quantity}}"
                       class="form-control amount" value=0>
                <input type="hidden" value="{{$product->product_id}}" name="product_id_{{$num}}">
            </td>
            <td>
                <input name="item_price" value="{{$product->price}}" type="number" step="any"   id="payment_price_{{$num}}"
                       disabled="" min="0" class= "form-control">
                <input name="payment_price_{{$num}}" type="hidden" value="{{$product->price}}"class= "form-control">
            </td>
            <td><input name="price_{{$num}}" id="price_{{$num}}" disabled="" type="number" step="any" onkeyup="data();" min="0"
                       class="form-control"></td>
            <td>
                <input type="hidden" value="{{count($investor_product)}}" id="product_num">
                <input type="number" step="any" style="width: 150px;" name="total_{{$num}}" id="total_{{$num}}"
                       class="form-control total_{{$num}}" placeholder="0" onkeyup="tPrice({{$num}});" min="0" disabled="">
            </td>
        </tr>
    @endforeach

@else

    <tr>
        <td colspan="6" style="font-size: 21px;background: #f1363661;">
            <span> لا يوجد لدى المستثمر أي سلعة متوفرة بالمخزون , </span>
            <a href="{{route('store.buy_product')}}" target="_blank"> يرجى شراء سلعة للمستثمر</a>
            <span>  ثم اعد اختيار المستثمر من جديد </span>
        </td>
    </tr>

@endif