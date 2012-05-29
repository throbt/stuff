<?php //print_r($this->var['data']); die();
  $host   = 'defaulter.dyndns.hu';
  $image  = 'http://'.$host."/upload/{$this->var['data'][0]['gallery']}/{$this->var['data'][0]['name']}";
  $body   = $this->var['data'][0]['body'];
  
?>
<html>
<head>
  <title>Mannalounge hírlevél</title>
</head>
<body>
<table align="center" width="600" cellspacing="0" bgcolor="#dbdbd9" cellpadding="0" border="0" style="border-width:0;border-collapse:collapse">
  <tbody>
    <tr>

    <td width="600">
      <table width="600" cellspacing="0" cellpadding="0" border="0" style="border-width:0;border-collapse:collapse">
        <tbody>
          <tr>
            <td width="600" height="54" background="<?php echo 'http://'.$host.'/upload/19/be7445200648022cdc29ab94248a1488.png'; ?>">

              <table width="185" height="53" cellspacing="0" cellpadding="0" border="0" style="border-width:0;border-collapse:collapse">
                <tr>
                  <td width="14" height="53">
                  </td>
                  <td width="171" height="53">

                    <table width="171" height="53" cellspacing="0" cellpadding="0" border="0" style="border-width:0;border-collapse:collapse">

                      <tr>
                        <td width="171" height="16">
                        </td>
                        <td width="171" height="19">
                          <a target="_blank" href="http://mannalounge.com">
                            <img width="171" height="19" style="border-style:none" src="<?php echo 'http://'.$host.'/upload/19/6fc2aa2fc3ae4f0b458e505be5e8df71.png'; ?>">
                          </a>
                        </td>
                      </tr>

                    </table>

                  </td>
                </tr>
              </table>

            </td>
          </tr>
          <tr>
            <td width="600" bgcolor="">
              <img width="600" style="border-style:none" src="<?php echo $image; ?>">
            </td>
          </tr>
          <tr>
            <td width="600" bgcolor="">

              <table align="center" width="600" cellspacing="0" cellpadding="0" border="0" style="border-width:0;border-collapse:collapse">
                <tbody>

                  <tr>
                    <td width="600" height="20" bgcolor="">
                    </td>
                  </tr>

                  <tr>
                    <td width="10%" bgcolor="" height="100%">
                    </td>

                    <td width="80%" bgcolor="" height="100%">

                      <?php echo $body; ?>

                    </td>

                    <td width="10%" bgcolor="" height="100%">
                    </td>
                  </tr>

                  <tr>
                    <td width="600" height="20" bgcolor="">
                    </td>
                  </tr>

              </table>

              

            </td>
          </tr>
          <tr>  
            <td width="600" height="114" bgcolor="" background="<?php echo 'http://'.$host.'/upload/19/ee4f930509e0dc17330508a1b4064007.png'; ?>">
                
                <table width="600" height="84" cellspacing="0" cellpadding="0" border="0" style="border-width:0;border-collapse:collapse">
                  <tbody>
                    

            <td width="351" height="114" bgcolor="">
            </td>
            <td width="213" height="114" bgcolor="">
              <table>
                <tbody>
                  <tr>
                    <td width="213" height="59">
                    </td>
                  </tr>
                  <tr>
                    <td width="213" height="25" background="">


                      <a target="_blank" href="http://www.facebook.com/pages/Manna-%C3%89tterem/176210038779">
                        <img width="213" height="25" style="border-style:none" src="<?php echo 'http://'.$host.'/upload/19/d661bfffae220769f28c8839a5605c82.png'; ?>">
                      </a>

                    </td>
                  </tr>
                <tbody>
              </table>
            </td>


                  </tbody>
                </table>

            </td>
          </tr>
        </tbody>
      </table>
    </td>
  </tbody>
</table>
</body>
</html>
