<html>
<head>
    <title>Pharmacy Management - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="stylesheet" type="text/css" href="{{asset('css/jqueryui.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
</head>
<body>
{{--<p>Hello World</p>--}}

<div class="main-container" id="app">
    @include('Layouts.side_bar')
    @yield('content')
</div>
</body>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" ></script>--}}

{{--<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js" integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI=" crossorigin="anonymous"></script>--}}
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jqueryui.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
{{--<script src="{{asset('js/bundle.js')}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
{{--<script src="{{ asset('js/app.js') . '?' .rand(0,99999) }}" defer></script>--}}
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@yield('script')

<script>
    $(function () {
        // $('#datepicker').datepicker();

        $('#datepicker').datepicker({
            // altFormat:"dd-mm-YY",
            dateFormat:'yy-mm-dd',
            changeYear:true,
            changeMonth:true,
            // showButtonPanel: true,
            autoSize: true,
            hideIfNoPrevNext: true,
            yearRange: "1960:2030",
            duration:'slow',
        });
        $('#to_datepicker').datepicker({
            // altFormat:"dd-mm-YY",
            dateFormat:'yy-mm-dd',
            changeYear:true,
            changeMonth:true,
            // showButtonPanel: true,
            autoSize: true,
            hideIfNoPrevNext: true,
            yearRange: "1960:2030",
            duration:'slow',
        });
    });
</script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>--}}

{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}

</html>
