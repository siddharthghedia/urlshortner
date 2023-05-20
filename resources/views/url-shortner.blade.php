<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <!-- Styles -->
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="container text-center mt-5">
        <form class="row justify-content-md-center" action="">
            <div class="col-6">
                <input type="text" class="form-control" id="url-input" placeholder="URL">
            </div>
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="private-url">
                    <label class="form-check-label" for="private-url">
                      Private URL
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary">Generate short url</button>
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>