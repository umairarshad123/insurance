<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(private LeadService $leads)
    {
    }

    public function show()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        // Partial submissions welcome — only require a phone OR an email.
        $data = $request->validate([
            'name'    => 'nullable|string|max:120',
            'email'   => 'nullable|required_without:phone|email|max:160',
            'phone'   => 'nullable|required_without:email|string|max:40',
            'subject' => 'nullable|string|max:160',
            'message' => 'nullable|string|max:2000',
            'website' => 'nullable|max:0', // honeypot
        ], [
            'email.required_without' => 'Please add a phone number or an email so Patrick can reach you.',
            'phone.required_without' => 'Please add a phone number or an email so Patrick can reach you.',
        ]);

        $lead = $this->leads->store([
            'type'    => 'contact',
            'name'    => ($data['name'] ?? '') ?: 'Website Lead',
            'email'   => $data['email'] ?? null,
            'phone'   => $data['phone'] ?? null,
            'message' => $data['message'] ?? null,
            'data'    => ['Subject' => $data['subject'] ?? null],
        ], $request);

        return redirect()->route('thank-you')->with('lead', $lead->only('name', 'type'));
    }
}
