<?php
/**
 * Hello World! Module Entry Point
 *
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 * @link       http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
//проверяет, чтобы этот файл включался через приложение Joomla (безопасность)
defined('_JEXEC') or die;
// Include the syndicate functions only once
//Вспомогательный класс(получает данные из БД)
require_once dirname(__FILE__) . '/helper.php';

//вызывается Метод вспомогательного класса
$hello = modHelloWorldHelper::getHello($params);
require JModuleHelper::getLayoutPath('mod_helloworld');
?>
<script>
(function($) {
    $('a.tanks').on('click', function(event) {
        event.preventDefault();
        var params = 'Танк'; // Получаем ID пользователя
        var target = $('.tabheros'); // Устанавливаем контейнер для вывода данных
 //module=helloworld&format=raw&method=getTanks'>Танки
        // Формируем параметры запроса
        var request = {
            'option': 'com_ajax', // Используем AJAX интерфейс
            'module': 'helloworld', // Название модуля без mod_
            'format': 'json', // Формат возвращаемых данных
            'params': params // ID пользователя
        };

        // Посылаем AJAX запрос
        $.ajax({
            type: 'POST',
            data: request,
        })
            .done(function(response) {
                // Есть успешный ответ сервера и данные
                if (response.success && response.data) {
                    // Собираем список материалов
					target.empty();

					var result ='<tr><th>№</th><th>Имя</th><th>Роль</th><th>Здоровье</th><th>Мана</th><th>Атака</th><th>Скор. атаки</th><th>Скор. движ.</th><th>Физ. защита</th><th>Маг. защита</th><th>Восст. здоровья</th><th>Восст. маны</th></tr>'
					$.each (response.data, function(index, value) {
						result += '<tr> <td>' + (index + 1) + '</td>'
						+'<td>' + value.name + '</td>'
						+'<td>' + value.role + '</td>'
						+'<td>'+ value.health+'</td>'
						+'<td>'+ value.mana+'</td>'
						+'<td>'+ value.attack+'</td>'
						+'<td>'+ value.attackSpeed+'</td>'
						+'<td>'+ value.speed+'</td>'
						+'<td>'+ value.physicalProtection+'</td>'
						+'<td>'+ value.magicProtection+'</td>'
						+'<td>'+ value.recovery+'</td>'
						+'<td>'+ value.recoveryMana+'</td>'
						+'</tr>';
                    });

					target.html(result);
                    /*var result = '<ul>';
                    $.each (response.data, function(index, value) {
                        result += '<li>' + value.title + '</li>';
                    });
                    result += '</ul>';

                    // Заполняем контейнер списком материалов
                    target.html(result).fadeIn(); */
                }

                // Есть успешный ответ сервера, но нет данных.
                if (response.success && !response.data) {
                    target.html('<?php echo JText::_('Нет данных'); ?>').addClass('text-error').fadeIn();
                }

                // Есть неуспешный ответ сервера и текст ошибки
                if (!response.success && response.message) {
                    target.html(response.message).addClass('text-error').fadeIn();
                }

            })
            .fail(function() {
                target.html('<?php echo JText::_('Произошла ошибка в процессе запроса.'); ?>').addClass('text-error').fadeIn();

                // Скрываем контейнер через 3 секунды
                setTimeout(function() {
                    target.fadeOut();
                }, 3000);
            });
    });
})(jQuery);
</script>
