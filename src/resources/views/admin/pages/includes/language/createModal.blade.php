<div class="modal fade" id="language-create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="language-modal-title">Create A New Language</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="col-12">
                    <form method="post" action="{{ route('admin.language.store') }}" enctype="multipart/form-data"  >
                        @csrf
                        <div class="mb-3">
                            <label for="country-name" class="col-form-label">Country Name <span class="text-danger">*</span>  </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Ex:Bangladesh" name='name' id="country-name" value="{{ old('name') }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="country-name" class="col-form-label">Country Code <span class="text-danger">*</span>  </label>
                            <select name="code" class="form-control  @error('code') is-invalid @enderror" data-trigger name="choices-single-groups" id="choices-single-groups">
                                <option value="">Choose a Country</option>
                                @foreach($countryCodes as $code)
                                    <option @if( old('code') == $code['code'])
                                             selected
                                            @endif
                                    value="{{ $code['code'] }}" alt="">{{  $code['emoji'] }} {{ $code['name'] }} </option>
                                @endforeach
                            </select>
                            @error('code')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input class="btn btn--primary text--light" type="submit" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
