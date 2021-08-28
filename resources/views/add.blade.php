@extends('layouts.app')

@section('css-add')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
    <div class="form">
        <h2>FORM TAMBAH GABAH</h2>
        <form action="">
            <label for="total-berat">Total Berat</label>
            <input type="text" id="total-berat" name="total-berat" placeholder="">

            <label for="total-harga">Total Harga</label>
            <input type="text" id="total-harga" name="total-harga" placeholder="">
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
@endsection
