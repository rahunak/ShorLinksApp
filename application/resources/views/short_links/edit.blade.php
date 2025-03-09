@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-start gap-3">
                            <h1 class="m-0"> Edit a short link</h1>
                            <button class="btn btn-primary" type="button" onclick="window.history.back();">Back</button>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form class="d-flex flex-column gap-3" action="{{ route('short_links.update', $shortLink) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $shortLink->title }}">
                            </div>
                            <div class="form-group">
                                <label for="original_url">Original URL</label>
                                <input type="url" name="original_url" id="original_url" class="form-control"
                                    value="{{ $shortLink->original_url }}" required>
                            </div>
                            <div class="form-group">
                                <label for="short_url">Short URL (optionally)</label>
                                <input type="text" name="short_url" id="short_url" class="form-control"
                                    value="{{ $shortLink->short_url }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
