@extends('layouts.bootstrap')

@section('title', 'Profiel Instellingen')

@section('content')
    <div class="py-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-4">
                <h1 class="h2 fw-bold" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Profiel Instellingen
                </h1>
                <p class="text-muted mt-2">Beheer je account informatie en voorkeuren</p>
            </div>

            <div class="row g-4">
                <!-- Profile Information -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-4">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Update Password -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-4">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="col-12">
                    <div class="card border-danger">
                        <div class="card-body p-4">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
