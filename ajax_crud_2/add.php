<?php
require_once "conn.php";
$id = $_GET['id'] ?? '';
$data = [];
if ($id) {
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
}
// print_r($data);
// exit;
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
    <title>Document</title>
    <style>
        .error {
            color: red;
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
                    <form action="javascript:void(0)" method="POST" id="myform">
                        <input type="hidden" value="add_edit" name="type">
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?? ''; ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Full Name :</label>
                                <input type="text" name="full_name" class="form-control"
                                    value="<?php echo $data['full_name'] ?? ''; ?>">
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
                                <label>Gender :</label>

                            </div>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
    type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {

        $('#myform').validate({
            rules: {
                full_name: {
                    required: true
                },
                email: {
                    required: true
                },
                phone: {
                    required: true

                },
                gender: {
                    required: true

                },

            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "gender") {
                    error.insertAfter(".gender-group"); 
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                return false; // Prevent default submission
            }
        });
        $('.btn_submit').on('click', function () {
            var _this = $(this);
            if ($('#myform').valid()) {
                _this.prop('disabled', true).text('processing..');
                $.ajax({
                    url: 'add_edit_ajax.php',
                    type: 'POST',
                    data: $('#myform').serialize(),
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