@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1>Create a short link</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="d-flex flex-column gap-3" action="{{ route('short_links.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label for="original_url">Original URL</label>
                                <input type="url" name="original_url" id="original_url" class="form-control"
                                    placeholder="Enter Original URL" required>
                            </div>
                            <div class="form-group">
                                <label for="short_url">Short URL (optionally)</label>
                                <input type="text" name="short_url" id="short_url" class="form-control"
                                    placeholder="Enter Short URL (leave blank for automatic generation)">
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
