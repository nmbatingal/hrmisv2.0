@extends('layouts.optima.app')

@section('title')
Search Result
@endsection

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="m-t-40"></div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Search Result For "{{ request('q') }}"</h4>
                <h6 class="card-subtitle">About {{ request('q') }} result</h6>
                <ul class="search-listing">
                    <li>
                        <h3><a href="javacript:void(0)">AngularJs</a></h3>
                        <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">AngularJS — Superheroic JavaScript MVW Framework</a></h3>
                        <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">AngularJS Tutorial - W3Schools</a></h3>
                        <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">Introduction to AngularJS - W3Schools</a></h3>
                        <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">AngularJS Tutorial</a></h3>
                        <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">Angular 2: One framework.</a></h3>
                        <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                </ul>
                <nav aria-label="Page navigation example" class="m-t-40">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
@endsection

@section('scripts')
@endsection