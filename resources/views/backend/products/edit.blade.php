@extends('adminlte::page')

@section('title', 'Edit Product')

@section('content')

<form action="{{ route('products.update', $product->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label>Name</label>

        <input type="text"
               name="name"
               value="{{ $product->name }}"
               class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Description</label>

        <textarea name="description"
                  class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label>Price</label>

        <input type="number"
               step="0.01"
               name="price"
               value="{{ $product->price }}"
               class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Quantity</label>

        <input type="number"
               name="stock"
               value="{{ $product->stock }}"
               class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Status</label>

        <select name="status" class="form-control">

            <option value="on"
                {{ $product->status == 'on' ? 'selected' : '' }}>
                On
            </option>

            <option value="off"
                {{ $product->status == 'off' ? 'selected' : '' }}>
                Off
            </option>

        </select>
    </div>

    <button class="btn btn-primary">
        Update Product
    </button>

</form>

@stop