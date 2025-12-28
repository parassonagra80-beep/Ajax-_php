<?php
require_once "conn.php";

$id = $_GET["id"] ?? '';
$data = [];
if ($id) {
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    $data['language'] = explode(',', $data['language']);
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
    <style>
        .error {
            color: red;
        }
    </style>
    <title>AJAX File Upload</title>
</head>

<body>
    <div class="container mt-3">
        <div class="card mx-auto" style="max-width:800px;">
            <div class="card-header d-flex justify-content-between">
                <h2>Register</h2>
                <a href="index.php" class="btn btn-success">List</a>
            </div>
            <form action="javascript:void(0);" id="myform" enctype="multipart/form-data">
                <input type="hidden" name="type" value="add_edit">
                <input type="hidden" name="id" value="<?php echo $data['id'] ?? ''; ?>">
                <input type="hidden" name="old_image" value=" <?php echo $data['image'] ?? ''; ?>">
                <div class="card-body">

                    <div class="img-group my-2 mx-5 d-flex justify-content-center">
                        <img alt="" id="preview" src="uploads/<?php echo $view_image ; ?>" class=""
                            style="height:200px; width:200px; border:2px solid black; border-radius: 50%; ">
                        <input type="file" name="image" class="d-none" id="upload">
                    </div>
                    <div class="form-group">
                        <label>Full Name :</label>
                        <input name="full_name" class="form-control" value="<?php echo $data['full_name'] ?? ''; ?>">
                    </div>
                    <div class="form-group"><label>Email :</label><input name="email" type="email" class="form-control"
                            value="<?php echo $data['email'] ?? ''; ?>">
                    </div>
                    <div class="form-group"><label>Password :</label><input name="password" type="password"
                            class="form-control" value="<?php echo $data['password'] ?? ''; ?>"></div>

                    <div class="form-group">
                        <label>Gender :</label>
                        <div class="gender-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="male_btn" name="gender"
                                    value="male" <?php if (($data['gender'] ?? '') == 'MALE')
                                        echo 'checked'; ?>>
                                <label class="custom-control-label" for="male_btn">Male</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="female_btn" name="gender"
                                    value="female" <?php if (($data['gender'] ?? '') == 'FEMALE')
                                        echo 'checked'; ?>>
                                <label class="custom-control-label" for="female_btn">Female</label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label>language :</label>
                        <div class="language-group">
                            <div class="custom-control custom-checkbox d-inline ">
                                <input type="checkbox" class="custom-control-input" id="english" value="english"
                                    name="language[]" <?php echo (isset($data['language']) && in_array('english', $data['language']) ? 'checked' : '') ?>>
                                <label class="custom-control-label" for="english">English</label>
                            </div>
                            <div class="custom-control custom-checkbox d-inline ml-3">
                                <input type="checkbox" class="custom-control-input" id="gujrati" value="gujrati"
                                    name="language[]" <?php echo (isset($data['language']) && in_array('gujrati', $data['language']) ? 'checked' : '') ?>>
                                <label class="custom-control-label" for="gujrati">Gujrati</label>
                            </div>
                            <div class="custom-control custom-checkbox d-inline ml-3">
                                <input type="checkbox" class="custom-control-input" id="hindi" value="hindi"
                                    name="language[]" <?php echo (isset($data['language']) && in_array('hindi', $data['language']) ? 'checked' : '') ?>>
                                <label class="custom-control-label" for="hindi">Hindi</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn_submit">Submit</button>
                    <button type="reset" class="btn btn-danger ml-2">Reset</button>
                </div>
            </form>
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
    $(function () {
        $('#preview').on('click', () => $('#upload').trigger('click'));
        $('#upload').on('change', e => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = evt => $('#preview').attr('src', evt.target.result);
                reader.readAsDataURL(file);
            }
        });

        $('#myform').validate({
            rules: {
                full_name: 'required',
                email: { required: true, email: true },
                password: 'required',
                gender: 'required',
                'language[]': 'required'
            },

            errorPlacement: function (error, element) {
                if (element.attr("name") == "gender") {
                    error.insertAfter(".gender-group");
                } else if (element.attr("name") == "language[]") {
                    error.insertAfter(".language-group");
                } else {
                    error.insertAfter(element);
                }
            }
        });

       
        $('.btn_submit').on('click', function () {
            var _this = $(this);
            if ($('#myform').valid()) {
                _this.prop('disabled', true).text('processing..');
                const form = $('#myform')[0];
                const fd = new FormData(form);
                $.ajax({
                    url: 'common_ajax.php',
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        _this.prop('disabled', false).html('Submit');
                        try {
                            data = JSON.parse(data);
                        } catch (e) { }
                        if (data.status == 1) {
                            // alert('done');
                            toastr.success(data.msg, 'success');
                            setTimeout(() => {
                                location = 'index.php';
                            }, 2000);
                        }
                        else {
                            toastr.error(data.msg, 'error');
                        }
                    }
                })
            }
        });

    });
</script>