@extends('layouts::backend')
@push('title', 'Dashboard')

@push('breadcrumb')
@endpush

@section('content')
    <x-btn-modal :title="'New Amenity'" :url="path(['backend::dashboard.create', 'new' => 'CheckIt Out!'])" />
    <x-btn-canvas :title="'New Amenity'" :url="path(['backend::dashboard.create', 'new' => 'CheckIt Out!'])" />

    <x-btn-delete :title="'New Amenity'" :url="route('classes.store')" />
@endsection
