<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/public/images/favicon.ico" rel="icon" type="image/x-icon" />

    <title><?php print $_SESSION['oConfig']->getConfig()->info->title; ?></title>

    <link rel="stylesheet" type="text/css" href="/public/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/public/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/public/css/line-awesome.css">
    <link rel="stylesheet" type="text/css" href="/public/css/line-awesome-font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/responsive.css">

    <?php echo $aViewCss; ?>
</head>

<style>
    #countryList{
        position: absolute;
        background-color: #efefef;
        width: 100%;
        border-bottom: 1px solid #bdbdbd;
        border-right: 1px solid #bdbdbd;
        border-left: 1px solid #bdbdbd;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        text-align: left;
        box-shadow: 0 4px 7px -5px black;
        z-index: 10;
        transition: all 0.5s;
    }

    #countryList ul li{
        background-color: #efefef;
        line-height: 1.9;
        border-bottom: 1px solid #b2b2b26b;
        transition: all 0.5s;
    }

    #countryList ul li a{
        transition: all 0.5s;
        text-decoration: none !important;
        color: #7b7b7b !important;
        padding-left: 1em;
        width: 100% !important;
        display: block;
    }

    #countryList ul li:last-child{
        transition: all 0.5s;
        border-bottom: none !important;
    }

    #countryList li:hover{
        background-color: #ff8d8d !important;
        cursor: pointer !important;
        transition: all 0.5s;
    }

    #countryList li:hover a{
        color: #ffffff !important;
        transition: all 0.5s;
    }

    .user-info a {
        white-space: nowrap !important;
        width: 91px !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    .btn-editar{
        background-color: #728062 !important;
        color: #FFFFFF !important;
        transition: all 1s !important;
    }

    .btn-editar:hover{
        box-shadow: 0 4px 20px 0px black !important;
        transition: all 1s !important;
    }


</style>