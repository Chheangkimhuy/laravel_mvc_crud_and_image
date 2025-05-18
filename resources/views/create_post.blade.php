<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form method="POST" action="/submit-post" enctype="multipart/form-data" class="p-4 bg-white rounded shadow"
            style="width: 100%; max-width: 500px;">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control shadow-none border-1" name="title" id="title" placeholder="Title">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control shadow-none border-1" name="description" id="description"
                    placeholder="Description">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100">Submit</button>
        </form>
    </div>

</body>

</html>
