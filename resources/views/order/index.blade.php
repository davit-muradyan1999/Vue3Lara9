@extends('../admin')
@section('content')
<div class="card">
    <div class="card-body">
        <h4>Orders:</h4>

        <div class="table-responsive">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Title, ID</th>
                        <th>Product Img</th>
                        <th>Count</th>
                        <th>User Info</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                @foreach ($orders as $order)
                    @php
                        $items = json_decode($order->items ?? '[]');
                    @endphp

                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->title->am ?? '---' }}, {{ $item->product->id }}</td>
                            <td>
                                @if(isset($item->product->images))
                                    <img src="{{ asset('storage/'.$item->product->images[0]) }}" alt="" width="50" height="50">
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <div style="display: flex; flex-direction: column;">
                                    <p>{{ $item->user->full_name ?? '---' }}</p>
                                    <p>{{ $item->user->email ?? '---' }}</p>
                                    <p>{{ $item->user->phone_number ?? '---' }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
