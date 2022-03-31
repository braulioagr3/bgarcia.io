<?php
    session_start();
    $msj="";
    if(isset($_POST['btnAccion']))
    {
        switch($_POST['btnAccion'])
        {
            case 'Agregar':
                if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY)))
                {
                    $ID = openssl_decrypt($_POST['id'],COD,KEY);
                    $msj.="Ok el ID es correcto ".$ID. "<br/>";
                }
                else
                {
                    $msj.="A ocurrido un error con el ID".$ID. "<br/>";
                }


                if(is_string(openssl_decrypt($_POST['descripcion'],COD,KEY)))
                {
                    $NOMBRE=openssl_decrypt($_POST['descripcion'],COD,KEY);
                    $msj.= "El nombre es: ".$NOMBRE. "<br/>";

                }else
                {
                    $msj.= "A ocurrido un error en el nombre"; break;
                }

                if(is_string(openssl_decrypt($_POST['existencia'],COD,KEY)))
                {
                    $CANTIDAD=openssl_decrypt($_POST['existencia'],COD,KEY);
                }else
                {
                    $msj.= "A ocurrido un error en la existencia";break;
                    $msj.= "La existencia es: ".$CANTIDAD. "<br/>";

                }

                if(is_string(openssl_decrypt($_POST['precio'],COD,KEY)))
                {
                    $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                    $msj.= "El precio es: ".$PRECIO. "<br/>";
                }else
                {
                    $msj.= "A ocurrido un error en el precio". "<br/>";break;
                }

                if(!isset($_SESSION['carrito']))//para las seciones
                {
                   $produto = array(
                       'codproducto' =>$ID, 
                       'descripcion' =>$NOMBRE, 
                       'existencia' => $CANTIDAD, 
                       'precio' => $PRECIO, 
                    );
                    $_SESSION['carrito'][0]=$produto;
                    $msj = "Producto agregado al carrito";
                    
                }
                else
                {
                    $idPro=array_column($_SESSION['carrito'], "codproducto");
                   
                    if(in_array($ID,$idPro))//para ver si esta ya el id del producto
                    {
                        echo "<script>alert('El producto ya ha sido seleccionado...'); </script>";
                        $msj="";
                    }
                    else
                    {
                        $NumeroProd=count($_SESSION['carrito']);
                        $produto = array(
                                'codproducto' =>$ID, 
                                'descripcion' =>$NOMBRE, 
                                'existencia' => $CANTIDAD, 
                                'precio' => $PRECIO, 
                        );
                        $_SESSION['carrito'][$NumeroProd]=$produto;
                        $msj = "Producto agregado al carrito";
                    }

                }
                //$msj= print_r($_SESSION,true);
            break;
            
            case "Eliminar":

                if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY)))
                {
                    $ID = openssl_decrypt($_POST['id'],COD,KEY);
                
                    foreach($_SESSION['carrito'] as $indice=>$producto)
                    {
                        if($producto['codproducto']==$ID){
                            unset($_SESSION['carrito'][$indice]);
                            echo "<script>alert('Elemento eliminado');</script>";
                        }
                    }
                }
                else
                {
                    $msj.="A ocurrido un error con el ID".$ID. "<br/>";
                }

            break;
        }

    }

?>