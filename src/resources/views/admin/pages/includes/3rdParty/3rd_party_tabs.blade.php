<section class="bg--light rounded">
    <div class="table-wrapper custom-tabs p-3">
        <ul>
            <li class="@yield('mail')"><a class="text-dark" href="{{route('admin.settings.mail')}}">{{ decode('Mail Config') }}</a></li>
            <li class="@yield('recaptcha')"><a class="text-dark" href="{{route('admin.settings.recaptcha')}}">{{ decode('Re-captcha') }}</a></li>
            <li class="@yield('media_login')"><a class="text-dark" href="{{route('admin.settings.media.login')}}">{{ decode('Social Media Login') }}</a></li>
        </ul>
    </div>
</section>
