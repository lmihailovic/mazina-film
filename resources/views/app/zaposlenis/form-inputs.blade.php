@php $editing = isset($zaposleni) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Ime"
            label="Ime"
            :value="old('Ime', ($editing ? $zaposleni->Ime : ''))"
            maxlength="20"
            placeholder="Ime"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Prezime"
            label="Prezime"
            :value="old('Prezime', ($editing ? $zaposleni->Prezime : ''))"
            maxlength="20"
            placeholder="Prezime"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Uloga"
            label="Uloga"
            :value="old('Uloga', ($editing ? $zaposleni->Uloga : ''))"
            maxlength="255"
            placeholder="Uloga"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="Status" label="Status">
            @php $selected = old('Status', ($editing ? $zaposleni->Status : '')) @endphp
            <option value="aktivan" {{ $selected == 'aktivan' ? 'selected' : '' }} >Aktivan</option>
            <option value="neaktivan" {{ $selected == 'neaktivan' ? 'selected' : '' }} >Neaktivan</option>
            <option value="odsutan" {{ $selected == 'odsutan' ? 'selected' : '' }} >Odsutan</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
