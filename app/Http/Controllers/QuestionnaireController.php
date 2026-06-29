<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function __construct(private LeadService $leads)
    {
    }

    public function show()
    {
        return view('pages.questionnaire');
    }

    public function store(Request $request)
    {
        // Accept partial submissions — the only requirement is a way to reach
        // them (a phone OR an email). Everything else is optional.
        $validated = $request->validate([
            'full_name'         => 'nullable|string|max:160',
            'email'             => 'nullable|required_without:phone|email|max:160',
            'phone'             => 'nullable|required_without:email|string|max:40',
            'address'           => 'nullable|string|max:255',
            'dob'               => 'nullable|string|max:40',
            'home_status'       => 'nullable|string|max:40',
            'insurance_types'   => 'nullable|array',
            'insurance_types.*' => 'string|max:60',
            'drivers'           => 'nullable|string|max:2000',
            'vehicles'          => 'nullable|string|max:2000',
            'currently_insured' => 'nullable|string|max:40',
            'current_carrier'   => 'nullable|string|max:120',
            'best_time'         => 'nullable|string|max:60',
            'website'           => 'nullable|max:0', // honeypot
        ], [
            'email.required_without' => 'Please add a phone number or an email so Patrick can reach you.',
            'phone.required_without' => 'Please add a phone number or an email so Patrick can reach you.',
        ]);

        // Human-readable payload for the agent (skip empties)
        $labels = [
            'dob'               => 'Date of Birth',
            'address'           => 'Full Address',
            'home_status'       => 'Own or Rent',
            'drivers'           => 'Drivers (name & DOB)',
            'vehicles'          => 'Vehicles (year/make/model)',
            'currently_insured' => 'Currently Insured',
            'current_carrier'   => 'Current Carrier',
            'best_time'         => 'Best Time to Contact',
        ];

        $payload = [];
        if (!empty($validated['insurance_types'])) {
            $payload['Quote Type'] = implode(', ', $validated['insurance_types']);
        }
        foreach ($labels as $field => $label) {
            $val = $validated[$field] ?? null;
            if (!empty($val)) {
                $payload[$label] = $val;
            }
        }

        $lead = $this->leads->store([
            'type'      => 'questionnaire',
            'name'      => ($validated['full_name'] ?? '') ?: 'Website Lead',
            'email'     => $validated['email'] ?? null,
            'phone'     => $validated['phone'] ?? null,
            'interests' => $validated['insurance_types'] ?? [],
            'data'      => $payload,
        ], $request);

        return redirect()->route('thank-you')->with('lead', $lead->only('name', 'type'));
    }
}
