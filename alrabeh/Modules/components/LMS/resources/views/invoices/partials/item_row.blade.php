   <tr>
               
      <td><span class="label label-danger">{{$item_type}} <input type="hidden" name="{{$item_type.'_data'}}[ids][]" value="{{$data['data']->id}}"></span></td>
      <td>{{$data['data']->title}}</td>
      <td>{{$data['price']}} <input type="hidden" name="{{$item_type.'_data'}}[{{$data['data']->id}}][price]" value="{{$data['data']->price}}"></td>
      <td><a href="javascript:;" class="btn btn-danger remove_item" data-url="{{route('ajax.invoices.remove_item', ['item'=>$item_type, 'item_id' => $data['data']->id, 'session_id' => $session_id])}}" data-price="{{$data['price']}}">X</a></td>
    </tr>