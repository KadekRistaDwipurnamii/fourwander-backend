<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
            'via'     => 'required|in:email,whatsapp'
        ]);

        Contact::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Message saved successfully'
        ]);
    }
}
