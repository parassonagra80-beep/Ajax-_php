<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>User_listing</h2>
                            </div>
                            <div class="col-md-6"><a href="add_edit.php" class="btn btn-success float-right">Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="user-listing">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        getListing();
        function getListing() {
            $.ajax({
                url: 'common_ajax.php',
                type: 'GET',
                data: { 'type': 'list' },
                success: function (data) {
                    try {
                        data = JSON.parse(data);
                    } catch (e) { }
                    if (data.status == 1) {
                        var html = '';
                        var no = 1;
                        $.each(data.data, function (key, val) {
                            html += "<tr>";
                            html += "<td>" + no++ + "</td>";
                            html += "<td>" + val.name + "</td>";
                            html += "<td>" + val.email + "</td>";
                            html += "<td>" + val.phone + "</td>";
                            html += "<td><a href='add_edit.php?id=" + val.id + "' class='btn btn-success'>Edit</a> <a href='javascript:void(0)' class='btn btn-danger btn_remove' data-id='" + val.id + "'>Delete</a></td>";

                            html += "</tr>";
                        });
                        $('.user-listing').html('');
                        $('.user-listing').html(html);
                    } else {
                        html += "<tr>"
                        html += "<td colspan='3' class='text-muted'>No User Found...!</td>";
                        html += "</tr>";
                        $('.user-listing').html('');
                        $('.user-listing').html(html);
                    }
                }
            })
        }

        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('data-id');
            console.log(id);
            if (id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'common_ajax.php',
                            type: 'POST',
                            data: { 'id': id, type: 'delete' },
                            success: function (data) {
                                try {
                                    data = JSON.parse(data);
                                } catch (e) { }
                                if (data.status == 1) {
                                    toastr.success(data.msg, 'success');
                                    getListing();
                                } else {
                                    toastr.error(data.msg, 'Error');
                                }
                            }
                        })

                    }
                });
            }

        });

        $(document).on('click','.btn-danger',function(){
            var id = $(this).attr(Image)
        });

    });

</script>