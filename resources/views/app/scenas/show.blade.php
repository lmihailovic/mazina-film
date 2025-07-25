@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('scenas.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                        ></a>
                    @lang('crud.scenas.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>@lang('crud.scenas.inputs.film_id')</h5>
                        <span>{{ optional($scena->film)->Naziv ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.scenas.inputs.Lokacija')</h5>
                        <span>{{ $scena->Lokacija ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.scenas.inputs.DatumSnimanja')</h5>
                        <span>{{ $scena->DatumSnimanja ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <h5>Zaposleni na sceni</h5>
                    @if($scena->zaposlenis->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Ime</th>
                                    <th>Prezime</th>
                                    <th>Uloga</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($scena->zaposlenis as $zaposleni)
                                    <tr>
                                        <td>{{ $zaposleni->Ime }}</td>
                                        <td>{{ $zaposleni->Prezime }}</td>
                                        <td>{{ $zaposleni->Uloga }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Nema angažovanih zaposlenih na ovoj sceni.</p>
                    @endif
                </div>

                <div class="mt-4">
                    <a href="{{ route('scenas.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Scena::class)
                        <a href="{{ route('scenas.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
