<?php
//Файлdefault.php это шаблон, который выводит модуль.
// No direct access
defined('_JEXEC') or die; ?>
<?php
echo "Герои <br>"; //переменнаяя hello находится в области видимости mod_helloworld.php
//переменнаяя hello находится в области видимости mod_helloworld.php
if($hello)
{
    $rows = count($hello); // количество полученных строк
    echo "<table><tr><th>№</th><th>Имя</th><th>Роль</th><th>Здоровье</th><th>Мана</th><th>Атака</th><th>Скор. атаки</th><th>Скор. движ.</th><th>Физ. защита</th><th>Маг. защита</th><th>Восст. здоровья</th><th>Восст. маны</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = $hello[$i];
        echo "<tr>";
			echo "<td>$i</td>";
            for ($j = 0 ; $j < 12 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
   $hello=array();
}
?>
