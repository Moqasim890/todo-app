<section>
    <header class="mb-4">
        <h3 class="h4 fw-bold" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Profiel Informatie
        </h3>
        <p class="text-muted small mt-2">
            Wijzig je naam en e-mailadres.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold" style="color: #0e7490;">Naam</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold" style="color: #0e7490;">E-mail</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-muted">
                        Je e-mailadres is niet geverifieerd.
                        <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-underline">
                            Klik hier om de verificatie-email opnieuw te versturen.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="small text-success fw-semibold mt-2">
                            Een nieuwe verificatielink is naar je e-mailadres verzonden.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                Opslaan
            </button>

            @if (session('status') === 'profile-updated')
                <p class="small text-success mb-0">
                    Opgeslagen.
                </p>
            @endif
        </div>
    </form>
</section>
