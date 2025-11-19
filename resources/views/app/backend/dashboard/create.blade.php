<h1>Hello from modal {{ $new }}</h1>

<x-btn-modal :title="'New Amenity'" :url="path(['backend::dashboard.create', 'new' => 'CheckIt Out!'])" />

@include('core::modal')
