<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
      <tbody>
        <tr>
          <td style="vertical-align: top; padding-bottom:30px;" align="center">
            <a href="http://contech.cl" target="_blank">
            <img height="100px" src="https://contech.cl/frontend/imagen/logo.png"  style="border:none"></a>
            <br/>
          </td>
        </tr>
      </tbody>
    </table>
    <div style="padding: 40px; background: #fff;">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
          <tr>
            <td><b>Estimado(a) {{$send_name}}</b><br>
              <p>Ha recibo un nuevo correo mediante CONTECH WEB por su inscripción. Le damos la cordial bienvenida y le damos a conoces su nuevo usuario y contraseña.</p>
              <hr>
              <p><b>Nombre:</b>     {{$send_name}}</p>
              <p><b>Usuario:</b>    {{$send_email}}</p>
              <p><b>Contraseña:</b> {{$send_password}}</p>
              
              <p><small>Si en algun momento pierdes tu contraseña o tienes problema con el inicio de sesión, ponte en contacto al correo contech@cotech.cl</small></p>
              <p>Muchas Gracias.</p> </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
      <p><a href="https://www.contech.cl" target="_blank">CONTECH</a><br>        
    </div>
  </div>
</div>
</body>
</html>
