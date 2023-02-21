@extends("layouts.layout")

@section("seccion1")

<div id="app">

    <v-users :userconected="{{ Auth::user() }}"></v-users>
                
</div>

@endsection