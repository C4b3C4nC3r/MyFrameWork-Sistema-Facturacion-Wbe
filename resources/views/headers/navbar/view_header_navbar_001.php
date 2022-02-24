<?php


    if(file_exists($_ENV["NAVBAR_JSON"])){

        $file_json = file_get_contents($_ENV['NAVBAR_JSON']);
        $json = json_decode($file_json,true);
        //echo var_dump($json);

    }

    /**
     * 
     * NAVBAR DINAMICO
     * 
     */
    $navbar = $json['navbar01'];
//    echo var_dump($navbar) 
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home">S-F&copy2020</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    
                        //Aqui trabajara
                        
                        $href = null;
                        $label =null;
                        $enabled = null;
                        $elements = null;

                        foreach ($navbar as $key => $item) {
                            $label = $item[0]["label"];
                            $href = $item[1]["href"];
                            $enabled = $item[2]["enabled"];
                            $elements = $item[3]["elements"];

                            if(is_null($elements)):

                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="<?php echo $href;?>"><?php echo $label;?></a>
                                    </li>
                                <?php
                            else:
                                
                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Factura
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php
                                                foreach ($elements as $key => $elementDrop) {
                                                    $label = $elementDrop[0]["label"];
                                                    $href = $elementDrop[1]["href"];
                                                    $enabled = $elementDrop[2]["enabled"];
                                                    $elements = $elementDrop[3]["elements"];
                                                    ?>

                                                        <li><a class="dropdown-item" href="<?php echo $href;?>"><?php echo $label;?></a></li>

                                                    <?php
                                                }
                                            
                                            ?>

                                        </ul>
                                    </li>
                                
                                <?php
                                
                            endif;
                        }

                        //fin
                    ?>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar Producto</button>
                </form>
            </div>
        </div>
    </nav>



<!-- 
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Nuevo Producto</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Nuevo Cliente</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Factura
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Nueva Factura</a></li>
                        <li><a class="dropdown-item" href="#">Devolucion Factura</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Suspender Factura</a></li>
                    </ul>
                    </li>
    
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">S-F&copy2020</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar Producto</button>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Nuevo Producto</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Nuevo Cliente</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Nuevo Cliente</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Nueva Factura</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Devolucion Factura</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Suspender Factura</a>
                    </li>
                    
                </ul>
                
            </div>
        </div>
        </div>




 -->