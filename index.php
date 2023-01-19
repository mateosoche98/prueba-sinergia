<?php
include __DIR__ . '/header.php';
?>
<br>
<br>
<div class="container">
    <section class="row">
        <section class="col-md-4"></section>
        <section class="col-md-4">
            <div style="box-shadow: 0px 0px 10px 0px #545454;padding: 20px;margin: 10px;margin-bottom: 5px;">
                <form action="login.php" method="POST">
                    <section class="row">
                        <section class="col-md-12">
                            <h5 class="text-center">LOGIN</h5>
                        </section>
                    </section>
                    <hr>
                    <section class="row">
                        <section class="col-md-12">
                            <input type="text" name="usuario" placeholder="Usuario" class="form-control" required>
                        </section>
                    </section>
                    <br>
                    <section class="row">
                        <section class="col-md-12">
                            <input type="password" name="clave" placeholder="Clave" class="form-control" required>
                        </section>
                    </section>
                    <br>
                    <section class="row">
                        <section class="col-md-12">
                            <button class="btn btn-primary btn-block">Ingresar</button>
                        </section>
                    </section>
                </form>
            </div>
        </section>
    </section>
</div>