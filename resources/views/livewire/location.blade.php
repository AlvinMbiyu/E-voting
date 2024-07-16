<div class="row align-items-start">
    <div class="col">
        <select id="County" class="form-select-lg mb-3 form-control" wire:model="selectedCounty" name="County">
            <option value="">County</option>
            @foreach ($counties as $county)
                <option value="{{ $county->id }}">{{ $county->name }}</option>
            @endforeach
        </select>
    </div>
