<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $record = new Contact;
        $record['email'] = $data['email'];
        $record['type'] = 'subscribe';
        $record['campaign'] = $data['campaign'];
        $record->save();

        return [
            'status' => 'done'
        ];
    }
}