@extends('adminlte::page')

@section('title', 'Create Product')

@section('content')

<form action="{{ route('products.store') }}" method="POST">

    @csrf

    <div class="form-group mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Quantity</label>
        <input type="number" name="stock" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Status</label>

        <select name="status" class="form-control">
            <option value="on">On</option>
            <option value="off">Off</option>
        </select>
    </div>

    <button class="btn btn-success">
        Save Product
    </button>

</form>

@stop