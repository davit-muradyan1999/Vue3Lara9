@extends('../admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('users.create') }}" class="btn btn-outline-primary">Add User</a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                      <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Is Admin</th>
                                        <th>Is Private</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td><a href="{{ route('users.show', $item->id) }}">{{ $item->id }}</a></td>
                                        <td> {{ $item->full_name }} </td>
                                        <td> {{ $item->email }} </td>
                                        <td>
                                            <input type="checkbox"
                                                   data-id="{{ $item->id }}"
                                                   data-field="is_admin"
                                                   class="toggle-user-field"
                                                {{ $item->is_admin ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="checkbox"
                                                   data-id="{{ $item->id }}"
                                                   data-field="is_private"
                                                   class="toggle-user-field"
                                                {{ $item->is_private ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggle-user-field').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const userId = this.dataset.id;
                    const field = this.dataset.field;
                    const value = this.checked ? 1 : 0;

                    fetch(`/admin/users/${userId}/toggle`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            field: field,
                            value: value
                        })
                    }).then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                alert('Ошибка при обновлении!');
                            }
                        }).catch(error => {
                        console.error(error);
                        alert('Ошибка соединения!');
                    });
                });
            });
        });
    </script>
@endsection
