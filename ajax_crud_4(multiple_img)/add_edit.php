<?php
require_once "conn.php";

$id = $_GET["id"] ?? '';
$data = [];
if ($id) {
    $sql =  "SELECT users.* , GROUP_CONCAT(post_image.image) AS image, GROUP_CONCAT(post_image.post_id) AS post_id 
            FROM users 
            INNER JOIN post_image ON post_image.post_id = users.id 
            WHERE users.id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    //  echo "<pre>";
    //         print_r($data);
    //         exit;
    $data['image'] = explode(',', $data['image']);
}
$view_image = $data['image'] ??'';
?>
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Document</title>
    <style>
        .error {
            color: red;
        }

        /* .img-box {
            width: 100%;
            height: 300px;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 10px;
            background-color: #f7f7f7;
            padding: 10px;
        }

        .img-preview {
            width: 100px;
            height: 150px;
        }

        .img-group span i {
            font-size: 30px;
            position: absolute;
            left: 100px;
            color: white;
        }
                   */
        .img-box {
            display: inline;
            margin-left: 5px;

        }

        .container img {
            width: 100px;
            height: 100px;
            margin: 5px;
            box-shadow: 0px 0px 3px black;
            position: relative;
            padding: 5px;
        }

        .del-btn {
            opacity: 0;
            position: relative;
            margin-left: -25px;
            top: -39px;
            color: black;
            text-decoration: none;
        }

        .del-btn:hover {
            color: black;
            text-decoration: none;
        }

        .img-box:hover .del-btn {
            opacity: 1;
        }

        .del-btn i {

            background: rgba(109, 106, 106, 0.84);
            border-radius: 10px;
            padding: 2px;
            font-size: 13px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Register</h2>
                            </div>
                            <div class="col-md-6"><a href="index.php" class="btn btn-success float-right">List</a></div>
                        </div>
                    </div>
                    <form action="javascript:void(0)" method="POST" id="myform" enctype="multipart/form-data">
                        <input type="hidden" value="add_edit" name="type">
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?? ''; ?>">
                        <input type="hidden" name="post_id" value="<?php echo $data['post_id'] ?? ''; ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Full Name :</label>
                                <input type="text" name="full_name" class="form-control"
                                    value="<?php echo $data['name'] ?? ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Email :</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?php echo $data['email'] ?? ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Phone :</label>
                                <input type="text" name="phone" class="form-control"
                                    value="<?php echo $data['phone'] ?? ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Existing Images:</label>
                                <div class="row input-groups">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <input type="file" class=" " id="file" name="image[]" multiple>

                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row img-update">
                                        <?php
                                        $last_index = null;
                                        if (!empty($data['image'])) {
                                            foreach ($data['image'] as $key => $image) {
                                                $last_index = $key;
                                                ?>
                                                <div class="img-container img-box">
                                                    <img src="uploads/<?php echo $image ?>" alt="" class="">
                                                    <a href="javascript:void(0);" data-img="<?php echo $image ?>"
                                                        class="delete-icon del-btn">
                                                        <i class="ri-close-large-line"></i>
                                                    </a>
                                                    <input type="hidden" name="old_images[]" value="<?php echo $image ?>">
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)" class="btn btn-primary btn_submit">Submit</a>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        $('#file').on('change', function () {
            const files = this.files;

            if (files.length > 0) {
                $.each(files, function (index, file) {
                    const reader = new FileReader();
                    var html = '';
                    reader.onload = function (e) {
                        html += `
                        <div class="img-container img-box">
                        <img src="${e.target.result}" alt="" class="img-thum">
                        <a href="javascript:void(0);" data-index="${index}" data-img="${file.name}" class="delete-icon del-btn">
                             <i class="ri-close-large-line"></i>
                        </a>
                    </div>`;
                        $(".img-update").append(html);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });

        $(document).on("click", ".delete-icon", function () {
            var imageName = $(this).data('img');
            var skip_new_indexes = $(this).data('index');
            $('<input>').attr({
                type: 'hidden',
                name: 'skip_new_indexes[]',
                value: skip_new_indexes
            }).appendTo('form');

            $('<input>').attr({
                type: 'hidden',
                name: 'deleted_images[]',
                value: imageName
            }).appendTo('form');
            $(this).closest('.img-container').remove();
        });






        $('.btn_submit').click(function () {
            $('.myform').validate({
                rules: {
                    full_name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },

                },
                // errorPlacement: function (error, element) {

                // 	if (element.attr("name") == "name") {
                // 		error.insertAfter('.name-error').append(error);
                // 	} else if (element.attr("name") == "email") {
                // 		error.insertAfter('.email-error').append(error);
                // 	}
                // 	else {
                // 		error.insertAfter(element);
                // 	}
                // }
            });
        });

        $('.btn_submit').on('click', function () {
            var _this = $(this);
            if ($('#myform').valid()) {
                _this.prop('disabled', true).text('Proccessing...');
                // const form = $('#myform')[0];
                const fd = new FormData($('#myform')[0]);
                $.ajax({
                    url: 'common_ajax.php',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: fd,
                    success: function (data) {
                        _this.prop('disabled', false).html('Submit');
                        try {
                            data = JSON.parse(data);
                        } catch (e) { }
                        if (data.status == 1) {
                            toastr.success(data.msg, 'success');
                            setTimeout(() => {
                                location = 'index.php';
                            }, 2000);
                        } else {
                            toastr.error(data.msg, 'Error');
                        }
                    }
                })
            }
        });
    });
</script>