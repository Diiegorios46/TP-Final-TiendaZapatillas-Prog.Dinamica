<?php 
include '../estructura/cabecera.php';
/*ACA VA EL COSO PARA LA COMPRA , CAMBPOS DE PAGO FICTICIOS*/

$datos = data_submitted();

echo "<h1>";
echo $datos['idproducto'];
echo "</h1>";
?>

<main class="container-sm min-height-50">

    <section class="m-5 d-flex flex-row">
    
        <div class="d-flex flex-column justify-content-between  w-80 mr-1">

            <div class="d-flex flex-column">

                    <div class="d-flex flex-column border-bottom border-gray">

                        <h1 class="pb-4">Shooping Cart</h1>

                        <div class="d-flex justify-content-around ">
                            <span class="mr-20">Product</span>
                            <span>talle</span>
                            <span>Cantidad</span>
                            <span>Total Precio</span>
                        </div>

                    </div>

                    <div class="d-flex flex-row justify-content-around">

                        <div class="d-flex flex-row gap-10 align-items-center border-bottom border-gray">
                            
                            <div class="w-15">
                                <img src="../Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <span>NOMBRE MARCA</span>
                            <span>TALLE</span>
                            <span>CANTIDAD</span>
                            <span>TOTAL DE ESTA UNIDAD</span>
                        </div>

                    </div>

                    <div class="d-flex flex-row justify-content-around">
                        <div class="d-flex flex-row gap-10 align-items-center border-bottom border-gray">
                            
                            <div class="w-15">
                                <img src="../Assets/imgs/imgZapatilla-auto.webp" alt="" class="w-100 h-100">
                            </div>
                            <span>NOMBRE MARCA</span>
                            <span>TALLE</span>
                            <span>CANTIDAD</span>
                            <span>TOTAL DE ESTA UNIDAD</span>
                        </div>
                    </div>

                <!--Este div es parte de la separacion de ambos elementos-->
                </div>
                

                <!--Es la parte de abajo del cart-->
                <div class="d-flex flex-row justify-content-between ">
                    <button><a href="../home/index.php">Continue Shopping</a></button>
                    <span>Total:$148.96</span>
                </div>

        </div>

        <div class="w-25 p-3 ">
            <div class="p-3 shadow-sm card-pago">
                <h3>Payment Info</h3>
                <p>Payment Method:</p>
                <div class="d-flex flex-row justify-content-between">
                    <div class="rounded-pill border border-light around p-1">Credit Card</div>
                    <div class="rounded-pill border border-light around p-1">PayPal</div>
                </div>
                <p>Name on card</p>
                <input type="text" name="" id="" class="input-compra">
                <p>Expiration Date</p>
                <div class="d-flex flex-row mb-5">
                    <input type="number" name="" id="" placeholder="MM" class="w-32">
                    <input type="number" name="" id="" placeholder="YYY" value="" class="w-32">
                    <input type="number" name="" id="" placeholder="XXX" value="" class="w-32">
                </div>
                <button class="btn btn-primary w-100" onclick="pago()">Pay</button>
            </div>

        </div>

    </section>
    
    <script>
        
        /**HAY QUE HACER UNA PAGINA ACTION PARA DARLE EL ALTA*/
        function pago(){
            window.location.href = '../public/index.php'
        }

    </script>


</main>