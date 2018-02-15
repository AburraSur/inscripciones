<?php
    $cod  = $_GET["cod"];
    $i = $cod - 1;
    print "<div class='empresa panel-default' id='child$i'>
                        <div class='panel-heading'>
                                <h3 class='panel-title'><i class='fa fa-bar-chart-o fa-fw'></i>Datos Personales del Participante</h3>
                        </div>
                        
                        <div class='row'>
                        <br>
                        <div class='form-group col-lg-6'>
                            <label>Identificación</label>
                            <input class='form-control' name='codigo$cod' id='codigo' value='$cod' style='display:none' >
                            <input class='form-control' name='idpersona[]' onchange='leer(this.value)' required>
                        </div>
                        <!--Los inputs para ingresar la empresa se encuentran en clases/datousuario.php -->
                        <span id='txtusuarios$cod'></span>
                        </div>
                    </div>";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * <div class='alert alert-info'>
                            <strong>Ingreso de Participante Nuevo</strong>
                        </div>
 */

