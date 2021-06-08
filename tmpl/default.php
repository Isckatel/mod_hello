<?php
//Файлdefault.php это шаблон, который выводит модуль.
// No direct access
defined('_JEXEC') or die; ?>
<?php
//переменнаяя hello находится в области видимости mod_helloworld.php
if($hello){
	echo "<b>Фильтр по типам:</b> <a class='filter' data-role='Боец' href='#'>Бойцы</a>
		  <a class='filter' data-role='Стрелок' href='#'>Стрелки</a>
		  <a class='filter' data-role='Убийца' href='#'>Убийцы</a>
		  <a class='filter' data-role='Танк' href='#'>Танки</a>
		  <a class='filter' data-role='Маг' href='#'>Маги</a>
		  <a class='filter' data-role='Поддержка' href='#'>Поддержка</a>";

    $rows = count($hello); // количество полученных строк
	echo "
	<style>
	  a.filter {
		color: #fff; /* цвет текста */
		text-decoration: none; /* убирать подчёркивание у ссылок */
		user-select: none; /* убирать выделение текста */
		background: rgb(212,75,56); /* фон кнопки */
		border-radius: 5px;
		margin-right: 10px;
		padding: .7em 1.5em; /* отступ от текста */
		outline: none; /* убирать контур в Mozilla */
	  }
	  a.filter:hover { background: rgb(232,95,76); } /* при наведении курсора мышки */
	  a.filter:active { background: rgb(152,15,0); } /* при нажатии */


	  .tabheros {
		border: 1px solid #eee;
		//table-layout: fixed;
		width: 100%;
		margin-top: 20px;
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
    echo "<table class='tabheros'>
	<tr><th>№</th><th>Имя</th><th>Роль</th>
	<th><a class='sort' href='#' data-sort='health'>Здоровье</a></th>
	<th><a class='sort' href='#' data-sort='health'>Мана</a></th>
	<th><a class='sort' href='#' data-sort='attack'>Атака</a></th>
	<th><a class='sort' href='#' data-sort='attackSpeed'>Скор. атаки</a></th>
	<th><a class='sort' href='#' data-sort='speed'>Скор. движ.</a></th>
	<th><a class='sort' href='#' data-sort='physicalProtection'>Физ. защита</a></th>
	<th><a class='sort' href='#' data-sort='magicProtection'>Маг. защита</a></th>
	<th><a class='sort' href='#' data-sort='recovery'>Восст. здоровья</a></th>
	<th><a class='sort' href='#' data-sort='recoveryMana'>Восст. маны</a></th></tr>";
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
