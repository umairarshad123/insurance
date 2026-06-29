@php $site = config('site'); @endphp
<form id="quoteForm" class="quote-form" action="{{ route('questionnaire.store') }}" method="POST">
    @csrf
    <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

    {{-- What kind of quote --}}
    @php
        $quoteChips = [
            ['label' => 'Home',                 'wide' => false],
            ['label' => 'Auto',                 'wide' => false],
            ['label' => 'Home & Auto Bundle',   'wide' => true],
            ['label' => 'Renters',              'wide' => true],
            ['label' => 'Renters & Auto Bundle','wide' => true],
            ['label' => 'Life',                 'wide' => false],
            ['label' => 'Business',             'wide' => false],
        ];
    @endphp
    <div class="field">
        <label>What do you need a quote for?</label>
        <div class="quote-chips">
            @foreach ($quoteChips as $c)
                <label class="qchip {{ $c['wide'] ? 'qchip--wide' : '' }}">
                    <input type="checkbox" name="insurance_types[]" value="{{ $c['label'] }}" {{ collect(old('insurance_types'))->contains($c['label']) ? 'checked' : '' }}>
                    <span>{{ $c['label'] }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="form-grid-2">
        <div class="field">
            <label>Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="First and last name">
            @error('full_name')<span class="err">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label>Date of Birth</label>
            <input type="text" name="dob" value="{{ old('dob') }}" placeholder="MM/DD/YYYY" inputmode="numeric" maxlength="10" autocomplete="bday">
        </div>
    </div>

    <div class="form-grid-2">
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com">
            @error('email')<span class="err">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label>Phone</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="(248) 000-0000">
            @error('phone')<span class="err">{{ $message }}</span>@enderror
        </div>
    </div>

    <p class="form-hint"><x-icon name="phone" style="width:.95em;height:.95em;display:inline" /> Just add a <strong>phone or email</strong> so Patrick can reach you — everything else is optional, so feel free to submit even if you can't fill it all out.</p>

    <div class="field">
        <label>Full Address</label>
        <input type="text" name="address" value="{{ old('address') }}" placeholder="Street, City, State, ZIP">
        @error('address')<span class="err">{{ $message }}</span>@enderror
    </div>

    <div class="form-grid-2">
        <div class="field">
            <label>Do you own your home or rent?</label>
            <select name="home_status">
                <option value="">Select…</option>
                <option @selected(old('home_status')==='Own')>Own</option>
                <option @selected(old('home_status')==='Rent')>Rent</option>
                <option @selected(old('home_status')==='Other')>Other</option>
            </select>
        </div>
        <div class="field">
            <label>Best time to contact you?</label>
            <select name="best_time">
                <option value="">Select…</option>
                <option @selected(old('best_time')==='Morning (9am – 12pm)')>Morning (9am – 12pm)</option>
                <option @selected(old('best_time')==='Afternoon (12pm – 3pm)')>Afternoon (12pm – 3pm)</option>
                <option @selected(old('best_time')==='Evening (3pm – 6pm)')>Evening (3pm – 6pm)</option>
                <option @selected(old('best_time')==='Anytime')>Anytime</option>
            </select>
        </div>
    </div>

    <div class="form-grid-2">
        <div class="field">
            <label>Do you currently have insurance?</label>
            <select name="currently_insured">
                <option value="">Select…</option>
                <option @selected(old('currently_insured')==='Yes')>Yes</option>
                <option @selected(old('currently_insured')==='No')>No</option>
            </select>
        </div>
        <div class="field">
            <label>Current insurance company (if any)</label>
            <input type="text" name="current_carrier" value="{{ old('current_carrier') }}" placeholder="e.g. State Farm, Progressive…">
        </div>
    </div>

    <div class="field">
        <label>OTHER DRIVERS — NAMES &amp; DATES OF BIRTH</label>
        <textarea name="drivers" placeholder="e.g. John Smith — 05/12/1985&#10;Jane Smith — 09/30/1987">{{ old('drivers') }}</textarea>
    </div>

    <div class="field">
        <label>VEHICLES — YEAR, MAKE &amp; MODEL</label>
        <textarea name="vehicles" placeholder="e.g. 2021 Toyota RAV4&#10;2018 Honda Civic">{{ old('vehicles') }}</textarea>
    </div>

    <button type="submit" class="btn btn--primary btn--block btn--lg"><x-icon name="check" /> Submit My Quote Request</button>
    <p style="text-align:center;font-size:.82rem;color:var(--slate-500);margin-top:.9rem">
        <x-icon name="lock" style="width:.9em;height:.9em;display:inline" /> Your information is private and never sold. Prefer to talk? Call
        <a href="tel:{{ $site['phone_raw'] }}" class="text-red" style="font-weight:600">{{ $site['phone'] }}</a>.
    </p>
</form>

@push('scripts')
<script>
(function () {
    var f = document.getElementById('quoteForm');
    if (!f) return;
    // Phone auto-format (US)
    var phone = f.querySelector('input[name="phone"]');
    if (phone) phone.addEventListener('input', function () {
        var d = this.value.replace(/\D/g, '').slice(0, 10);
        this.value = d.length > 6 ? '(' + d.slice(0,3) + ') ' + d.slice(3,6) + '-' + d.slice(6)
                   : d.length > 3 ? '(' + d.slice(0,3) + ') ' + d.slice(3)
                   : d.length > 0 ? '(' + d : '';
    });
    // Date of birth auto-slash MM/DD/YYYY
    var dob = f.querySelector('input[name="dob"]');
    if (dob) dob.addEventListener('input', function () {
        var d = this.value.replace(/\D/g, '').slice(0, 8);
        var out = d.slice(0,2);
        if (d.length > 2) out += '/' + d.slice(2,4);
        if (d.length > 4) out += '/' + d.slice(4,8);
        this.value = out;
    });
})();
</script>
@endpush
