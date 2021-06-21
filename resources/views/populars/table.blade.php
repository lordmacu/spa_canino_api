<div class="table-responsive">
    <table class="table" id="populars-table">
        <thead>
            <tr>
                <th>Product Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($populars as $popular)
            <tr>
                <td>{{ $popular->product_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['populars.destroy', $popular->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('populars.show', [$popular->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('populars.edit', [$popular->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
