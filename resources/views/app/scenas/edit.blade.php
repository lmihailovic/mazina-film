
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('scenas.index') }}" class="mr-4">
                        <i class="icon ion-md-arrow-back"></i>
                    </a>
                    @lang('crud.scenas.edit_title')
                </h4>

                <!-- Scene Update Form -->
                <x-form
                    method="PUT"
                    action="{{ route('scenas.update', $scena) }}"
                    class="mt-4"
                >
                    @include('app.scenas.form-inputs')

                    <div class="mt-4">
                        <a href="{{ route('scenas.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>

                <!-- Employee Management Section -->
                <div class="mt-5">
                    <h5>Upravljanje zaposlenima</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3">
                            <thead>
                            <tr>
                                <th>Ime</th>
                                <th>Uloga</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($zaposleni as $employee)
                                <tr>
                                    <td>{{ $employee->Ime }} {{ $employee->Prezime }}</td>
                                    <td>{{ $employee->Uloga }}</td>
                                    <td>
                                        <form
                                            method="POST"
                                            action="{{ route('scenas.update', $scena) }}"
                                            style="display: inline;"
                                        >
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="zaposleni_id" value="{{ $employee->ZaposleniId }}">
                                            @if($scena->zaposlenis->contains($employee->ZaposleniId))
                                                <input type="hidden" name="action" value="release">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="icon ion-md-remove"></i> Ukloni
                                                </button>
                                            @else
                                                <input type="hidden" name="action" value="hire">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="icon ion-md-add"></i> Angažuj
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
