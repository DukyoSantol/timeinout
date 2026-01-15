<?php

// Get accurate Manila time from NTP server
function getAccurateManilaTime() {
    // Try multiple time sources
    $sources = [
        'https://timeapi.io/api/Time/current?timeZone=Asia/Manila',
        'https://worldtimeapi.org/api/timezone/Asia/Manila'
    ];
    
    foreach ($sources as $source) {
        try {
            $response = file_get_contents($source);
            if ($response) {
                $data = json_decode($response, true);
                if (isset($data['dateTime'])) {
                    return new DateTime($data['dateTime']);
                }
                if (isset($data['datetime'])) {
                    return new DateTime($data['datetime']);
                }
            }
        } catch (Exception $e) {
            continue;
        }
    }
    
    // Fallback to Laravel time (might be wrong if server time is wrong)
    return now()->setTimezone('Asia/Manila');
}

echo "=== Time Fix Test ===\n";
$correctTime = getAccurateManilaTime();
echo "Correct Manila Time: " . $correctTime->format('l, F j, Y h:i:s A') . "\n";
echo "Laravel Time: " . now()->setTimezone('Asia/Manila')->format('l, F j, Y h:i:s A') . "\n";
