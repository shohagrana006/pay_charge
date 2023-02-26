<div class="modal fade" id="create-ad"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="language-modal-title">{{ decode('Create Add') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="col-12">
                    <form method="post" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>{{decode('Type')}} <span class="text-danger">*</span></label>
                            <select id="ad-position" class="mt-2 form-control" name="position" id="">
                                <option value="blog_right">{{ decode('blog right') }}</option>
                                <option value="banner_right">{{ decode('banner right') }}</option>
                                <option value="banner_ads">{{ decode('banner ad') }}</option>
                            </select>
                            <div class="ms-3 text-danger">
                                @error('position') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="d-none" id="google-ads-active">
                            <label for="google-ads"> {{ decode('Google Ads') }}</label>
                             <input value="active"  type="checkbox" name="ad_script" id="google-ads">
                        </div>

                        <div id="link" class="mb-3">
                            <label>{{decode('Link')}}</label>
                            <input class="form-control" type="text" name="link" value="">
                        </div>
                        <div class="d-none google-script mb-3">
                            <label>{{decode('script')}} <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="google_ads_script" >
                        </div>

                        <div class="image-secion mb-2 mt-2">
                            <label class="mb-2" for="">Image
                                <span class="text-danger"> ({{implode(", ", fileFormat())}})
                                & size <span class="image-size">
                                    [{{ App\Cp\ImageProcessor::filePath()['blog_right']['size'] }}]
                                </span>
                                </span>
                            </label>
                             <input  class="ad-image-create form-control" type="file" name="image" id="">
                             <div id="ad-image-preview">

                             </div>
                        </div>
                        <div class="mb-3">
                            <input class="btn btn--primary text--light" type="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
