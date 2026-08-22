<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="{{ asset('pkkmblogo-transparent.png') }}?v={{ filemtime(public_path('pkkmblogo-transparent.png')) }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('pkkmblogo-transparent.png') }}?v={{ filemtime(public_path('pkkmblogo-transparent.png')) }}">
<link rel="apple-touch-icon" href="{{ asset('pkkmblogo-transparent.png') }}?v={{ filemtime(public_path('pkkmblogo-transparent.png')) }}">

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}"/>
