@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Schedule a Consultation')
@section('description', 'Book a free, no-pressure insurance consultation with Patrick Yasso, your local Michigan Farmers Insurance agent.')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>Schedule a Consultation</span></nav>
        <div style="max-width:640px">
            <h1>Book a Free Consultation</h1>
            <p class="lead" style="color:#bccbea">Pick a time that works for you. We'll review your needs together — no pressure, no obligation.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container container-narrow">
        <div class="form-card reveal">
            @include('partials.alerts')
            <form action="{{ route('consultation.store') }}" method="POST">
                @csrf
                <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
                <div class="form-grid-2">
                    <div class="field">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}">
                        @error('name')<span class="err">{{ $message }}</span>@enderror
                    </div>
                    <div class="field">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="(248) 000-0000">
                        @error('phone')<span class="err">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                    @error('email')<span class="err">{{ $message }}</span>@enderror
                </div>
                <p class="form-hint"><x-icon name="phone" style="width:.95em;height:.95em;display:inline" /> Just add a <strong>phone or email</strong> so Patrick can reach you — everything else is optional.</p>
                <div class="form-grid-2">
                    <div class="field">
                        <label for="date">Preferred Date</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}">
                    </div>
                    <div class="field">
                        <label for="time">Preferred Time</label>
                        <select id="time" name="time">
                            <option value="">Select a time…</option>
                            <option>Morning (9am – 12pm)</option>
                            <option>Afternoon (12pm – 3pm)</option>
                            <option>Late Afternoon (3pm – 6pm)</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label for="topic">What would you like to discuss?</label>
                    <select id="topic" name="topic">
                        <option value="">Select a topic…</option>
                        @foreach ($site['services'] as $s)<option>{{ $s['title'] }}</option>@endforeach
                        <option>Bundling &amp; Savings</option>
                        <option>Policy Review</option>
                        <option>Something Else</option>
                    </select>
                </div>
                <div class="field">
                    <label for="message">Notes</label>
                    <textarea id="message" name="message" placeholder="Anything that would help me prepare…">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn btn--primary btn--block btn--lg"><x-icon name="calendar" /> Request My Consultation</button>
            </form>
        </div>
    </div>
</section>

@endsection
