@extends('layouts.student')

@section('title', 'Notices')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Notices</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if($notices->count() > 0)
            @foreach($notices as $notice)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $notice->title }}</h5>
                        <small class="text-muted">{{ $notice->created_at->format('M d, Y') }}</small>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $notice->content }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                <p class="mb-0">No notices available.</p>
            </div>
        @endif
    </div>
</div>
@endsection

