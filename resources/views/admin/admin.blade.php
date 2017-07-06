@extends('layouts.admin_layout')

@section('title')
    Admin Console
@stop

@section('content')
    <div class="container flow-text">
        <div class="card">
            <div class="card-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Images</h4></li>
                    <li class="collection-item"><a href="{{ route('image_list') }}">Image List</a></li>
                    <li class="collection-item"><a href="{{ route('image_upload') }}">Upload Images</a></li>
                    <li class="collection-item"><a href="{{ route('image_folder_list') }}">Image Folder List</a></li>
                    <li class="collection-item"><a href="{{ route('image_folder_create') }}">Add Image Folder</a></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Home Page</h4></li>
                    <li class="collection-item"><a href="{{ route('home_edit') }}">Edit Home Page</a></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Blog Posts</h4></li>
                    <li class="collection-item"><a href="{{ route('blog_admin_list') }}">Blog Post List</a></li>
                    <li class="collection-item"><a href="{{ route('blog_create') }}">Create Post</a></li>
                </ul>
            </div>
        </div>
    </div>
@stop