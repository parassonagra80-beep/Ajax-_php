<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container mt-2">
        <div class="row ">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Register</h2>
                            </div>
                            <div class="col-md-6"><a href="index.php" class="btn btn-primary float-right">List</a></div>
                        </div>
                    </div>
                    <form action="javascript:void(0)" method="POST" id="myform">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">First Name :</label>
                                <input type="text" name="first_name" placeholder="First Name" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Last Name :</label>
                                <input type="text" name="last_name" placeholder="Last Name" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email :</label>
                                <input type="email" name="email" placeholder="Email" value="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Phone :</label>
                                <input type="number" name="phone" placeholder="Phone" value="" class="form-control">
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $(document).ready(function() {
        $("#myform").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                }

            },
            submitHandler: function(form) {
                return false;
            }
        });
        $(".btn_submit").on("click", function() {
            var _this = $(this);
            if ($('#myform').valid()) {
                _this.prop('disabled', true).text('Processing...');
                $.ajax({
                    url: 'add_ajax.php',
                    type: 'POST',
                    data: $("#myform").serialize(),
                    success: function(data) {
                        _this.prop('disabled', false).html('Submit');
                        try {
                            data = JSON.parse(data);
                        } catch (e) {}
                        if (data.status == 1) {
                            toastr.success(data.msg, 'success');
                            setTimeout(() => {
                                window.location.href = "index.php";
                            }, 2000);
                            // header('index.php');
                        } else {
                            toastr.error(data.msg, 'error');
                        }
                    }
                })
            }
        });
    });
</script>