@php $editing = isset($film) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="zanr_id" label="Zanr" required>
            @php $selected = old('zanr_id', ($editing ? $film->zanr_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Zanr</option>
            @foreach($zanrs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Naziv"
            label="Naziv"
            :value="old('Naziv', ($editing ? $film->Naziv : ''))"
            maxlength="100"
            placeholder="Naziv"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="Status" label="Status">
            @php $selected = old('Status', ($editing ? $film->Status : '')) @endphp
            <option value="predprodukcija" {{ $selected == 'predprodukcija' ? 'selected' : '' }} >Predprodukcija</option>
            <option value="produkcija" {{ $selected == 'produkcija' ? 'selected' : '' }} >Produkcija</option>
            <option value="postprodukcija" {{ $selected == 'postprodukcija' ? 'selected' : '' }} >Postprodukcija</option>
            <option value="pauza" {{ $selected == 'pauza' ? 'selected' : '' }} >Pauza</option>
            <option value="planiranje" {{ $selected == 'planiranje' ? 'selected' : '' }} >Planiranje</option>
            <option value="distribucija" {{ $selected == 'distribucija' ? 'selected' : '' }} >Distribucija</option>
            <option value="arhiviran" {{ $selected == 'arhiviran' ? 'selected' : '' }} >Arhiviran</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Budzet"
            label="Budžet"
            :value="old('Budzet', ($editing ? $film->Budzet : ''))"
            step="0.01"
            placeholder="Unesite budžet"
            required
        />
    </x-inputs.group>


    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="DatumIzlaska"
            label="Datum Izlaska"
            value="{{ old('DatumIzlaska', ($editing ? optional($film->DatumIzlaska)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>
</div>
