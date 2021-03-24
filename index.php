<!DOCTYPE html>
<html>
<head>
  <title>UTS</title>
  <style type="text/css">
    form {
      background: -webkit-linear-gradient(bottom, #CCCCCC, #EEEEEE 175px);
      background: -moz-linear-gradient(bottom, #CCCCCC, #EEEEEE 175px);
      background: linear-gradient(bottom, #CCCCCC, #EEEEEE 175px);
      margin: auto;
      position: relative;
      width: 550px;
      height: 450px;
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 14px;
      font-style: italic;
      line-height: 24px;
      font-weight: bold;
      color: #09C;
      text-decoration: none;
      border-radius: 10px;
      padding: 10px;
      border: 1px solid #999;
      border: inset 1px solid #333;
      -webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
      -moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
      box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
    }

    input,select {
      width: 375px;
      display: block;
      border: 1px solid #999;
      height: 25px;
      -webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
      -moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
      box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
    }

    input[type="submit"] {
      width: 100px;
      position: absolute;
      right: 20px;
      bottom: 20px;
      background: #09C;
      color: #fff;
      font-family: Tahoma, Geneva, sans-serif;
      height: 30px;
      border-radius: 15px;
      border: 1p solid #999;
    }

    input.submit:hover {
      background: #fff;
      color: #09C;
    }
  </style>
</head>
<body>  
    <form action="index.php" method="post">
    <div>
      <h1>Aplikasi Pemantauan COVID 19</h1>
      <label>
        <span>Wilayah</span>
        <select name="wilayah">
          <option>Pilih Wilayah</option>
          <option value="DKI Jakarta">DKI Jakarta</option>
          <option value="Jawa Barat">Jawa Barat</option>
          <option value="Banten">Banten</option>
          <option value="Jawa Tengah">Jawa Tengah</option>
        </select>
      </label>

      <label>
        <span>Jumlah Positif</span>
        <input type="text" name="jmlpositif">
      </label>
      <label>
        <span>Jumlah Dirawat</span>
        <input type="text" name="jmldirawat">
      </label>

      <label>
        <span>Jumlah Sembuh</span>
        <input type="text" name="jmlsembuh">
      </label>

      <label>
        <span>Jumlah Meninggal</span>
        <input type="text" name="jmlmeninggal">
      </label>

      <label>
        <span>Nama Operator</span>
        <input type="text" name="nmoperator">
      </label>
      
      <label>
        <span>NIM</span>
        <input type="text" name="nim_mahasiswa">
      </label>
        
      <label>         
        <input type="submit" name="tambah">
      </label>  
  </div>
  </form>

  <?php
    $nm_wilayah = $_POST['wilayah'];
    $jml_positif = $_POST['jmlpositif'];
    $jml_dirawat = $_POST['jmldirawat'];
    $jml_sembuh = $_POST['jmlsembuh'];
    $jml_meninggal = $_POST['jmlmeninggal'];
    $operator = $_POST['nmoperator'];
    $nim_mhs = $_POST['nim_mahasiswa']; 


    $data = "\n$nm_wilayah|$jml_positif|$jml_dirawat|$jml_sembuh|$jml_meninggal|$operator|$nim_mhs";

    $fh = fopen("datapasien.txt", "w");
    fwrite($fh, $data);

    fclose($fh);
    ?>

    <div style="text-align: center;">
      <center>
        <table border="1" align="center">
          <tr>
            <th>Positif</th>
            <th>Dirawat</th>
            <th>Sembuh</th>
            <th>Meninggal</th>  
          </tr>

    <?php

              $txt_file = file_get_contents("datapasien.txt");
              $rows = explode("\n", $txt_file);
              array_shift($rows);
              $i=1;

              foreach ($rows as $row => $data) {
                $row_data = explode('|', $data);

                $info[$row]['wilayah'] = $row_data[0];
                $info[$row]['jmlpositif'] = $row_data[1];
                $info[$row]['jmldirawat'] = $row_data[2];
                $info[$row]['jmlsembuh'] = $row_data[3];
                $info[$row]['jmlmeninggal'] = $row_data[4];
                $info[$row]['nmoperator'] = $row_data[5];
                $info[$row]['nim_mahasiswa'] = $row_data[6];

                echo "Data Pemantauan Covid19 Wilayah ";
                echo $info[$row]['wilayah'];
                echo "<br>Per"; 
                              echo date(' d-F-Y ');
                              echo date(' h:i:s A ');                            
                              echo "<br>".$info[$row]['nmoperator'];
                              echo "/";
                              echo "<br>".$info[$row]['nim_mahasiswa'];
                              
              echo "<tr>";
                  echo ' <td>'.$info[$row]['jmlpositif'];
                  echo ' <td>'. $info[$row]['jmldirawat'];
                  echo ' <td>' . $info[$row]['jmlsembuh'];
                  echo ' <td>'. $info[$row]['jmlmeninggal'];
                  echo "</tr>";
              }

           ?>
        </table>
      </center>
    </div>
</body>
</html>

