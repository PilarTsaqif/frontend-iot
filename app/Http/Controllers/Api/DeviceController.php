<?php

// app/Http/Controllers/Api/DeviceController.php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Log;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return response()->json($devices);
    }

    public function store(Request $request)
    {
        $device = new Device();
        $device->name = $request->input('name');
        $device->save();

        return response()->json($device);
    }

    public function show($id)
    {
        $device = Device::find($id);
        $logs = $device->logs;
        return response()->json(['device' => $device, 'logs' => $logs]);
    }

    public function logStore(Request $request, $id)
    {
        $device = Device::find($id);
        $log = new Log();
        $log->device_id = $device->id;
        $log->log_data = $request->input('log_data');
        $log->log_time = now();
        $log->save();

        return response()->json($log);
    }
}
