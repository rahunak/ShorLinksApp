@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-start gap-3">
                            <h1 class="m-0">List of short links</h1>
                             <a href="{{ route('short_links.create') }}" class="btn btn-primary">Create a short link</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                      

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="d-none d-lg-table-cell">Original URL</th>
                                        <th class="d-none d-md-table-cell">Title</th>
                                        <th>Short URL</th>
                                        <th class="d-none d-sm-table-cell">Crossings</th>
                                        <th class="d-none d-md-table-cell">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($urls as $url)
                                        <tr>
                                            <td class="d-none d-lg-table-cell">{{ $url->original_url }}</td>
                                            <td class="d-none d-md-table-cell">{{ $url->title }}</td>
                                            <td><a href="{{ url($url->short_url) }}">{{ url($url->short_url) }}</a></td>
                                            <td class="d-none d-sm-table-cell">{{ $url->clicks }}</td>
                                            <td class="d-none d-md-table-cell">
                                                <a href="{{ route('short_links.edit', $url) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ route('short_links.destroy', $url) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
