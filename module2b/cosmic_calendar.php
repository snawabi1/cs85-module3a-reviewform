<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cosmic Calendar</title>
    <!-- All styling for the final output page is included below -->
    <style>
        body { font-family: sans-serif; background-color: #1a202c; color: #e2e8f0; }
        .container { max-width: 800px; margin: 2rem auto; padding: 2rem; background-color: #2d3748; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        h1 { text-align: center; color: #9f7aea; }
        .calendar-grid { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
        .day-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 5px; background-color: #4a5568; font-size: 1.2rem; }
        .cosmic-name { background-color: #9f7aea; color: #fff; transform: scale(1.1); box-shadow: 0 0 15px #9f7aea; }
        .cosmic-month { border: 2px solid #f6e05e; }
        .cosmic-both { background-color: #ed8936; color: #fff; border: 2px solid #f6e05e; transform: scale(1.1); box-shadow: 0 0 15px #ed8936; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cosmic Calendar</h1>
        <div class="calendar-grid">
<?php
    set_time_limit(60);

    $name = "Sophia";
    $nameLength = strlen($name);

    // from reading hw help questions testing this API
    $api = "https://timeapi.io/api/time/current/zone?timeZone=America%2FLos_Angeles";
    $response = file_get_contents($api);
    $data = json_decode($response);
    

    if ($data && isset($data->dateTime, $data->month)) {
        $dateTime = new DateTime($data->dateTime);
        $dayOfYear = (int)$dateTime->format('z') +1;
        $month = (int)$data->month;

        for ($i = $nameLength; $i <= $dayOfYear; $i++) {
            $cssClass = "day-box";
            if ($i % $nameLength === 0 && $i % $month === 0) {
                $cssClass .= " cosmic-both";
            } elseif ($i % $nameLength === 0) {
                $cssClass .= " cosmic-name";
            } elseif ($i % $month === 0) {
                $cssClass .= " cosmic-month";
            }
            echo "<div class='$cssClass'>$i</div>";
        }
    } else {
        echo "<p>Could not retrieve time data. Try again later.</p>";
    }
    /*
    My Debugging Log:
    Problem:The Api was returning some data just not all correctly and code was apearing on the browser
    Solution: I fixed the property name from $data->dayTime to $data->dateTime
    */
    ?>
      </div>
    </div>
</body>
</html>