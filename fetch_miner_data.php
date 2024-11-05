<?php
$apiUrl = "https://luckpool.net/verus/miner/RLoSHs4tnfNiSeinynH1T3hepMs1RUrgk9";
$response = file_get_contents($apiUrl);

if ($response === FALSE) {
    echo "<p class='text-danger'>Error: ไม่สามารถดึงข้อมูลจาก API ได้</p>";
    exit;
}

$data = json_decode($response, true);
if ($data === NULL) {
    echo "<p class='text-danger'>Error: ไม่สามารถแปลง JSON ได้</p>";
    exit;
}

// ฟังก์ชันการจัดเรียงตามชื่อ Worker
usort($data['workers'], function($a, $b) {
    $nameA = explode(":", $a)[0];
    $nameB = explode(":", $b)[0];
    return strcmp($nameA, $nameB);
});
?>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Hashrate (ปัจจุบัน)</h5>
                <p class="card-text"><?php echo $data['hashrateString']; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Hashrate (เฉลี่ย 24 ชม.)</h5>
                <p class="card-text"><?php echo number_format($data['avgHashrateSols24HR'] / 1e6, 2) . " MH/s"; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Efficiency</h5>
                <p class="card-text"><?php echo $data['efficiency'] . "%"; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Current Share %</h5>
                <p class="card-text"><?php echo number_format($data['currentSharePercent'] * 100, 4) . "%"; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Balance</h5>
                <p class="card-text"><?php echo $data['balance'] . " VRSC"; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Paid</h5>
                <p class="card-text"><?php echo $data['paid'] . " VRSC"; ?></p>
            </div>
        </div>
    </div>
</div>

<h3 class="mt-4">รายละเอียด Workers</h3>
<table class="table table-bordered mt-3">
    <thead class="thead-dark">
        <tr>
            <th>ชื่อ Worker</th>
            <th>Hashrate (H/s)</th>
            <th>Temperature (°C)</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['workers'] as $worker) {
            $workerData = explode(":", $worker);
            $status = $workerData[3] === "on" ? "Online" : "Offline";
            $statusClass = $workerData[3] === "on" ? "status-online" : "status-offline";
            echo "<tr>
                <td>{$workerData[0]}</td>
                <td>" . number_format($workerData[1]) . " H/s</td>
                <td>{$workerData[6]}</td>
                <td class='{$statusClass}'>{$status}</td>
            </tr>";
        } ?>
    </tbody>
</table>