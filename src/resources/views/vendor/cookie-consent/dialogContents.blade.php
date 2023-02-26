
<div class="js-cookie-consent cookie-consent cookies ">
    <div class="container">
      <div class="cookies-content">
        <div class="row align-items-center">
          <div class="col-12 col-md-8">
            <div class="cookie-left cookie-consent__message">
              {{ decode('cookie text') }}
            </div>
          </div>
          <div class="col-12 col-md-4 mt-3 mt-md-0">
            <div class="cookie-right">
              <button type="button" class="js-cookie-consent-agree cookie-consent__agree  btn btn-primary fs-4 px-3 px-lg-4 px-xl-5" >
               {{ decode('Accept cookies') }}
              </button>
              <button  type="button" id="hide-cookie" class="btn cookie-hide btn-outline-light fs-4 px-3 px-lg-4 px-xl-5" onclick="hideCookieViaAjax('{{route('user.hideCookie') }}')">
               {{ decode('No thanks') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
