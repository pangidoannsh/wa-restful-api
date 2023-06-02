<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Inbox;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $phone = $request->query('phone');
        if ($phone) {
            $uuid = Uuid::uuid4()->toString();
            $createAccess = Access::create([
                "id" => $uuid,
                "phone" => $phone
            ]);
            if ($createAccess) {
                Inbox::create([
                    'phone' => $phone,
                    "message" => "Berikut Access Token Anda : " . $uuid
                ]);
                return "Register Berhasil Silahkan Cek Ke Whatsapp Anda!";
            }
        }
        return response()->json([
            "status" => 'false',
            "code" => 400,
            "message" => "Please Input Your Phone to Register"
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
