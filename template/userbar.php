<?PHP if(isset($_SESSION['user_marcado'])){ ?>
<div class="cl_uno">
  <div class="cl_cont_uno cl_bg">
    <div class="cl">
      <h3><?PHP echo $_SESSION['usuario_nombre']; ?></h3>
      <a href='inicio.php'>Mi Perfil</a> 
      <br />
      <a href='logout.php'><span>Salir</span></a>
      </div>
  </div>
</div>
<?PHP }else{ ?>
<div class="cl_uno">
  <div class="cl_cont_uno cl_bg">
    <div class="cl">
      <h3>JUGADORES</h3>
      <div><strong>Ingresar</strong>
        <form action="ValidarLogin.php" name="frm_ingreso" id="frm_ingreso" method="post" enctype="multipart/form-data">
          Cuenta de Email<br />
          <input name="usuario" id="usuario" type="text" value="" onkeypress="if(event.keyCode==13) {javascript:ingresar_sistema();}"/>
          <div class="clear"></div>
          Clave<br />
          <input name="clave" id="=&quot;clave&quot;" type="password" value="" onkeypress="if(event.keyCode==13) {javascript:ingresar_sistema();}"/>
          </td>
          <div class="clear"></div>
          <!--<a href="recordar.php">Olvid&eacute; mi Contrase&ntilde;a</a> <br />-->
          <a href="registrarse.php">Registrarse</a>
          <div class="clear"></div>
          <input type="button" name="ingresar" id="ingresar" value=" Tirar Dados " onClick="javascript:ingresar_sistema();"/>
        </form>
      </div>
    </div>
  </div>
</div>
<?PHP } ?>
