<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\cms\ContactUsRequest;
use App\Models\cms\contact;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;
use Mail;

class ContactUsController extends Controller
{
    public function store(ContactUsRequest $request): RedirectResponse
    {
        contact::create($request->except('subject') + ['message' => $request->subject]);
        \Mail::send('mail', array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
        ), function ($message) use ($request) {
            $message->from($request->email);
            $message->to(config('constant.email'), 'Admin')->subject($request->subject);
        });
        Alert::success('We have received your message and would like to thank you for writing to us.');
        return redirect()->back();
    }
}
