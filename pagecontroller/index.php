<?php
error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
$page = (isset($_GET['page']) ? $_GET['page'] : 'index');
$title = 'Главная страница';
?>
<html>
<head>
    <title>On-line курсы GeekStars | <?= $title ?? '' ?></title>
</head>
<body>
<table width="100%">
    <tr>
        <td align="center">
            <table cellpadding="0" cellspacing="0" border="1" width="1024px">
                <tr>
                    <td colspan="2" align="center" height="50">On-line магазин GeekStarts</td>
                </tr>
                <tr valign="top">
                    <td width="150">
                        <table cellspacing="10">
                            <tr><td><a href="index.php?page=index">Главная</a></td></tr>
                            <tr><td><a href="index.php?page=product_info_all">О курсах</a></td></tr>
                        </table>
                    </td>
                    <?php include basename($page).'.php'; ?>
                    <td align="center">
                        <br/>
                        <p>Добро пожаловать в наш интернет-магазин on-line курсов!</p>
                        <p align="left">Большая часть работы программистов связана с написанием исходного кода, тестированием и отладкой программ на одном
                            из языков программирования. Исходные тексты и исполняемые файлы программ являются объектами авторского права и являются
                            интеллектуальной собственностью их авторов и правообладателей.</p>
                        <p align="left">Различные языки программирования поддерживают различные стили программирования (парадигмы программирования). Выбор
                            нужного языка программирования для некоторых частей алгоритма позволяет сократить время написания программы и решить
                            задачу описания алгоритма наиболее эффективно. Разные языки требуют от программиста различного уровня внимания к деталям
                            при реализации алгоритма, результатом чего часто бывает компромисс между простотой и производительностью (или между
                            временем программиста и временем пользователя).</p>
                        <p align="left">Единственный язык, напрямую выполняемый ЭВМ — это машинный язык (также называемый машинным кодом и языком машинных
                            команд). Изначально все программы писались в машинном коде, но сейчас этого практически уже не делается. Вместо этого
                            программисты пишут исходный код на том или ином языке программирования, затем, используя компилятор, транслируют его
                            в один или несколько этапов в машинный код, готовый к исполнению на целевом процессоре, или в промежуточное
                            представление, которое может быть исполнено специальным интерпретатором — виртуальной машиной. Но это справедливо
                            только для языков высокого уровня. Если требуется полный низкоуровневый контроль над системой на уровне машинных
                            команд и отдельных ячеек памяти, программы пишут на языке ассемблера, мнемонические инструкции которого преобразуются
                            один к одному в соответствующие инструкции машинного языка целевого процессора ЭВМ (по этой причине трансляторы с языков
                            ассемблера получаются алгоритмически простейшими трансляторами).</p>
                        <p align="left">В некоторых языках вместо машинного кода генерируется интерпретируемый двоичный код «виртуальной машины», также
                            называемый байт-кодом (byte-code). Такой подход применяется в Forth, некоторых реализациях Lisp, Java, Perl, Python,
                            языках для .NET Framework.</p>
                        <br/>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>