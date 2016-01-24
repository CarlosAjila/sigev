<script language="javascript">
	$(function(){
	 	$("input[name='file']").on('change', function(){																		
			var formData = new FormData($("#FormTrabajoCampo")[0]);
			var ruta = "../../Contralador/CargarFoto.php";
			$.ajax({
					url: ruta,					
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(datos)
					{
						var respuesta = $.parseJSON(datos);
						//alert(respuesta.ruta);
						$("#respuesta").html(respuesta);
						$('#ruta_imagen').val(respuesta.ruta);
						$('#imagen').attr('src','../'+respuesta.ruta);
						
					}
					
			});									
		});	
	});		

</script>

<?php
require_once("../Modelo/clsTrabajo_campo.php");

$objlistar = new clsTrabajo_campo("","","","","","","","","","");

$codigo = $_POST['id'];
//$arreglo_listar = $objlistar->buscar($_POST['id']);
$arreglo_listar = $objlistar->buscar($codigo);
$i = 0; //contador del comobo tipo de maquina
$c = 0;
$j = 0; //contador del combo tipo de quimico

	$valores=array("AEDES", "CULES", "ANOFELES");//VALORES PARA 
	
	$valores_tipo_maquina=array("MAQUINA ULV", "MOTO MOCHILA"); //VALORES TIPO DE MAQUINARIA
	
	$valores_tipo_quimico=array("MALATION", "ABATE","INSECTISIDA"); //VALORES TIPO DE QUIMICO
	
	$valor_sector = $arreglo_listar[0]['sector_endemico'];

	//Carga el valor que tiene el paciente de la base de datos
	echo '<script language="javascript">$(document).ready(function(){'; 
	echo '$("#tipo_criadero").val("'.$arreglo_listar[0]['tipo_criadero'].'")';
	echo '})</script>';
	
	echo '<script language="javascript">$(document).ready(function(){'; 
	echo '$("#tipo_maquina").val("'.$arreglo_listar[0]['tipo_maquina'].'")';
	echo '})</script>';
	
	echo '<script language="javascript">$(document).ready(function(){'; 
	echo '$("#tipo_quimico").val("'.$arreglo_listar[0]['tipo_quimico'].'")';
	echo '})</script>';
