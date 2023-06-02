<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inbox::where("isSend", "=", false)->get();
    }

    public function create(Request $request)
    {

        $request->validate([
            "phone" => "required",
            "message" => "required",
        ]);
        $to = $request->phone;
        $message = $request->message;
        if ($to && $message) {
            $create = Inbox::create([
                "phone" => $to,
                "message" => $message
            ]);
            if ($create) {
                return response()->json([
                    "status" => true,
                    "code" => 201,
                    "message" => "Success Create Inbox"
                ], 201);
            }
            return response()->json([
                "status" => false,
                "code" => 501,
                "message" => "Failed Create Inbox"
            ], 501);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $update = Inbox::where("id", $id)->update([
            "isSend" => true
        ]);

        if ($update) {
            return response()->json([
                "status" => true,
                "code" => 201,
                "message" => "Success"
            ], 201);
        }

        return response()->json([
            "status" => false,
            "code" => 501,
            "message" => "Failed"
        ], 501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inbox $inbox)
    {
        //
    }
}
