<div class="table-responsive">
    <table class="table" id="doctors-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Description</th>
        <th>Image</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>
            <td>{{ $doctor->description }}</td>
            <td>{{ $doctor->image }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['doctors.destroy', $doctor->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('doctors.show', [$doctor->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('doctors.edit', [$doctor->id]) }}" class='btn btn-default btn-xs'>
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
