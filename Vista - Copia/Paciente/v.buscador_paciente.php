 <form action="index.php" method="post">
		 <table border="0" cellspacing="4" cellpadding="0" class="tabla">
  <tr>
    <td>Buscar por: </td>
    <td><label>
      <select name="Casos">
        <option value="Presuntivo">Presuntivo</option>
        <option value="Confirmados">Confirmados</option>
        <option value="Todos">Todos</option>
      </select>
    </label></td>
    <td>Cantidad de registros: </td>
    <td><label>
      <select name="cantidad">
        <option value="10">10</option>
        <option value="12">12</option>
        <option value="16">16</option>
        <option value="24">24</option>
        <option value="36">36</option>
        <option value="72">72</option>
        <option value="100">100</option>
        <option value="200">200</option>
      </select>
    </label></td>
    <td><label>
      <input type="submit" name="Submit" value="   Buscar   " />
    </label></td>
  </tr>
</table>
</form>