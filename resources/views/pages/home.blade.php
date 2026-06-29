@extends('layouts.app')
@php $site = config('site'); @endphp

@section('content')

{{-- HERO with the quote form built right in --}}
<section class="hero">
    <div class="container">
        <div class="hero__grid hero__grid--form">
            <div class="hero__copy">
                <div class="hero__badges">
                    <span class="chip"><x-icon name="pin" /> Insuring All of Michigan</span>
                    <span class="chip"><x-icon name="shield" /> Farmers Insurance Agent</span>
                    <span class="chip"><x-icon name="star" style="color:#ffd2d7" /> 4.9 ★ Rated</span>
                </div>
                <h1>Protecting Michigan <span class="accent">Families &amp; Businesses</span></h1>
                <ul class="hero__list">
                    <li><x-icon name="check" /> Home</li>
                    <li><x-icon name="check" /> Auto</li>
                    <li><x-icon name="check" /> Life</li>
                    <li><x-icon name="check" /> Business</li>
                </ul>
                <p class="hero__lead">Insuring <strong style="color:#fff">all of Michigan</strong> — better coverage, better savings, from {{ $site['agent'] }}.</p>

                <div class="hero__cta">
                    <div class="cta-wrap">
                        <span class="click-here">Start Here <x-icon name="arrow-right" /></span>
                        <a href="#quiz" class="btn btn--primary btn--huge btn--pulse">GET MY FREE QUOTE <x-icon name="arrow-right" /></a>
                    </div>
                    <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--white btn--lg" style="margin-top:1rem"><x-icon name="phone" /> {{ $site['phone'] }}</a>
                </div>

                <div class="hero__trust">
                    <div class="stat"><b>20+</b><span>Years Experience</span></div>
                    <div class="hero__divider"></div>
                    <div class="stat"><b>2,500+</b><span>Clients Protected</span></div>
                    <div class="hero__divider"></div>
                    <div class="stat"><b>A++</b><span>Carrier Strength</span></div>
                </div>
            </div>

            <div class="hero__media hero__media--form">
                <div class="form-card hero-form" id="quiz">
                    <span class="hero-form__badge">👉 START HERE — IT'S FREE</span>
                    <div class="hero-form__head">
                        <img src="{{ asset('images/agent-square.jpg') }}" alt="{{ $site['agent'] }}, {{ $site['company'] }} agent" class="hero-form__avatar" width="52" height="52">
                        <div>
                            <div class="hero-form__agent">{{ $site['agent'] }}</div>
                            <div class="hero-form__role">Farmers Insurance Agent · Michigan</div>
                        </div>
                    </div>
                    <h2 class="hero-form__title">PLEASE FILL OUT YOUR INFO</h2>
                    <p class="hero-form__sub">I'll personally prepare your free, no-obligation quote — it only takes about 2 minutes.</p>
                    @if ($errors->any())
                        <div style="margin-bottom:1.1rem">@include('partials.alerts')</div>
                    @endif
                    @include('partials.questionnaire-form')
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES (right after hero) --}}
<section class="section">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="shield" /> What I Cover</span>
            <h2>Insurance built around your life</h2>
            <p class="lead">From your first car to your family's future and your growing business — get the right protection at the right price.</p>
        </div>
        @include('partials.sections.services')
    </div>
</section>

{{-- ABOUT TEASER --}}
<section class="section">
    <div class="container">
        <div class="split">
            <div class="split__media reveal">
                <div class="media-frame">
                    <img src="{{ asset('images/agent-medium.jpg') }}" alt="{{ $site['agent'] }}, your local Michigan insurance agent" width="800" height="688">
                    <div class="exp-badge"><b>20+</b><span>Years Serving MI</span></div>
                </div>
            </div>
            <div class="split__copy reveal" data-delay="1">
                <span class="eyebrow"><x-icon name="user" /> Meet Your Agent</span>
                <h2>Hi, I'm {{ $site['agent'] }}</h2>
                <p class="lead" style="font-size:1.12rem">I'm a Farmers Insurance agent based in {{ $site['city'] }}, proudly insuring families and businesses across all of Michigan. My mission is simple: protect what matters most to you with honest advice, personalized coverage, and service you can actually count on.</p>
                <ul class="check-list">
                    <li><x-icon name="check" /> One Dedicated Agent - No Call Centers.</li>
                    <li><x-icon name="check" /> Coverage tailored to Michigan families &amp; businesses</li>
                    <li><x-icon name="check" /> A real advocate when it's time to file a claim</li>
                </ul>
                <div class="btn-row mt-4">
                    <a href="{{ route('about') }}" class="btn btn--navy">More About Patrick <x-icon name="arrow-right" /></a>
                    <a href="{{ route('consultation') }}" class="btn btn--ghost">Schedule a Chat</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- WHY US --}}
