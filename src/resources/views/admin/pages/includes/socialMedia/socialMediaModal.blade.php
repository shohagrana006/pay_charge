<div class="modal fade" id="social-media-{{ $key}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 id="language-modal-title">{{ decode('Update Social Media Link') }}</h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div id="modal-body" class="modal-body">
                  <div class="col-12">
                      <form method="post" action="{{ route('admin.settings.socialMedia.update') }}" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                              <label>{{decode('Name')}}</label>
                              <select name="name" class="form-control">
                                  @foreach (json_decode($generalSetting->social_media, true) as $option => $socialMedia)
                                      <option
                                     {{ $key == $option ? "selected" :'' }}
                                      value="{{ $option }}">{{$option}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="mb-3">
                              <label>{{decode('Link')}}</label>
                              <input class="form-control" type="text" name="link" value="{{ json_decode($value)->link }}">
                          </div>
                          <div class="mb-3">
                              <label>{{decode('icon')}}</label>
                              <input class="form-control" type="text" name="icon" value="{{json_decode($value,true)['icon']}}">
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
