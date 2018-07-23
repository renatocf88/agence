<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META http-equiv=Content-Type content="text/html; charset=windows-1252">
        <META content="NOINDEX, NOFOLLOW" name=ROBOTS>
        <META http-equiv=Content-Language content=pt-br>
        <META http-equiv=pragma content=no-cache>
        <META http-equiv=cache-Control content="no cache">
        <META http-equiv=expires content="sat, 04 dec 1993 21:29:02 gmt">
<!--         <META http-equiv=Refresh content="600; url=main.php"> -->
        <link href="{{ asset('css/style.css') }}    " type="text/css" rel="stylesheet" />

        <title>CAOL - Controle de Atividades Online - Agence Interativa</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
       <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">


        <style>
            #sub1, #sub2, #sub3
            { position: absolute;
              left: 480px;
              visibility: hidden;
              z-index: 3
            }
        </style>

        
        <META content="MSHTML 6.00.2800.1106" name=GENERATOR>
    </head>
<body>
       <div class="content mt-3">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <!--     <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script> -->
        <script language='javascript' src="{{ asset('js/jquery.js') }}"></script>
        <script language='javascript' src="{{ asset('js/popcalendar.js') }}"></script>
        <script language='javascript' src="{{ asset('js/scripts.js') }}"></script>
        <SCRIPT language='javascript' src="{{ asset('js/cor_fundo.js') }}"></SCRIPT> 
 <!--        <SCRIPT language='javascript'  src="{{ asset('inc/menu_array.js.htm') }}"></SCRIPT>
        <SCRIPT language='javascript' src="{{ asset('inc/menu_script.js') }}"></SCRIPT> -->

</body>
</html>
