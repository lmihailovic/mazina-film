@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('films.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.films.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.films.inputs.zanr_id')</h5>
                    <span>{{ optional($film->zanr)->Naziv ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.films.inputs.Naziv')</h5>
                    <span>{{ $film->Naziv ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.films.inputs.Status')</h5>
                    <span>{{ $film->Status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.films.inputs.Budzet')</h5>
                    <span>{{ $film->Budzet ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.films.inputs.DatumIzlaska')</h5>
                    <span>{{ $film->DatumIzlaska ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('films.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Film::class)
                <a href="{{ route('films.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
