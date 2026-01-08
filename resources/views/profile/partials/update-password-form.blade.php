<section>
    <header class="mb-4">
        <h3 class="h4 fw-bold" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Wachtwoord Wijzigen
        </h3>
        <p class="text-muted small mt-2">
            Zorg ervoor dat je account een sterk wachtwoord gebruikt om veilig te blijven.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold" style="color: #0e7490;">Huidig Wachtwoord</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-semibold" style="color: #0e7490;">Nieuw Wachtwoord</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
            @error('password', 'updatePassword')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label fw-semibold" style="color: #0e7490;">Bevestig Wachtwoord</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                Opslaan
            </button>

            @if (session('status') === 'password-updated')
                <p class="small text-success mb-0">
                    Opgeslagen.
                </p>
            @endif
        </div>
    </form>
</section>
