<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    
</head>
<body>
    <div class="container mt-5">
        <form class="row justify-content-md-center" action="{{ route('url.shorten') }}" method="POST">
            @csrf
            <div class="col-6">
                <input type="text" class="@error('url') is-invalid @enderror form-control" id="url-input" name="long_url" placeholder="URL" value="{{ old('url') }}">
                <span class="text text-danger">{{ $errors->first('url') }}</span>
            </div>
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="private" id="private-url" value="1">
                    <label class="form-check-label" for="private-url">
                      Private URL
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Generate short url</button>
            </div>
        </form>
        <table class="table table-striped mt-5 table-bordered">
            <thead>
                <tr>
                    <th scope="col">SHORT URL</th>
                    <th scope="col">LONG URL</th>
                    <th scope="col">Clicks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($urls as $key => $url)
                    <tr>
                        <td>{{ $url->short_url }}</td>
                        <td>{{ $url->long_url }}</td>
                        {{-- <td>{{ $url->clicks->click }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
            {!! $urls->links() !!}
        </div>
    </div>
</body>
</html>