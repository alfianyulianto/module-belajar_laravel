@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Ctageories</h1>
    </div>
    <div class="table-responsive col-lg-6">
        <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Create new category</a>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="">
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $category->name }}</td>
                        <td class="align-middle">
                            <a href="/dashboard/catagories/{{ $category->slug }}" class="btn btn-info pt-0"><span
                                    data-feather="eye"></span></a>
                            <a href="/dashboard/catagories/{{ $category->slug }}/edit" class="btn btn-warning pt-0"><span
                                    data-feather="edit"></span></a>
                            <form action="/dashboard/categories/{{ $category->slug }}" method="post"
                                class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger pt-0" onclick="return confirm('Are you sure?')"><span
                                        data-feather="x-circle"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
