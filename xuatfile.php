<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xuất File Excel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ced4da;
        }
        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #f00000;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
        }

        .datepicker-dropdown {
            background-color: #e4e2eb; 
            border: 1px solid #ff4d4d; 
        }

        .form-control:focus {
            border-color: #ff4d4d;
            box-shadow: 0 0 0 0.2rem rgba(255, 77, 77, 0.25);
        }
    </style>
</head>
<body>
    
        <div class="text-center mb-4">
            <img src="modules/xuatbh/image1.png" alt="upload bảo hành" class="img-fluid" style="max-width: 20%; height: auto;">
        </div>
        <form action="modules/xuatbh/testfile.php" method="POST">
        <h1>Xuất File Bảo Hành</h1>
            <div class="form-group">
                <label for="start_date">Ngày bắt đầu:</label>
                <input type="text" id="start_date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">Ngày kết thúc:</label>
                <input type="text" id="end_date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Xuất Excel</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#start_date, #end_date').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true // Nổi bật ngày hôm nay
            }).on('changeDate', function(e) {
                // Lấy giá trị và hiển thị
                $(this).val(e.format());
            });
        });
    </script>
</body>
</html>

