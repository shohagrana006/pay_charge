<div class="modal fade" id="ad-{{$ad->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="language-modal-title">{{ decode('Update Add') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="col-12">
                    <form method="post" action="{{ route('admin.ads.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input  hidden value="{{ $ad->id }}" name="id" type="text">
                        <input  hidden value="{{ $ad->position }}" name="type" type="text">
                        @if($ad->google_ads_script)
                            <div class=" mb-3 google-script" >
                                <input type="hidden" name="ad_script" value="active">
                                <label>{{decode('script')}} <span class="text-danger">*</span></label>
                                <input value="{{$ad->google_ads_script}}" class="form-control" type="text" name="google_ads_script" >
                            </div>
                        @else
                            <div class="mb-3">
                                <label>{{decode('Link')}}</label>
                                <input class="form-control" type="text" name="link" value="{{ $ad->link }}">
                            </div>
                            <div class="mb-2 mt-2">
                                <label class="mb-2" for="">Image  <span class="text-danger"> ({{implode(", ", fileFormat())}})
                                & size [{{ App\Cp\ImageProcessor::filePath()[$ad->position]['size'] }}]</span></label>
                                <input data-id='{{$ad->id}}' class="ad-image form-control" type="file" name="image" id="">
                                <div id="ad-image-preview-{{ $ad->id }}">
                                    <img class='mt-2 category-image-preview'
                                    src="{{displayImage('assets/images/general/ads/'.$ad->image, App\Cp\ImageProcessor::filePath()[$ad->position]['size'])}}">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <input class="btn btn--primary text--light" type="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
