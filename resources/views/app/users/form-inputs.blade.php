@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $user->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="role" label="Role">
            @php $selected = old('role', ($editing ? $user->role : '')) @endphp
            <option value="admin" {{ $selected == 'admin' ? 'selected' : '' }} >Admin</option>
            <option value="rukovodilac" {{ $selected == 'rukovodilac' ? 'selected' : '' }} >Rukovodilac</option>
            <option value="zaposleni" {{ $selected == 'zaposleni' ? 'selected' : '' }} >Zaposleni</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
