<h2>New Order Received</h2>

<p><strong>Total:</strong> ${{ $order->total }}</p>

<h3>Items:</h3>
<ul>
    @foreach(json_decode($order->items) as $item)
        <li>{{ $item->product->title->en }} x {{ $item->quantity }} — ${{ $item->product->price }}</li>
    @endforeach
</ul>
