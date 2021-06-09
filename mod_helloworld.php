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
localStorage.setItem('roleFilter', 'Все');
(function($) {

	$('a.filter').on('click', function(event) {
        event.preventDefault();
        var params = $(this).data('role'); // Получаем ID пользователя
        var target = $('.tabheros'); // Устанавливаем контейнер для вывода данных
 //module=helloworld&format=raw&method=getTanks'>Танки
        // Формируем параметры запроса
        var request = {
            'option': 'com_ajax', // Используем AJAX интерфейс
            'module': 'helloworld', // Название модуля без mod_
            'format': 'json', // Формат возвращаемых данных
			'method': 'getRole', //Название метода
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
					localStorage.setItem('roleFilter', params);
                    // Собираем список материалов
					target.empty();
					var result ="<table class='tabheros'><tr><th>№</th><th>Имя</th><th>Роль</th>	<th><a class='sort' href='#' data-sort='health'>Здоровье</a></th><th><a class='sort' href='#' data-sort='health'>Мана</a></th><th><a class='sort' href='#' data-sort='attack'>Атака</a></th><th><a class='sort' href='#' data-sort='attackSpeed'>Скор. атаки</a></th><th><a class='sort' href='#' data-sort='speed'>Скор. движ.</a></th><th><a class='sort' href='#' data-sort='physicalProtection'>Физ. защита</a></th><th><a class='sort' href='#' data-sort='magicProtection'>Маг. защита</a></th><th><a class='sort' href='#' data-sort='recovery'>Восст. здоровья</a></th><th><a class='sort' href='#' data-sort='recoveryMana'>Восст. маны</a></th></tr>"
					$.each (response.data, function(index, value) {
						result += '<tr> <td>' + (index + 1) + '</td>'
						+'<td><a href="http://heroml/index.php/geroj?hero=' + value.name +'">' + value.name + '</a></td>'
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

	$('.tabheros').delegate('a.sort','click', function(event) {
        event.preventDefault();
        var params = localStorage.getItem('roleFilter'); // Получаем роль
		let sort = $(this).data('sort'); // Получаем поле для сортировки
        var target = $('.tabheros'); // Устанавливаем контейнер для вывода данных

        // Формируем параметры запроса
        var request = {
            'option': 'com_ajax', // Используем AJAX интерфейс
            'module': 'helloworld', // Название модуля без mod_
            'format': 'json', // Формат возвращаемых данных
			'method': 'getSort', //Название метода
            'params': params, // ID пользователя
			'sort': sort, // ID пользователя
        };

        // Посылаем AJAX запрос
        $.ajax({
            type: 'POST',
            data: request,
        })
            .done(function(response) {
                // Есть успешный ответ сервера и данные
                if (response.success && response.data) {
					localStorage.setItem('roleFilter', params);
                    // Собираем список материалов
					target.empty();
					var result ="<table class='tabheros'><tr><th>№</th><th>Имя</th><th>Роль</th>	<th><a class='sort' href='#' data-sort='health'>Здоровье</a></th><th><a class='sort' href='#' data-sort='health'>Мана</a></th><th><a class='sort' href='#' data-sort='attack'>Атака</a></th><th><a class='sort' href='#' data-sort='attackSpeed'>Скор. атаки</a></th><th><a class='sort' href='#' data-sort='speed'>Скор. движ.</a></th><th><a class='sort' href='#' data-sort='physicalProtection'>Физ. защита</a></th><th><a class='sort' href='#' data-sort='magicProtection'>Маг. защита</a></th><th><a class='sort' href='#' data-sort='recovery'>Восст. здоровья</a></th><th><a class='sort' href='#' data-sort='recoveryMana'>Восст. маны</a></th></tr>"
					$.each (response.data, function(index, value) {
						result += '<tr> <td>' + (index + 1) + '</td>'
						+'<td><a href="http://heroml/index.php/geroj?hero=' + value.name +'">' + value.name + '</a></td>'
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
