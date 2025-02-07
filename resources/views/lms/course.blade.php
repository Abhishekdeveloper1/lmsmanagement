@extends('layouts.main')
@section('content')

<div class="container-fluid">
    <div class="row">
        @foreach($courseLists as $course)
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">{{ $course->name }}</h4>
                        <h6 class="card-subtitle">{{ $course->description }}</h6>

                        <!-- Video Embed -->
                        @if(!empty($course->video_path))
                        <div class="embed-responsive embed-responsive-16by9 mb-3">
                            <iframe src="{{ $course->video_path }}" 
                                    width="100%" height="300" 
                                    allow="autoplay; fullscreen">
                            </iframe>
                        </div>
                        @endif

                        <!-- PDF Embed Inside Iframe -->
                        @if(!empty($course->pdf_path))
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src="{{$course->pdf_path}}" 
                                    width="100%" height="400">
                            </iframe>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
