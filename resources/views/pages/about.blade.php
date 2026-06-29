@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'About Patrick Yasso')
@section('description', 'Meet Patrick Yasso, your local Farmers Insurance agent in Walled Lake, Michigan — personalized Auto, Home, Life and Business coverage with hometown service.')

@section('content')

@include('partials.page-hero', ['heading' => 'Meet ' . $site['agent'], 'sub' => 'A Farmers Insurance agent proudly insuring families and businesses across all of Michigan.', 'crumb' => 'About'])

<section class="section">
    <div class="container">
        <div class="split">
            <div class="split__media reveal">
                <div class="media-frame">
                    <img src="{{ asset('images/agent-large.jpg') }}" alt="{{ $site['agent'] }}, {{ $site['company'] }} agent" width="800" height="688">
                    <div class="exp-badge"><b>MI</b><span>Licensed Agent</span></div>
                </div>
            </div>
            <div class="split__copy reveal" data-delay="1">
                <span class="eyebrow"><x-icon name="user" /> About Patrick</span>
                <h2>Insurance done the personal way</h2>
                <p class="lead">As a {{ $site['company'] }} agent based in {{ $site['city'] }}, I believe insurance should be simple, honest, and built around real people — not policies sold from a script.</p>
                <p>When you work with me, you get one dedicated agent who takes the time to understand your life, your family, and your goals. I'll help you find coverage that genuinely fits — and I'll be right here when you actually need it most.</p>
                <ul class="check-list">
                    <li><x-icon name="check" /> Local Michigan expert who knows the community</li>
                    <li><x-icon name="check" /> Personalized coverage for Auto, Home, Life &amp; Business</li>
                    <li><x-icon name="check" /> Straightforward advice — no pressure, no jargon</li>
                    <li><x-icon name="check" /> A claims advocate who stays in your corner</li>
                </ul>
                <div class="btn-row mt-4">
                    <a href="{{ route('quote') }}" class="btn btn--primary">Get a Free Quote</a>
                    <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--ghost"><x-icon name="phone" /> {{ $site['phone'] }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-slate">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="shield" /> What I Cover</span>
            <h2>Insurance built around your life</h2>
            <p class="lead">From your first car to your family's future and your growing business — get the right protection at the right price.</p>
        </div>
        @include('partials.sections.services')
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="heart" /> What I Stand For</span>
            <h2>Values that guide every policy</h2>
        </div>
        <div class="cards-3">
            <article class="card reveal"><div class="card__ico ig-red"><x-icon name="shield" /></div><h3>Trust First</h3><p>Honest recommendations based on what's right for you — never on what sells. Your trust is everything.</p></article>
            <article class="card reveal" data-delay="1"><div class="card__ico ig-blue"><x-icon name="user" /></div><h3>Truly Personal</h3><p>You're a neighbor, not a number. I get to know you so your coverage actually fits your life.</p></article>
            <article class="card reveal" data-delay="2"><div class="card__ico ig-navy"><x-icon name="support" /></div><h3>Always Here</h3><p>From your first quote to your first claim, I'm a phone call away — responsive, local, and reliable.</p></article>
        </div>
    </div>
</section>

<section class="section bg-slate">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="pin" /> Coverage Areas</span>
            <h2>Proudly serving Michigan</h2>
            <p class="lead">Based in {{ $site['city'] }} and helping clients across the region and beyond.</p>
        </div>
        <div class="reveal" style="display:flex;flex-wrap:wrap;gap:.7rem;justify-content:center;max-width:780px;margin-inline:auto">
            @foreach ($site['coverage_areas'] as $area)
                <span class="badge-soft"><x-icon name="pin" style="width:1em;height:1em" /> {{ $area }}</span>
            @endforeach
        </div>
    </div>
</section>

@include('partials.sections.cta-band', ['heading' => "Let's protect what matters most to you", 'sub' => 'Reach out today for a free, friendly conversation about your insurance needs.'])

@endsection
