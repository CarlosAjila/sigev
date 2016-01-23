
<?php
if (isset($listar_p)) {
    echo 'hola mundo';
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>jQuery MultiSelect Demos</title>
        <!--<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">-->
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
        <!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">-->
        <link href="../../jQuery/jquery.multiselect.css" rel="stylesheet" type="text/css"/>
        <!--<link type="text/css" rel="stylesheet" href="../../Vista/css/estilo.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />-->
        <script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
        <script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
        <style>
            /*body { font-family:'Open Sans' Arial, Helvetica, sans-serif}*/
            ul,li { margin:0; padding:0; list-style:nont;}
            .label { color:#000; font-size:16px;}
            .container { max-width:528px; margin-top:150px;}
        </style>
    </head>

    <body>
        <form name="LISTAR_PRODUCTOR" id="LISTAR_PAIS" method="POST" action="<?PHP echo $_SERVER['../ITERACCION/PHP_SELF']; ?>">
            <div class="container">
                <h2>jQuery MultiSelect Basic Example</h2>
                <select name="country" multiple class="form-control">
                    <option value="">Country...</option>
                    <option value="AF">Afghanistan</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                </select>
            </div>
            <button type="submit" name="bt_presentar"  onclick="" id="bt_presentar">Presentarr</button>
            <input type="hidden" name="hdd_modi" id="hdd_modi" value="1" />
        </form>

<!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script src="../../jQuery/jquery.multiselect.js"></script>
        <script>
            $('select[multiple]').multiselect({
                columns: 3,
                placeholder: 'Select options',
                searchOptions: {
                    default: 'Search', // search input placeholder text

                    showOptGroups: false     // show option group titles if no options remaining

                },
            });
        </script>
    </select>

</body>
</html>




