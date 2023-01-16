<div class="wrapper">
    <div class="wrapper">
        <div class="rte">
            <h1>Edit this Company</h1>
        </div>

        <form method="POST" action="{{ route('company.edit', $company->id) }}" enctype="multipart/form-data">
            @csrf

{{-- to nam pozwoli wysłać edytowalny wspi za pomoca put pomimo, ze w formularzu jest POST.. dlaczego to jeszcze nie wiem do konca; --}}
            {{-- {{method_field('PUT')}}  --}}
             <input type="hidden" name="_method" value="PUT">

            <div class="form-fieldset">
                <input class="form-field" type="text" name="name" placeholder="name" value="{{ $company->name }}">
            </div>
            <div class="form-fieldset">
                <input class="form-field" type="text" name="phone" placeholder="phone" value="{{ $company->phone }}">
            </div>
            <div class="form-fieldset">
                <input class="form-field" type="text" name="country" placeholder="phone" value="{{ $company->country }}">
            </div>
            <div class="form-fieldset">
                <input class="form-field" type="text" name="nip" placeholder="phone" value="{{ $company->nip }}">
            </div>
            <div class="form-fieldset">
                <input class="form-field" type="text" name="email" placeholder="email" value="{{ $company->email }}">
            </div>
            <div class="form-fieldset">
                <input class="form-field" type="text" name="www" placeholder="www" value="{{ $company->www }}">
            </div>
            <div class="form-fieldset">
                <input class="form-field" type="text" name="notes" placeholder="notes" value="{{ $company->notes }}">
            </div>


            <button type="submit" class="button">Save post</button>
        </form>


    </div>
</div>