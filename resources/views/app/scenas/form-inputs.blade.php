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
