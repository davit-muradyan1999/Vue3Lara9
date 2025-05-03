@extends('../admin')
@section('content')
<div class="card">
    <div class="card-body">
        <h4>Request Price:</h4>

        <div class="table-responsive">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Product Title, ID</th>
                        <th>Product Img</th>
                        <th>User Info</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                @foreach ($request_price as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->title['am'] ?? '---' }}, {{ $item->product->id }}</td>
                            <td>
                                @if(isset($item->product->images))
                                    <img src="{{ asset('storage/'.$item->product->images[0]) }}" alt="" width="50" height="50">
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column;">
                                    <p>{{ $item->email ?? '---' }}</p>
                                    <p>{{ $item->phone_number ?? '---' }}</p>
                                </div>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $request_price->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
