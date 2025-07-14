@php $editing = isset($zanr) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Naziv"
            label="Naziv"
            :value="old('Naziv', ($editing ? $zanr->Naziv : ''))"
            maxlength="50"
            placeholder="Naziv"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
