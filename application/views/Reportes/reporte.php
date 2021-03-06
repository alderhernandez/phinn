<main class="mdl-layout__content mdl-color--grey-100">
		<div class="container">
            <div class="Buscar row column">               
                <div class="col s1 m1 l1 offset-l3 offset-m2">
                    <i style='color:#039be5; font-size:40px;' class="material-icons">search</i>
                </div>
                <div class="input-field col s12 m6 l4">
                    <input  id="filtrarRep" type="text" placeholder="Buscar" class="validate">
                    <label for="search"></label>
                </div>
            </div>        
        </div>
<!--/////////////////////////////////////////////////////////////////////////////////////////
                   	BOTONES SUPERIORES
//////////////////////////////////////////////////////////////////////////////////////////-->
    <div class="right row">
        <div id="crearR" class="col s2 m2 l2">
            <a data-tooltip='CREAR REPORTE' href="#nuevoReporte" class="modal-trigger tooltipped">
                <i style='font-size:40px;' class="waves-effect waves-purple material-icons">queue</i>
            </a>
        </div>
        <div class="col s1 m1 l1"><p></p></div><div class="col s1 m1 l1"><p></p></div>
        <div id="retornarP" class="col s2 m2 l2">
            <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/dashboard')?>" class="modal-trigger tooltipped">
                <i style='font-size:40px;' class="waves-effect waves-purple material-icons">keyboard_backspace</i>
            </a>
        </div>         
        <div class="col s1 m1 l1"><p></p></div><div class="col s1 m1 l1"><p></p></div>
    </div><br><br>
<!--/////////////////////////////////////////////////////////////////////////////////////////
                    TABLA REPORTES COMPLETOS
//////////////////////////////////////////////////////////////////////////////////////////-->
        <div class="row">
            <div class="col s12">
                <table id="tlbListaRep" class="striped">
                    <thead>
                        <tr class="tblcabecera">
                            <th>Nº orden</th>                                 
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!($listaReport)){
                            } else {
                                foreach ($listaReport as $list) {
                                    if($list['Estado'] == 0){
                                        $activo="<td><a data-tooltip='ORDEN ANULADA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>close</i></a></td>";
                                        $status="<li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                    }elseif($list['Estado'] == 1){
                                        $activo="<td><a data-tooltip='ORDEN ACTIVA' class='btn-flat tooltipped noHover'><i style='color:green; font-size:30px;' class='material-icons'>done</i></a></td>";
                                        $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                 <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                 <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                    }elseif($list['Estado'] == 2){
                                        $activo="<td><a data-tooltip='ORDEN CERRADA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>not_interested</i></a></td>";
                                        $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                    <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                    }elseif($list['Estado'] == 3){
                                        $activo="<td><a data-tooltip='ORDEN INACTIVA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>info_outline</i></a></td>";
                                        $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                    <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 1)'>Activar</a></li>
                                                    <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                    <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                    }
                                    echo "<tr>                                                                        
                                            <td class='bold'>".$list['NoOrden']."</td>
                                            <td class='bold'>".$list['FechaInicio']."</td>
                                            <td class='bold'>".$list['FechaFin']."</td>
                                            ".$activo."
                                            <td>
                                                <a class='dropdown-button btn-floating' id='ddlts' data-activates='dropdown".$list['IdOrden']."' href='#!'><i class='material-icons left'>mode_edit</i></a>
                                                <ul id='dropdown".$list['IdOrden']."' class='dropdown-content'>
                                            ".$status."
                                                </ul>
                                            </td>                                                                 
                                        </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>
<br>
<!--/////////////////////////////////////////////////////////////////////////////////////////
                                        PANTALLAS MODALES
//////////////////////////////////////////////////////////////////////////////////////////-->
<!-- NUEVA ORDEN PRODUCCION -->
<div id="nuevoReporte" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>        
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">NUEVA ORDEN DE PRODUCCIÓN</h6>
            </div>
        </div>
        
        <div class="row">
            <form class="col s12" method="POST" name="formNuevoReporte" id="formNuevoReporte" action="<?php echo base_url()?>index.php/reporte_Controller/guardarReporte">
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                        <input class="mayuscula" maxlength="4" name="numOrden" placeholder="Nº orden" id="numOrden" type="text" class="required">
                        <label id="lblNumeroOrden" class="labelValidacion">DIGITE EL Nº ORDEN</label>
                    </div>                   
                </div>
                <br>
                <div class="row">
	                <div class="input-field col s12 m6 s6">
	                    <input type="text" id="fechaInicio" name="fechaInicio" class="datepicker">
	                    <label for="fechaInicio">Fecha inicio</label>
	                </div>
                    
	                <div class="input-field col s12 m6 s6">
	                    <input type="text" id="fechaFinal" name="fechaFinal" class="datepicker">
	                    <label for="fechaFinal">Fecha final</label>
	                </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                      <textarea id="comentario" class="text-area-ord" name="comentario"></textarea>
                      <label for="comentario">Comentarios</label>
                    </div>                  
                </div>
                <br>
                <div class="row">                    
                    <div class="center">
			      	    <a class="Btnadd btn waves-effect waves-light" id="guardaRpt" href="#" hre style="background-color:#831F82;">GUARDAR
                            <i class="material-icons right">send</i>
                        </a>
			        </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ACTUALIZAR ORDEN PRODUCCION -->
<div id="nuevaOrdenP" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>        
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" id="title1" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">EDITANDO ORDEN DE PRODUCCIÓN</h6>
                <h6 class="center" id="title2" type="hide" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">ORDEN DE PRODUCCIÓN ANULADA</h6>
            </div>
        </div>
        
        <div class="row">
            <form class="col s12" method="POST" name="formActualizarOrd" id="formActualizarOrd" action="<?php echo base_url()?>index.php/reporte_Controller/editarOrdProd">
                <div class="input-field col s6">
                    <input value="#" id="identificador" name="identificador" type="hidden" class="validate">
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                        <input disabled data-tooltip='Nº ORDEN' class="mayuscula" maxlength="4" name="numOrden1" id="numOrden1" placeholder="Nº orden" type="text" class="required">
                        <label id="lblNumeroOrden" class="labelValidacion">Nº ORDEN</label>
                    </div>                   
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m6 s6">
                        <input type="text" id="fechaInicio1" name="fechaInicio1" class="datepicker">
                        <label for="fechaInicio">Fecha inicio</label>
                    </div>
                    
                    <div class="input-field col s12 m6 s6">
                        <input type="text" id="fechaFinal1" name="fechaFinal1" class="datepicker">
                        <label for="fechaFinal">Fecha final</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                      <textarea id="comentario1" class="text-area-ord" name="comentario1"></textarea>
                      <label for="comentario">Comentarios</label>
                    </div>                  
                </div>
                <br>
                <div class="row">                    
                    <div class="center">
                        <a class="Btnadd btn waves-effect waves-light" id="actualizarRpt" href="#" style="background-color:#831F82;">ACTUALIZAR
                            <i class="material-icons right">send</i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>