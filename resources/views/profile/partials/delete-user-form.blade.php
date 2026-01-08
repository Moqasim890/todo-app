<section>
    <header class="mb-4">
        <h3 class="h4 fw-bold text-danger">
            Account Verwijderen
        </h3>
        <p class="text-muted small mt-2">
            Zodra je account is verwijderd, worden al je gegevens permanent verwijderd. Zorg ervoor dat je belangrijke informatie hebt opgeslagen voordat je je account verwijdert.
        </p>
    </header>

    <button
        type="button"
        class="btn btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#confirmUserDeletion"
    >Account Verwijderen</button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">Weet je zeker dat je je account wilt verwijderen?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small">
                            Al je taken en gegevens worden permanent verwijderd. Voer je wachtwoord in om te bevestigen.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold" style="color: #0e7490;">Wachtwoord</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="Wachtwoord"
                            />
                            @error('password', 'userDeletion')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Annuleren
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Account Verwijderen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
