<?php

/*
#############################################################################
#  Filename: player_premium_ru.mo.php
#  Project: SuperNova.WS
#  Website: http://www.supernova.ws
#  Description: Massive Multiplayer Online Browser Space Strategy Game
#
#  Copyright © 2012-2018 Gorlum for Project "SuperNova.WS"
#############################################################################
*/

/**
*
* @package language
* @system [Russian]
* @version 45d0
*
*/

/**
* DO NOT CHANGE
*/

if (!defined('INSIDE')) die();

//$lang = array_merge($lang,
//$lang->merge(
$a_lang_array = (array(
  'chat_advanced_chat_players' => 'Игроки в чате',
  'chat_advanced_online_players' => 'Игроков в чате',
  'chat_advanced_online_invisibles' => 'В том числе невидимых',
  'chat_advanced_invisibility' => 'Невидимость',

  'chat_advanced_frame_on' => 'Прикрепить',
  'chat_advanced_frame_off' => 'Открепить',

  'chat_advanced_smile_tooltip' => 'Кликните, что бы выбрать смайлик',

  'chat_advanced_visible' => array(
    0 => 'Вы видимы другим игрокам',
    1 => 'Вы невидимы другим игрокам',
  ),

  'chat_advanced_help_description' => "Используйте синтаксис \"/help <команда>\", что бы получить дополнительную информацию об определенной команде. Например, \"/help whisper\"",
  'chat_advanced_help_commands_accessible' => 'Вам доступны следующие команды чата:',
  'chat_advanced_help_command' => 'Команда "/%s"',
  'chat_advanced_help_command_aliases' => 'Псевдонимы данной команды: ',

  'chat_advanced_whisper_recipient_prefix' => '',
  'chat_advanced_whisper_recipient_midfix' => ' -> ',
  'chat_advanced_whisper_recipient_suffix' => '> ',
  'chat_advanced_whisper_sender_prefix' => '',
  'chat_advanced_whisper_sender_midfix' => ' -> ',
  'chat_advanced_whisper_sender_suffix' => '> ',

  'chat_advanced_command_reason' => '. Причина: %s',
  'chat_advanced_command_reason2' => 'Причина:',
  'chat_advanced_command_mute' => 'Игрок "%1$s" лишен права писать в чат до %2$s по серверному времени%3$s',
  'chat_advanced_command_unmute' => 'Игрок "%s" снова может писать в чат',
  'chat_advanced_command_ban' => 'Игрок "%1$s" заблокирован с режимом отпуска до %2$s по серверному времени',
  'chat_advanced_command_ban_no_vacancy' => 'Игрок "%1$s" заблокирован БЕЗ РЕЖИМА ОТПУСКА до %2$s по серверному времени',
  'chat_advanced_command_unban' => 'Игрок "%s" разблокирован',

  'chat_advanced_command_interval' => array(
    '1h' => '1 час',
    '3h' => '3 часа',
    '6h' => '6 часов',
    '12h' => '12 часов',
    '1d' => '1 сутки',
    '3d' => '3 суток',
    '1w' => '1 неделя',
    '2w' => '2 недели',
    '1m' => '30 суток',
    '2m' => '60 суток',
    '3m' => '90 суток',
    '10y' => 'Навсегда*',
  ),
  'chat_advanced_ban_vacancy' => 'Режим отпуска',

  'chat_advanced_online_ban' => 'Заблокировать игрока "%1$s" на...',
  'chat_advanced_online_mute' => 'Запретить игроку "%1$s" писать в чат на...',
  'chat_advanced_online_unmute' => 'Разрешить игроку "%1$s" писать в чат',
  'chat_advanced_online_invisible' => 'Невидимый игрок',
  'chat_advanced_online_banned_via_chat' => 'Заблокирован из чата',

  'chat_advanced_help' => array(
    'help' => "Команда '/help' позволяет получить подробную помощь по всем доступным вам командам чата\r\n
               Формат команды: /help [<имя команды>]\r\n
               <Имя команды> является необязательным параметром. Без него будет распечатан список доступных команд. Вместо имени команды можно использовать её псевдоним, например '/help w' выместо '/help whisper'",
    'whisper' => "Команда '/whisper' позволяет отправить приватное сообщение определенному игроку. Приватное сообщение появляется во всех видах чата - общем и Альянсовском - и видно
                  только вам и игроку, которому оно предназначено. Клик мышкой на имени в списке игроков онлайн добавит в строку сообщения соответствующую команду - вам останется только
                  набрать сообщение и отправить его\r\nПриватные сообщения можно посылать невидимым игрокам, игрокам, отсуствующим в чате и игрокам оффлайн. В двух последних случаях они увидят ваши сообщения в своей истории\r\n
                  Формат команды: /whisper <имя игрока> <сообщение>\r\n
                  Если имя игрока содержит пробел, апостроф, прямой или обратный слеш - возьмите имя игрока в двойные ковычки. Например, так:\r\n
                  /w \"имя с пробелом\" Привет!",
    'ban' => "Команда '/ban' блокирует игроку доступ в игру на указанное время. Соответствующая иконка в списке игроков онлайн блокирует игрока на 1 неделю\r\n
              Формат команды: /ban id <ИД игрока> <срок блокировки>[!] [<причина блокировки>]\r\n
              ИД игрока можно узнать, наведясь на его ник в списке игроков онлайн\r\n
              <Срок блокировки> имеет вид: <число>{y|m|w|d|h}, где h указывает срок блокировки в часах, d - в днях, w - в неделях, m - в месяцах, y - в годах\r\n
              Если после срока блокировки поставить восклицательный знак, то пользователь будет заблокирован без режима отпуска\r\n
              <Причина блокировки> - не обязательный параметр. Если указана - будет добавлена в сообщение в чате и в таблицу блокировок",
    'unban' => "Команда '/unban' позволяет разблокировать ранее заблокированного игрока\r\n
                Формат команды: /unban id <ИД игрока>",
    'mute'  => "Команда '/mute' запрещает игроку писать в чат. Запрет касается всех каналов и так же рапространяется на приватные сообщения чата. Соответствующая иконка в списке игроков онлайн запрещает игроку писать в чат на 1 час\r\n
                Формат команды: /mute id <ИД игрока> <длительность запрета> [<причина запрета>]\r\n
                ИД игрока можно узнать, наведясь на его ник в списке игроков онлайн\r\n
                <Длительность запрета> имеет вид: <число>{y|m|w|d|h}, где h указывает длительность в часах, d - в днях, w - в неделях, m - в месяцах, y - в годах\r\n
                <Причина запрета> - не обязательный параметр. Если указана - будет добавлена в сообщение в чате",
    'unmute' =>  "Команда '/unmute' позволяет вернуть право писать в чат игроку, который раньше был лишен этого права\r\n
                  Формат команды: /unmute id <ИД игрока>\r\n
                  ИД игрока можно узнать, наведясь на его ник в списке игроков онлайн",
    'invisible' => "Команда '/invisible' позволяет сделать вас невидимым для других игроков в чате. Переключение галочки \"Невидимость\" дает такой же эффект.\r\n
                    Невидимость является глобальной - т.е. распространяется и на общий чат, и на чат Альянса\r\n
                    Формат команды: /invisible [on|off]\r\n
                    /invisible on - Делает вас невидимым для других игроков в чате\r\n
                    /invisible off - Делает вас видимым для других игроков в чате\r\n
                    /invisible - Показывает ваш статус невидимости",
  ),

  'chat_advanced_help_short' => array(
    'help' => '/help',
    'whisper' => '/whisper',
    'ban' => '/ban',
    'unban' => '/unban',
    'mute' => '/mute',
    'unmute' => '/unmute',
    'invisible' => '/invisible',
  ),



  'chat_advanced_err_command_inacessible' => 'Эта команда чата вам недоступна. Используйте "/help", что бы увидеть список всех доступных вам команд',
  'chat_advanced_err_command_unknown' => 'Неизвестная команда',
  'chat_advanced_err_player_name_unknown' => 'Не существует игрока с таким именем',
  'chat_advanced_err_message_empty' => 'Пустое сообщение не будет отправлено',
  'chat_advanced_err_message_player_empty' => 'Укажите имя игрока, которому вы хотите отправить сообщение в чате',
  'chat_advanced_err_player_id_need' => 'Для этой команды нужно имя игрока',
  'chat_advanced_err_player_id_incorrect' => 'Неправильный идентификатор',
  'chat_advanced_err_player_id_unknown' => 'Не существует игрока с таким ИД',
  'chat_advanced_err_player_same' => 'Нельзя выполнить эту команду на самом себе',
  'chat_advanced_err_player_higher' => 'Нельзя выполнить эту команду на игроке с большим или равным уровнем доступа',
  'chat_advanced_err_term_need' => 'Для этой команды нужен срок действия',
  'chat_advanced_err_term_wrong' => 'Указан неправильный срок действия команды',
));
