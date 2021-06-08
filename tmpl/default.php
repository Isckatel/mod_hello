<?php
//Файлdefault.php это шаблон, который выводит модуль.
// No direct access
defined('_JEXEC') or die; ?>
<?php
//переменнаяя hello находится в области видимости mod_helloworld.php
if($hello)
	echo "<a class='tanks' data-role='Танки' href='#'>Танки</a>
		  <a class='filter' data-role='Боец' href='#'>Бойцы</a>";
{	//echo "<a class='tanks' href='http://heroml/index.php/geroi?option=com_ajax&module=helloworld&format=raw&method=getTanks'>Танки</a>";
    $rows = count($hello); // количество полученных строк
	echo "
	<style>
	  .tabheros {
		border: 1px solid #eee;
		//table-layout: fixed;
		width: 100%;
		margin-bottom: 20px;
	  }
	  .tabheros th {
		font-weight: bold;
		padding: 5px;
		background: #efefef;
		border: 1px solid #dddddd;
	  }
	  .tabheros td {
		padding: 5px 10px;
		border: 1px solid #eee;
		text-align: left;
	  }
	  .tabheros tr:nth-child(odd){
		background: #F7F7F7;
	  }
	  .tabheros tr:nth-child(even){
		background: #fff;
	  }

	</style>
	";
    echo "<table class='tabheros'><tr><th>№</th><th>Имя</th><th>Роль</th><th>Здоровье</th><th>Мана</th><th>Атака</th><th>Скор. атаки</th><th>Скор. движ.</th><th>Физ. защита</th><th>Маг. защита</th><th>Восст. здоровья</th><th>Восст. маны</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = $hello[$i];
		$n = count($row);
		$np = $i + 1;
        echo "<tr>";
			echo "<td>$np</td>";
            for ($j = 0 ; $j < $n ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
   $hello=array();
}
?>
