<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if($page['component'] === 'CreatedLanding')
        <title>{{ $page['props']['page']['page_seo']['title'] ??  config('app.name', 'Laravel')}}</title>
        <meta name="description" content="{{ $page['props']['page']['page_seo']['description']}}">
        <link rel="icon" type="image/x-icon" href="{{$page['props']['page']['page_seo']['favicon']}}">
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endif
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
