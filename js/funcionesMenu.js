/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    $("#menuGeografia").click(function(){
       $("#menuLateral").load("core/gui/menu_lateral/geografia.php");
    });
});

$(document).ready(function() {
				$("#menuGeografiaPais").click(function(event) {
					$("#contenedorII").load('core/gui/pais/contenedor.php #contenedorII');
				});
			});
//$(function(){
  //  $("#menuGeografiaPais").click(function(){
    //   $("#contenedorII").load('core/gui/pais/contenedor.php');
    //});
//});
function cargar(div, desde)
{
    //$(div).html("<div align=\"center\"><img width='100' height='100' src='js/clock.gif' class='clock' border='0' /></div>");
    //$(div).html("<div class=\"modal fade bs-example-modal-sm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mySmallModalLabel\" aria-hidden=\"true\"> <div class=\"modal-dialog modal-sm\">  <div class=\"modal-content\"> ... </div> </div> </div>");
    //$(div).html("<br><br><br><br><div class=\"progress\"> <div class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"45\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 45%\"> <span class=\"sr-only\">45% Complete</span> </div> </div>");
     
    $(div).load(desde);
}
