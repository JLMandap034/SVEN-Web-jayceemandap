<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $data = $request->all();
        $data['days'] = json_encode($data['days']);
        $data['times'] = json_encode($data['times']);

        try {
            DB::beginTransaction();

            $appointment = Appointment::create($data);
            $appointment->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Your appointment has been booked.'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.'
            ]);
        }
    }
}
