@extends('layouts.main')
@section('content')
<!-- 
<div class="container-fluid">
                
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Default Input</h4>
                                <h6 class="card-subtitle">To use add <code>form-control</code> class to the input</h6>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   
                   
                    
                    
                </div>
                
             
           
            </div> -->


<div class="container-fluid">
    <div class="row">
        @foreach($allcoursesLists as $allcoursesList)
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card text-center">  <!-- Center align content -->
                    <div class="card-body">
                        <!-- Course Name -->
                        <h4 class="card-title">{{ $allcoursesList->name }}</h4>
                        <!-- Course Description -->
                        <h6 class="card-subtitle text-muted">{{ $allcoursesList->description }}</h6>
                        
                        <!-- Clickable Image to Open Video -->
                        <div class="mt-3">
                            <a href="{{ route('coursesByid', ['id' => encrypt($allcoursesList->id.'.'.$allcoursesList->name.'.'.$allcoursesList->category_id)]) }}">
                                <img src="{{asset('assets/images/couseimages.jpg')}}" 
                                     alt="Course Image" class="img-fluid rounded" 
                                     style="width:100%; max-height:250px; cursor:pointer;">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection