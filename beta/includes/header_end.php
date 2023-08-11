
</head>

<body class="fixed-left">


    <?php
    $topbar = traducir('includes/topbar.php', $_SESSION['idm']);
    echo $topbar;
    echo "<input type=hidden id='img' value=" . $_SESSION['img'] . ">";
    echo "<input type=hidden id='nusuario' value=" . $_SESSION['nusuario'] . ">";
    echo "<input type=hidden id=copia value=" . date("Y") . ">";
    ?>

