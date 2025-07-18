
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
                        <h5>Employee Details</h5>
                        <div class="mb-1"><strong>Ime:</strong> {{ $zaposleni->Ime }} {{ $zaposleni->Prezime }}</div>
                        <div class="mb-1"><strong>Uloga:</strong> {{ $zaposleni->Uloga }}</div>
                        <div class="mb-1"><strong>Status:</strong> {{ $zaposleni->Status }}</div>
                    </div>

                    <div class="mt-4">
                        <h5>Angažman na scenama</h5>
                        @if($scenes->count() > 0)
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Film</th>
                                    <th>Lokacija</th>
                                    <th>Datum snimanja</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($scenes as $scene)
                                    <tr>
                                        <td>{{ $scene->film->Naziv ?? 'N/A' }}</td>
                                        <td>{{ $scene->Lokacija }}</td>
                                        <td>{{ $scene->DatumSnimanja ? \Carbon\Carbon::parse($scene->DatumSnimanja)->format('d.m.Y') : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Zaposleni nema angažman ni na jednoj sceni.</p>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('zaposlenis.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
