<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $popular->product_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $popular->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $popular->updated_at }}</p>
</div>

