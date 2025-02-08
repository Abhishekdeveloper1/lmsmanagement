@extends('layouts.main')
@section('content')
<style>
.pagination {
    display: flex;
    justify-content: center;
    padding: 10px;
    list-style: none;
}

.page-item.active .page-link {
    background-color: #007bff !important;
    border-color: #007bff !important;
    color: white !important;
}

.page-item .page-link {
    color: #007bff !important;
    border: 1px solid #007bff;
    padding: 8px 12px;
    margin: 2px;
    border-radius: 5px;
    text-decoration: none;
}

.page-item .page-link:hover {
    background-color: #0056b3 !important;
    color: white !important;
}

.page-item.disabled .page-link {
    color: #6c757d !important;
    background-color: #e9ecef !important;
    border-color: #dee2e6 !important;
    cursor: not-allowed;
}

    </style>
<div class="container-fluid">

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Column -->
                                    <!-- <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-primary text-center">
                                                <h6 class="text-white">Add New Courses</h6>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
    <!-- <div class="card card-hover" data-toggle="modal" data-target="#addCourseModal">
        <div class="p-2 bg-primary text-center">
            <h6 class="text-white">Add New Course</h6>
        </div>
    </div> -->
    <div class="card card-hover text-center">
    <button type="button" class="btn btn-primary p-3 w-100" data-toggle="modal" data-target="#addCourseModal">
        Add New Course
    </button>
</div>

</div>
                                    <!-- Column -->
                                    <!-- <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-cyan text-center">
                                                <h1 class="font-light text-white">1,738</h1>
                                                <h6 class="text-white">Responded</h6>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- Column -->
                                    <!-- <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-success text-center">
                                                <h1 class="font-light text-white">1100</h1>
                                                <h6 class="text-white">Resolve</h6>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- Column -->
                                    <!-- <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-danger text-center">
                                                <h1 class="font-light text-white">964</h1>
                                                <h6 class="text-white">Pending</h6>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- Column -->
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <!-- <th>Status</th> -->
                                                <th>Name</th>
                                                <th>Video</th>
                                                <th>Pdf</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <!-- <th>Agent</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($courseLists as $courseList)

                                            <tr>
                                                <!-- <td><span class="badge badge-light-warning">In Progress</span></td> -->
                                                <td><a href="javascript:void(0)" class="font-weight-medium link">
                                                       {{$courseList->name}}</a></td>
                                                <td><iframe src="{{ $courseList->video_path }}" >
                            </iframe></td>
                                                <td><iframe src="{{$courseList->pdf_path}}" 
                                    >
                            </iframe></td>
                                                <td>{{ $courseList->category->name }}</td>
                                                <td>{{$courseList->description}}</td>
                                                <!-- <td>Fazz</td> -->
                                            </tr>
                                           @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <!-- <th>Status</th> -->
                                                <th>Title</th>
                                                <th>ID</th>
                                                <th>Product</th>
                                                <th>Created by</th>
                                                <th>Date</th>
                                                <!-- <th>Agent</th> -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                    @if ($courseLists->lastPage() > 1)
                                    <div class="d-flex justify-content-center">
                                        {{ $courseLists->links('pagination::bootstrap-4') }}
                                    </div>
                                @endif
                                </div>

                                    <!-- <ul class="pagination float-right">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
<!-- Modal for adding a new course -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- modal-lg for larger width -->
        <div class="modal-content">
            <div class="modal-header bg-primary text-white"> <!-- Styled header -->
                <h5 class="modal-title" id="addCourseModalLabel">Add New Course</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4"> <!-- Added padding for better spacing -->
                <form action="{{ route('addCoursedata') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Course Name</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="video" class="font-weight-bold">Video Path</label>
                        <input type="text" class="form-control shadow-sm" id="video" name="video_path" >
                    </div>
                    <div class="form-group">
                        <label for="pdf" class="font-weight-bold">PDF Path</label>
                        <input type="text" class="form-control shadow-sm" id="pdf" name="pdf_path" >
                    </div>
                    <div class="form-group">
                        <label for="category" class="font-weight-bold">Category</label>
                        <select class="form-control shadow-sm" id="category" name="category_id" required>
                            <option value="{{ encrypt(1) }}">Executive</option>
                            <option value="{{ encrypt(2) }}">Basic</option>
                            <option value="{{ encrypt(3) }}">Advanced</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Description</label>
                        <textarea class="form-control shadow-sm" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block shadow">Add Course</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif -->
       
