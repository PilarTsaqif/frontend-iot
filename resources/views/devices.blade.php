<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devices</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan CSS custom jika diperlukan */
        .device-name {
            font-weight: bold;
            font-size: 1.2em;
        }
        .log-item {
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Devices</h1>
        <ul class="list-group" id="devices-list">
            @foreach ($devices as $device)
                <li class="list-group-item">
                    <div class="device-name">{{ $device->name }}</div>
                    <ul class="list-group mt-2">
                        @foreach ($device->logs as $log)
                            <li class="list-group-item log-item">
                                {{ $log->log_data }} <span class="text-muted">({{ $log->log_time }})</span>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Tambahkan Bootstrap JS dan dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        fetch('/api/devices')
            .then(response => response.json())
            .then(data => {
                const devicesHtml = data.map(device => {
                    return `
                        <li class="list-group-item">
                            <div class="device-name">${device.name}</div>
                            <ul class="list-group mt-2">
                                ${device.logs.map(log => {
                                    return `
                                        <li class="list-group-item log-item">
                                            ${log.log_data} <span class="text-muted">(${log.log_time})</span>
                                        </li>
                                    `;
                                }).join('')}
                            </ul>
                        </li>
                    `;
                }).join('');

                document.getElementById('devices-list').innerHTML = devicesHtml;
            });
    </script>
</body>
</html>
