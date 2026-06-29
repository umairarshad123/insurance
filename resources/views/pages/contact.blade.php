@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Contact')
@section('description', 'Contact Patrick Yasso, your local Farmers Insurance agent in Walled Lake, MI. Call (248) 504-8848 or send a message for a free quote.')

@section('content')

@include('partials.page-hero', ['heading' => 'Get In Touch', 'sub' => "Have a question or ready for a quote? I'd love to hear from you.", 'crumb' => 'Contact'])

<section class="section">
    <div class="container">
        <div class="split" style="align-items:start">
            {{-- Info --}}
            <div class="split__copy reveal">
                <span class="eyebrow"><x-icon name="phone" /> Let's Talk</span>
                <h2>Reach Patrick directly</h2>
                <p class="lead">No call centers, no runaround — just a local agent ready to help.</p>

                <div style="display:grid;gap:1rem;margin-top:1.6rem">
                    <a href="tel:{{ $site['phone_raw'] }}" class="card" style="display:flex;gap:1rem;align-items:center;padding:1.1rem 1.3rem">
                        <span class="card__ico ig-red" style="margin:0;width:50px;height:50px"><x-icon name="phone" /></span>
                        <span><span style="display:block;font-size:.8rem;color:var(--slate-500);font-weight:600">Call or Text</span><strong style="font-size:1.15rem;color:var(--navy)">{{ $site['phone'] }}</strong></span>
                    </a>
                    <a href="mailto:{{ $site['email'] }}" class="card" style="display:flex;gap:1rem;align-items:center;padding:1.1rem 1.3rem">
                        <span class="card__ico ig-blue" style="margin:0;width:50px;height:50px"><x-icon name="mail" /></span>
                        <span><span style="display:block;font-size:.8rem;color:var(--slate-500);font-weight:600">Email</span><strong style="font-size:1.05rem;color:var(--navy);word-break:break-all">{{ $site['email'] }}</strong></span>
                    </a>
                    <div class="card" style="display:flex;gap:1rem;align-items:center;padding:1.1rem 1.3rem">
                        <span class="card__ico ig-navy" style="margin:0;width:50px;height:50px"><x-icon name="location" /></span>
                        <span><span style="display:block;font-size:.8rem;color:var(--slate-500);font-weight:600">Visit the Office</span><strong style="color:var(--navy)">{{ $site['address'] }}, {{ $site['city'] }}, {{ $site['state'] }} {{ $site['zip'] }}</strong></span>
                    </div>
                </div>

                <div class="card" style="margin-top:1rem;padding:1.3rem">
                    <h3 style="font-size:1.1rem;display:flex;gap:.5rem;align-items:center"><x-icon name="clock" class="text-red" /> Office Hours</h3>
                    <div style="margin-top:.8rem;display:grid;gap:.5rem">
                        @foreach ($site['hours'] as $h)
                            <div style="display:flex;justify-content:space-between;color:var(--slate-600)"><span>{{ $h['d'] }}</span><strong style="color:var(--navy)">{{ $h['h'] }}</strong></div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="reveal" data-delay="1">
                <div class="form-card">
                    <h2 style="font-size:1.6rem">Send a message</h2>
                    <p style="margin:.4rem 0 1.4rem">I'll get back to you personally — usually the same day.</p>

                    @include('partials.alerts')

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
                        <div class="form-grid-2">
                            <div class="field">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Smith">
                                @error('name')<span class="err">{{ $message }}</span>@enderror
                            </div>
                            <div class="field">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="(248) 000-0000">
                            </div>
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@email.com">
                            @error('email')<span class="err">{{ $message }}</span>@enderror
                        </div>
                        <div class="field">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="What can I help with?">
                        </div>
                        <div class="field">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Tell me a little about what you're looking for…">{{ old('message') }}</textarea>
                            @error('message')<span class="err">{{ $message }}</span>@enderror
                            <p class="form-hint" style="margin-top:.7rem"><x-icon name="phone" style="width:.95em;height:.95em;display:inline" /> Just add a <strong>phone or email</strong> so Patrick can reach you — everything else is optional.</p>
                        </div>
                        <button type="submit" class="btn btn--primary btn--block btn--lg">Send Message <x-icon name="arrow-right" /></button>
                        <p style="text-align:center;font-size:.8rem;color:var(--slate-500);margin-top:.9rem"><x-icon name="lock" style="width:.9em;height:.9em;display:inline" /> Your information is kept private and never shared.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section--tight" style="padding-top:0">
    <div class="container">
        <div class="media-frame reveal" style="box-shadow:var(--sh)">
            <iframe
                title="Office location map"
                src="https://maps.google.com/maps?q={{ urlencode($site['map_query']) }}&output=embed"
                width="100%" height="380" style="border:0;display:block" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

@endsection
