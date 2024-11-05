<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการขุด VerusCoin แบบ Real-Time</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-online {
            color: green;
            font-weight: bold;
        }
        .status-offline {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">ข้อมูลการขุด VerusCoin แบบ Real-Time</h2>
    
    <!-- ข้อมูลการขุด -->
    <div id="miningData">
        <!-- ข้อมูลจะถูกโหลดและอัพเดตโดย AJAX -->
        <?php include 'fetch_miner_data.php'; ?>
    </div>
</div>

<!-- jQuery และ Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    // ฟังก์ชันดึงข้อมูลแบบ Real-Time
    function fetchMiningData() {
        $.get("fetch_miner_data.php", function(data) {
            $("#miningData").html(data);
        });
    }

    // ดึงข้อมูลใหม่ทุก ๆ 10 วินาที
    setInterval(fetchMiningData, 10000);
</script>
</body>
</html>
