
<div class="modal fade" id="edit-Lang-modal-{{ $language->id }}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="language-modal-title">Update Language</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="col-12">
                    <form method="post" action="{{ route('admin.language.update') }}" enctype="multipart/form-data"  >
                        @csrf
                        <div class="mb-3">
                            <input hidden type="text" name="id" value="{{ $language->id }}">
                            <label for="country-name" class="col-form-label">Country Name <span class="text-danger">*</span>  </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Ex:Bangladesh" name='name' id="country-name" value="{{ $language->name }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select aria-readonly="true" name="code" class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups">
                                @foreach($countryCodes as $code)
                                  @if(strtoupper($language->code) == $code['code'])
                                    <option selected>
                                       {{  $code['emoji'] }}{{ strtoupper($language->code) }}
                                    </option>
                                    @break
                                  @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <input class="btn btn--primary text--light" type="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

