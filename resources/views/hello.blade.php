<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
    <h1>Hello Ini file pertama saya didalam view laravel</h1>
    @php
        $nama = 'Budi';
        $nilai = 59.00;    
    @endphp

    {{-- stuktur kendali IF --}}
    @if ($nilai >= 60)
        @php 
            $ket = "Lulus";
        @endphp
    @else
        @php
            $ket = "Tidak Lulus";
        @endphp
    @endif

    {{-- tampilan --}}
    {{ $nama }} <p> Dengan Nilai </p> {{ $nilai }} <p> Dinyatakan </p> {{ $ket }}
</body>
</html>