<!DOCTYPE html>
<html lang="en">
    <head>        
        <title>Translation Dashboard</title>
        <meta charset="UTF-8">
        <meta name="description" content="Translation tool">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
              crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
                crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
        <link rel='stylesheet' href="{{ URL::asset('css/custom.css') }}">
    </head>

    <body>
        @include('common.header')
        @include('common.errors')
        @yield('content')
        @include('common.footer')
    </body>
</html>