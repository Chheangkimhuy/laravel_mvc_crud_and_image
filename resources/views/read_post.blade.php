<!DOCTYPE html>
<html>

<head>
    <title>Read Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">All Posts</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="/create" class="btn btn-primary mb-3">Create New Post</a>

        <table class="table table-bordered text-center">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>
                        @if ($post->image)
                            <img src="{{ asset('uploads/' . $post->image) }}" alt="Image" width="100" height=70"
                                style="object-fit:cover; max-height:100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <!-- Button to open modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#updateModal{{ $post->id }}">
                            Update
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="updateModal{{ $post->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Post #{{ $post->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <label style="float: left">Title:</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $post->title }}">
                                            <label style="float: left">Description:</label>
                                            <input type="text" name="description" class="form-control"
                                                value="{{ $post->description }}">
                                            <label for="image" style="float: left">Image:</label>
                                            <input type="file" name="image" class="form-control">
                                            @if ($post->image)
                                                <img src="{{ asset('uploads/' . $post->image) }}" alt="Current Image"
                                                    width="150" class="d-none">
                                            @endif
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this post?')">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach

        </table>
    </div>
</body>

</html>
