<div class="container-fluid">
    <form method="POST" action="/saveOrder">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
        <div class="form-group">
            <label for="email_client">email_клиента</label>
            <input type="email" class="form-control" name="email_client" id="email_client" value="{{$order->client_email}}" required>
        </div>
        <div class="form-group">
            <label for="partner">партнер</label>
            <select class="form-control" name="partner" required>
                @foreach($partners as $partner)
                    <option value="{{$partner->id}}" @if($order->partner->id === $partner->id) selected @endif>{{$partner->name}}</option>
                @endforeach
            </select>
        </div>

        <label>Состав заказа</label>
        <ul>
            @foreach($order->orderProduct as $product)
                <li>{{$product->product->name}} - Количество {{$product->quantity}}</li>
            @endforeach
        </ul>
        <div class="form-group">
            <label>статус заказа</label>
            <select class="form-control" name="status" required>
                <option value="0" @if($order->status === 0) selected @endif>новый</option>
                <option value="10" @if($order->status === 10) selected @endif>подтвержден</option>
                <option value="20" @if($order->status === 20) selected @endif>завершен</option>
            </select>
        </div>
        <p>Стоимость заказа - {{$order->orderProduct->sum('cost')}}</p>
        <input type="hidden" name="id" value="{{$order->id}}">
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>