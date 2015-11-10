<form class="" action="sinal_confirmaCad.php" method="post">
  Titulo:<input type="text" name="titulo"><br>
  Categoria:<select name="categoria">
  <option value="OB" selected>Obras</option>
  <option value="IT">Interditado</option>
  <option value="AC">Acidentado</option>
  <option value="OT">Outros</option>
  </select><br>
  Descrição:<textarea name="descricao">
  </textarea><br>
  Longitude<input type="number" name="longitude"><br>
  Latitude:<input type="number" name="latitude"><br>
  Data de publicação:<input type="date" name="data_public">
  <input type="submit" value="Cadastrar sinal"><br>
</form>
