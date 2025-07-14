@php $editing = isset($scena) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="film_id" label="Film" required>
            @php $selected = old('film_id', ($editing ? $scena->film_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Film</option>
            @foreach($films as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Lokacija"
            label="Lokacija"
            :value="old('Lokacija', ($editing ? $scena->Lokacija : ''))"
            maxlength="255"
            placeholder="Lokacija"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="DatumSnimanja"
            label="Datum Snimanja"
            value="{{ old('DatumSnimanja', ($editing ? optional($scena->DatumSnimanja)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>
</div>

@if($editing)
    <div class="col-sm-12 mt-4">
        <h4 class="mb-3">Zaposleni na sceni</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Uloga</th>
                    <th>Status</th>
                    <th>Akcija</th>
                </tr>
                </thead>
                <tbody>
                @foreach($zaposleni as $zaposleniItem)
                    @php
                        $isAssigned = $scena->zaposlenis->contains(function($value) use ($zaposleniItem) {
                            return $value->ZaposleniId === $zaposleniItem->ZaposleniId;
                        });
                    @endphp
                    <tr>
                        <td>{{ $zaposleniItem->Ime }}</td>
                        <td>{{ $zaposleniItem->Prezime }}</td>
                        <td>{{ $zaposleniItem->Uloga }}</td>
                        <td>
                            <span class="badge badge-{{ $isAssigned ? 'success' : 'secondary' }}">
                                {{ $isAssigned ? 'Angažovan' : 'Nije angažovan' }}
                            </span>
                        </td>
                        <td>
                            <form
                                action="{{ route('scenas.update', $scena) }}"
                                method="POST"
                                style="display: inline;"
                                class="zaposleni-form"
                            >
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="{{ $isAssigned ? 'release' : 'hire' }}">
                                <input type="hidden" name="zaposleni_id" value="{{ $zaposleniItem->ZaposleniId }}">
                                <!-- Add hidden fields for current scene data -->
                                <input type="hidden" name="film_id" value="{{ $scena->film_id }}">
                                <input type="hidden" name="Lokacija" value="{{ $scena->Lokacija }}">
                                <input type="hidden" name="DatumSnimanja" value="{{ $scena->DatumSnimanja ? $scena->DatumSnimanja->format('Y-m-d') : '' }}">

                                <button
                                    type="submit"
                                    class="btn btn-sm {{ $isAssigned ? 'btn-danger' : 'btn-success' }}"
                                >
                                    {{ $isAssigned ? 'Otpusti' : 'Angažuj' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
