<div class="container-fluid">
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>наименование_продукта</th>
            <th>наименование_поставщика</th>
            <th>цена</th>

        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->vendor->name}}</td>
                <td>
                    <input type="number" id="price" value="{{$product->price}}">
                    <input type="hidden" id="id" value="{{$product->id}}">
                    <a href="#" id="changePrice">Обновить</a>
                    <div class="productMsg-{{$product->id}}"></div>
                </td>
            </tr>
        @endforeach
        {{$products->links()}}
    </table>
</div>
<script src="{{ asset('js/script.js') }}"></script>