?> 						 
	<table align="center" border="1" class="tablaborde">
				
			<th colspan="7" align="center">DATOS DEL PACIENTE</th>
			<tr>
				<td class="encabezadolista" align="center">Cedula</td>
        		<td class="encabezadolista"  align="center">Nombre</td>
				<td class="encabezadolista"  align="center">Fecha Registro</td>
				<td class="encabezadolista"  align="center">Lugar Examen</td>
				<td class="encabezadolista"  align="center">Caso</td>
				<td class="encabezadolista"  align="center">Enfermedad</td>
				<td class="encabezadolista"  align="center">Prioridad</td>
			</tr>
				<tr>
					<td><?php echo $arreglo_listar[0]['Cedula']?></td>
					<td><?php echo $arreglo_listar[0]['Nombre'] ?></td>
					<td><?php echo $arreglo_listar[0]['Fecha'] ?></td>
					<td><?php echo $arreglo_listar[0]['Lugar_Examen']?></td>
					<td><?php echo $arreglo_listar[0]['Caso'] ?></td>
					<td><?php echo $arreglo_listar[0]['Enfermedad'] ?></td>
					<td><?php echo $arreglo_listar[0]['Prioridad'] ?></td>
				</tr>
	</table>
   
	</br>
	
	<form method="POST" action="" name="FormTrabajoCampo" id="FormTrabajoCampo" enctype="multipart/form-data">
	  <table border="1" class="tablaborde" align="center">
		  <th colspan="2" align="center">DATOS DEL TRABAJO DE CAMPO</th>
			<tr align="center">
				<td colspan="2">                                	
					<img id="imagen" src ="../<?php echo $arreglo_listar[0]['ruta_imagen'] ?>" width="225" height="208" />								                   
                     <input type="file"  name="file" > 
                     <input type="hidden" id="ruta_imagen" name="ruta_imagen" value="<?php echo $arreglo_listar[0]['ruta_imagen'] ?>" />                         
                     <div id="respuesta">
                     </div>  
                    
                    
				</td>
		  	</tr>
		  	<tr>
				<td> <strong>Cod:</strong></td>
				<td>	
                    <input type="text" name="id_trabajo" id="id_trabajo" readonly="readonly" size="2" 
                    	value="<?php echo $arreglo_listar[0]['id_trabajo_campo'] ?>"/>				
				</td>
		  	</tr>
		  	<tr>
				<td align="left"><strong># Persona:</strong></td>				
				<td>	
					<input type="text" name="num_personas" id="num_personas" size="3" onKeyPress="return validar_num(event)" maxlength="2" value="<?php echo $arreglo_listar[0]['n_personas'] ?>"/>
				</td>
		  	</tr>
		  	<tr align="left">
				<td><strong>Tipo Criadero</strong></td>
				<td> 				                   	
					<select id="tipo_criadero" name="tipo_criadero" class="cargo">'
					<?php do{
						echo '<option value="'.$valores[$c].'">'.$valores[$c].'</option>';
						$c++;
					}while($c<sizeof($valores));
					?>     
                    </select>                     
				</td>				
				
		  	</tr>		
			<tr align="left">
				<td><strong>Sector Endémico:</strong></td>
					
				<td>             	
				<?php
					if($valor_sector == "SI"){	
						echo '<input type="radio" name="sector" id="sector" value="SI" checked = "checked"> SI';
						echo '<input type="radio" name="sector" id="sector" value="NO"> NO';
					}
					else{
						echo '<input type="radio" name="sector" id="sector" value="SI"> SI';
						echo '<input type="radio" name="sector" id="sector" value="NO" checked = "checked"> NO';
					}
				?>
					
                </td>				
		  	</tr>
			
			<tr>
				<td align="left"><strong>Observación:</strong></td>
                <td>
					<textarea id="observacion" name="observacion" cols="25" rows="3">
						<?php echo $arreglo_listar[0]['observacion'] ?>			
					</textarea>
				</td>
			</tr>
			<tr align="left">
				<td><strong>Tipo Máquinaria:</strong></td>
				<td>
					<select name="tipo_maquina"id="tipo_maquina" class="cargo"> ';
                    <?php 
						do{
							echo '<option value="'.$valores_tipo_maquina[$i].'">'.$valores_tipo_maquina[$i].'</option>';
							$i++;
						}while($i<sizeof($valores_tipo_maquina));                         
                    ?>
					</select>												
				</td>
		  	</tr>
			<tr align="left">
				<td><strong>Tipo de Químico:</strong></td>
				<td>
					<select name="tipo_quimico"id="tipo_quimico" class="cargo">';
                    <?php do{
						echo '<option value="'.$valores_tipo_quimico[$j].'">'.$valores_tipo_quimico[$j].'</option>';
						$j++;
					}while($j<sizeof($valores_tipo_quimico));                         
                    ?>
					</select>					
		  	</tr>
			<tr align="left">
				<td><strong>Cantidad de Químico:</strong></td>
				<td>
					<input type="text" name="cant_quimico" id="cant_quimico" value="<?php echo $arreglo_listar[0]['cantidad_quimico'] ?>"size="4" onKeyPress="return validar_num(event)" maxlength="6"/> Gramos
			  </td>
		  	</tr>
			<tr align="left">
				<td><strong>Criterio:</strong></td>
				<td>
					<textarea id="criterio_tecnico" name="criterio_tecnico" cols="25" rows="5">	
						<?php echo $arreglo_listar[0]['criterio'] ?>
					</textarea>
				</td>
		  	</tr>						
		</table>
	  
		<table>
			<tr>
				<td align="center">					
					<input type="button" name="bteditar" id="bteditar" class="imageneditarboton" onclick="editar()"/>
				    <input type="hidden" name="editar_trabajo_campo" value="FormTrabajoCampo"/>
                </td>
		  </tr>
       
	  </table>
</form>
