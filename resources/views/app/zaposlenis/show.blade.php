@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('zaposlenis.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.zaposlenis.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.zaposlenis.inputs.Ime')</h5>
                    <span>{{ $zaposleni->Ime ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.zaposlenis.inputs.Prezime')</h5>
                    <span>{{ $zaposleni->Prezime ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.zaposlenis.inputs.Uloga')</h5>
                    <span>{{ $zaposleni->Uloga ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.zaposlenis.inputs.Status')</h5>
                    <span>{{ $zaposleni->Status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('zaposlenis.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Zaposleni::class)
                <a
                    href="{{ route('zaposlenis.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
