<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
    </div>
    <div class="card-body">
        <table id="{{ $id }}" class="table table-bordered table-striped">
            <thead>
                <tr>
                    @foreach ($columns as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        $('#{{ $id }}').DataTable({
            responsive: true,
            autoWidth: false,
        });
    });
</script>
@endpush