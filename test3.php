
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body><form method="post">
            <label for="selectOption">Избери брой:</label><br>
            <table>
                <tr><td>Артикул</td><td>Брой</td><td>Ед.цена</td><td>Общо</td></tr>
                    
        <?php
        $chartarray=array(1=>array('title'=>"app1",'code'=>1,'price'=>12),2=>array('title'=>"app2",'code'=>2,'price'=>11));
        $total=0;
        for ($i=1;$i<=count($chartarray);$i++)
        {
            echo "<tr><td>".$chartarray[$i]['title']."</td><td>";
            echo "<select id=".$chartarray[$i]['title']." name=".$chartarray[$i]['title']." onchange='MyFunc(this)' >
		<option value='1'";if(isset($_POST[$chartarray[$i]['title']]) && $_POST[$chartarray[$i]['title']] == 1) echo 'selected';echo">1</option>
		<option value='2'";if(isset($_POST[$chartarray[$i]['title']]) && $_POST[$chartarray[$i]['title']] == 2) echo 'selected'; echo"> 2</option>
		<option value='3'";if(isset($_POST[$chartarray[$i]['title']]) && $_POST[$chartarray[$i]['title']] == 3) echo 'selected'; echo"> 3</option>
        <option value='4'";if(isset($_POST[$chartarray[$i]['title']]) && $_POST[$chartarray[$i]['title']] == 4) echo 'selected'; echo"> 4</option>
        <option value='5'";if(isset($_POST[$chartarray[$i]['title']]) && $_POST[$chartarray[$i]['title']] == 5) echo 'selected'; echo"> 5</option>";
            echo "</select>";
            echo "<input type='hidden' id='price' value='".$chartarray[$i]['price']."'>";
            echo "</td><td>".$chartarray[$i]['price']."</td><td class='result'>";
            if(isset($_POST[$chartarray[$i]['title']])) {
                $option = $_POST[$chartarray[$i]['title']];
                $result = $chartarray[$i]['price'] * $option;
                echo $result;
                $total+=$result;
            }
            echo "</td></tr>";
        }
        ?>
            </table><br>
            <input type="submit" name="submit" value="Купи">
        </form>
        <p>Обща сума:
        <?php
        echo $total;
        ?>
        </p>
     
 <script type="text/javascript">
        
        function MyFunc(obj) {
  var price = obj.parentNode.parentNode.querySelector('input[type="hidden"]').value;
  var option = obj.value;
  var result = price * option;
  obj.parentNode.parentNode.querySelector('.result').innerHTML = result;
}

            </script>
    </body>
</html>
