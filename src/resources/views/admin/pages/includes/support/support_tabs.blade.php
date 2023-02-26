<section class="rounded">
    <div class="custom-tabs px-3">
        <ul>
            <li class="@yield('subscriber')"><a class="text-dark" href="{{route('admin.support.subscriber')}}">{{ decode('Subscriber') }}</a></li>
            <li class="@yield('contact')"><a class="text-dark" href="{{route('admin.support.contact')}}">{{ decode('contact') }}</a></li>
        </ul>
    </div>
</section>
