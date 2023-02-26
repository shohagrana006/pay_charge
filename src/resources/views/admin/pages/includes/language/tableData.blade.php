
@if($languageKeyWithData)
    @foreach($languageKeyWithData as $key => $value)
        <tr>
            <td class="p-2 border">{{ $loop->iteration }}</td>
            <td class="p-2 border"><input  id="lang-key-{{ $loop->iteration }}"  hidden type="text" class="form-control border-0 bg-transparent" readonly value="{{ $key }}">
            {{ $key }}
            </td>
            <td class="p-2 border">
            <input  id="lang-key-value-{{ $loop->iteration }}" name='translate[{{ $key }}]' value="
                @if(!is_array($value))
                    {{$value}}
                @else
                    @php
                        print_r($value);
                    @endphp
                @endif
            " class="form-control  border-0 " type="text">
            </td>
            <td class="p-2 border text-center">
                <button key='{{$language->code}}' unique-id="{{ $loop->iteration }}" id="update-lang-key" class="btn btn--primary">{{ decode('update') }}</button>
            </td>
        </tr>
    @endforeach
@else
  'Please :( Reload The site Then Try Again'
@endif
