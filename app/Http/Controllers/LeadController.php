<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __construct(private LeadService $leads)
    {
    }

    public function consultationForm()
    {
        return view('pages.consultation');
    }

    public function storeConsultation(Request $request)
    {
        // Partial submissions welcome — only require a phone OR an email.
        $data = $request->validate([
            'name'      => 'nullable|string|max:120',
            'email'     => 'nullable|required_without:phone|email|max:160',
            'phone'     => 'nullable|required_without:email|string|max:40',
            'date'      => 'nullable|string|max:40',
            'time'      => 'nullable|string|max:40',
            'topic'     => 'nullable|string|max:120',
            'message'   => 'nullable|string|max:2000',
            'website'   => 'nullable|max:0',
        ], [
            'email.required_without' => 'Please add a phone number or an email so Patrick can reach you.',
            'phone.required_without' => 'Please add a phone number or an email so Patrick can reach you.',
        ]);

        $lead = $this->leads->store([
            'type'    => 'consultation',
            'name'    => ($data['name'] ?? '') ?: 'Website Lead',
            'email'   => $data['email'] ?? null,
            'phone'   => $data['phone'] ?? null,
            'message' => $data['message'] ?? null,
            'data'    => [
                'Preferred date'  => $data['date'] ?? null,
                'Preferred time'  => $data['time'] ?? null,
                'Topic'           => $data['topic'] ?? null,
            ],
        ], $request);

        return redirect()->route('thank-you')->with('lead', $lead->only('name', 'type'));
    }
}
