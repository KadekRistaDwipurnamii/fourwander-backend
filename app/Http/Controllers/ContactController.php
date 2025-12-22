<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Mail\ContactMessageMail;
use Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email',
            'message' => 'required|string',
            'via'     => 'required|in:email,whatsapp',
        ]);

        // SIMPAN KE DB
        ContactMessage::create($data);

        // KIRIM EMAIL
        Mail::to('fourwander16@gmail.com')
            ->send(new ContactMessageMail($data));

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully'
        ]);
    }
}