<section class="section bg-navy">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="sparkles" /> Why Work With Me</span>
            <h2>The local advantage you deserve</h2>
            <p>Big-company strength. Small-town service. Here's what sets working with me apart.</p>
        </div>
        <div class="cards-3">
            @foreach ($site['reasons'] as $i => $r)
                <article class="card reveal" data-delay="{{ $i % 3 }}" style="background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.1)">
                    <div class="card__ico {{ ['ig-red','ig-blue','ig-navy'][$i % 3] }}"><x-icon :name="$r['icon']" /></div>
                    <h3 style="color:#fff">{{ $r['title'] }}</h3>
                    <p style="color:#b9c6e6">{{ $r['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="section bg-slate">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="rocket" /> How It Works</span>
            <h2>Getting covered is easy</h2>
            <p class="lead">Three simple steps to the right coverage and lasting peace of mind.</p>
        </div>
        @include('partials.sections.steps')
    </div>
</section>

{{-- BEFORE vs AFTER --}}
<section class="section bg-navy" id="compare">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="sparkles" /> The Difference</span>
            <h2>Before Patrick <span style="color:#ff9aa6">vs.</span> After Patrick</h2>
            <p>See exactly what changes the moment you switch to a dedicated agent who has your back.</p>
        </div>

        <div class="vs-grid reveal">
            <div class="vs-card vs-card--before">
                <div class="vs-card__title">Before</div>
                <ul class="vs-list">
                    <li><span class="vs-emoji">😟</span> Paying too much</li>
                    <li><span class="vs-emoji">📞</span> Long call-center wait times</li>
                    <li><span class="vs-emoji">❓</span> Confusing coverage</li>
                    <li><span class="vs-emoji">😰</span> Stress during claims</li>
                    <li><span class="vs-emoji">📄</span> Multiple policies everywhere</li>
                    <li><span class="vs-emoji">⚠️</span> Unsure if you're covered</li>
                </ul>
            </div>

            <div class="vs-mid">
                <span class="vs-arrow"><x-icon name="arrow-right" /></span>
            </div>

            <div class="vs-card vs-card--after">
                <div class="vs-card__title">After <span class="tag">With Patrick</span></div>
                <ul class="vs-list">
                    <li><span class="vs-emoji">💰</span> Better rates &amp; discounts</li>
                    <li><span class="vs-emoji">👤</span> One dedicated local agent</li>
                    <li><span class="vs-emoji">✅</span> Personalized protection</li>
                    <li><span class="vs-emoji">🤝</span> A claims advocate by your side</li>
                    <li><span class="vs-emoji">📦</span> Simple bundled coverage</li>
                    <li><span class="vs-emoji">🛡️</span> Confidence &amp; peace of mind</li>
                </ul>
            </div>
        </div>

        <div class="btn-row center mt-4 reveal">
            <a href="#quiz" class="btn btn--primary btn--lg">See How Much You Could Save <x-icon name="arrow-right" /></a>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="section">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="quote" /> Client Reviews</span>
            <h2>Michigan families love working with Patrick</h2>
            <p class="lead">Real service. Real savings. Real relationships.</p>
        </div>
        @include('partials.sections.testimonials', ['limit' => 3])
        <div class="btn-row center mt-4">
            <a href="{{ route('testimonials') }}" class="btn btn--ghost">Read More Reviews <x-icon name="arrow-right" /></a>
        </div>
    </div>
</section>

@endsection
