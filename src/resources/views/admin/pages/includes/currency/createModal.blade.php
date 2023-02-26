<div class="modal fade" id="create-currency" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="currency-modal-title">{{ decode('Create A New Currency') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="col-12">
                    <form method="post" action="{{ route('admin.currency.store') }}" enctype="multipart/form-data"  >
                        @csrf
                        <div class="mb-3">
                            <label for="currency-name" class="col-form-label">{{ decode('Name') }} <span class="text-danger">*</span>  </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"  name='name' id="currency-name" value="{{ old('name') }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="currency-symbol" class="col-form-label">{{ decode('Symbol') }} <span class="text-danger">*</span>  </label>
                            <input type="text" class="form-control @error('symbol') is-invalid @enderror"  name='symbol' id="currency-symbol" value="{{ old('symbol') }}">
                            @error('symbol')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label d-block">
                            <label for="currency-symbol" class="col-form-label">{{ decode('Exchang Rate') }} <span class="text-danger">*</span>  </label>
                        </div>
                        <div class="mb-3 input-group ">
                            <span class="input-group-text" id="basic-addon1">1 USD</span>
                            <input step="any" type="number" class="form-control @error('rate') is-invalid @enderror"  name='rate' id="currency-symbol" value="{{ old('rate') }}">

                        </div>
                        <div>
                            @error('rate')
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
