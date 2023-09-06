<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Komentar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--   Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!--  </End icon   -->

</head>

<body>

    <!--  Main content-->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" id="comment_form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name" name="name" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" style="height: 100px;"></textarea>
                    </div>

                    <input type="hidden" name="parent_id" id="parent_id" value="0" />
                    <div class="btn-group mb-3">
                        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>
                        <button type="button" id="btnEdit" style="display:none;" class="btn btn-warning me-3">Edit</button>
                        <button type="button" id="btnCancel" style="display:none;" class="btn btn-danger">Cancel</button>
                    </div>
                </form>

                <!-- Comment Results -->
                <div class="overflow-auto border border-2 pt-1 ps-1 mb-5" style="max-height: 400px; background-color:whitesmoke;">
                    <div id="userComments"></div>
                </div>
                <!-- </End Comment Results -->
            </div>
        </div>
    </div>

    <!-- </End main content-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="script.js"></script>
</body>

</html>