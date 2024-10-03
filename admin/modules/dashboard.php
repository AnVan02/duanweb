<style>
    .option-date .form-control {
        width: 200px; /* Set a fixed width for the date inputs */
        margin-right: 10px; /* Add space between the inputs */
    }

    #btn-filter {
        width: 100px; /* Set a fixed width for the button */
        height: 34px; /* Adjust the height to match the inputs */
        padding: 6px 12px; /* Adjust padding for a better fit */
    }
</style>
<div class="row">
    <div class="col">
        <div class="header__list d-flex space-between align-center">
            <h4 class="card-title" style="margin: 0;">Thống kê đơn hàng</h4>
            <div class="action_group">
                <a href="" id="btnExport" class="button button-dark">Export</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="main-pane-top d-flex space-between align-center" style="padding-inline: 10px;">
                    <div class="option-date d-flex space-between">
                        <input type="date" id="start-date" class="form-control">
                        <input type="date" id="end-date" class="form-control">
                        <button id="btn-filter" class="button button-dark">Lọc</button>
                    </div>
                    <h4 class="card-title" style="margin: 0;">Thống kê đơn hàng từ <span id="start-date-text"></span> đến <span id="end-date-text"></span></h4>
                </div>
                <div class="metrics d-flex space-between">
                    <div class="metric__item">Doanh thu: <span class="metric__sales"></span> </div>
                    <div class="metric__item">Số đơn hàng: <span class="metric__order"></span> </div>
                    <div class="metric__item">Số lượng bán: <span class="metric__quantity"></span> </div>
                </div>
                <div id="linechart" style="height: 350px;" class="w-100"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var char = new Morris.Line({
            element: 'linechart',
            xkey: 'date',
            ykeys: ['date', 'order', 'sales', 'quantity'],
            labels: ['Ngày', 'Đơn hàng', 'Doanh thu', 'Số lượng']
        });

        function loadData(start_date = '', end_date = '') {
            $.ajax({
                url: "modules/thongke.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                success: function(data) {
                    char.setData(data);

                    // Update text with selected date range
                    $('#start-date-text').text(start_date);
                    $('#end-date-text').text(end_date);

                    // Calculate and display totals
                    var totalOrder = 0;
                    var totalSales = 0;
                    var totalQuantity = 0;
                    for (var i = 0; i < data.length; i++) {
                        totalOrder += parseInt(data[i].order);
                        totalSales += parseInt(data[i].sales);
                        totalQuantity += parseInt(data[i].quantity);
                    }

                    var formattedAmount = parseInt(totalSales).toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });

                    $('.metric__order').text(totalOrder);
                    $('.metric__quantity').text(totalQuantity);
                    $('.metric__sales').text(formattedAmount);
                }
            });
        }

        $('#btn-filter').click(function() {
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            if (start_date && end_date) {
                loadData(start_date, end_date);
            } else {
                alert("Vui lòng chọn cả ngày bắt đầu và ngày kết thúc!");
            }
        });

        // Initial load with default range (last 365 days)
        loadData();
    });
</script>

<script>
    var startDate = document.getElementById("start-date");
    var endDate = document.getElementById("end-date");
    var btnExport = document.getElementById("btnExport");

    btnExport.addEventListener("click", function() {
        var start = startDate.value;
        var end = endDate.value;
        btnExport.href = "modules/export.php?start_date=" + start + "&end_date=" + end;
    });
</script>
