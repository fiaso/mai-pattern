<?php
error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
$page = (isset($_GET['page']) ? $_GET['page'] : 'index');
$title = 'Описание курсов';
$productList = [
    [
        'id' => 1,
        'name' => 'PHP',
        'description' => 'PHP — один из самых популярных языков программирования, на основе которого работает большинство сайтов мира. Кроме того, знание PHP чаще всего встречается в требованиях работодателей.',
    ],
    [
        'id' => 2,
        'name' => 'Python',
        'description' => 'Python – высокоуровневый язык программирования, который имеет простой и понятный синтаксис и большой набор функций. Python работает почти на всех известных платформах – от карманных компьютеров и смартфонов до серверов сети. Его используют Google, Intel, Cisco и Hewlett-Packard, на нем работают популярные площадки YouTube, Instagram, «ВКонтакте», DropBox. ',
    ],
    [
        'id' => 3,
        'name' => 'C#',
        'description' => 'Созданный корпорацией Microsoft объектно-ориентированный язык программирования C# служит идеальным инструментом для написания компонентов и приложений, работающих в среде .NET Framework под управлением ОС Windows.',
    ],
    [
        'id' => 4,
        'name' => 'Java',
        'description' => 'Java – самый популярный и востребованный язык программирования. С помощью Java реализованы многие известные веб-проекты: Amazon, eBay, LinkedIn, Yahoo!; написано большинство андроид-приложений, этот язык используют для создания приложений многие банки и корпорации. Среди всех программистов именно разработчики Java пользуются самым большим спросом – их зарплата на 30-40% выше, чем в среднем по рынку труда.',
    ],
    [
        'id' => 5,
        'name' => 'Ruby',
        'description' => 'Ruby — современный объектно-ориентированный язык программирования, сочетающий в себе простоту  разработки, эффективный синтаксис и современные концепции построения приложения.',
    ],
    [
        'id' => 8,
        'name' => 'Delphi',
        'description' => 'Среда визуального программирования Delphi, или RAD (Rapid Application Development - «быстрая разработка приложений») Delphi, была разработана на основе языка Pascal (Паскаль), созданного специально для обучения. В этом языке предусмотрена глубокая детализация и большой «запас прочности» в защиту от неверных шагов.',
    ],
    [
        'id' => 9,
        'name' => 'C++',
        'description' => 'C++ широко используется для разработки программного обеспечения, являясь одним из самых популярных языков программирования. Область его применения включает создание операционных систем, разнообразных прикладных программ, драйверов устройств, приложений для встраиваемых систем, высокопроизводительных серверов, а также игр.',
    ],
    [
        'id' => 10,
        'name' => 'C',
        'description' => 'Язык C – проверенный десятилетиями язык для эффективной разработки операционных систем и высокопроизводительных приложений. Он предназначен для функционального программирования – ядра систем, расчетных задач и прочего.',
    ],
    [
        'id' => 11,
        'name' => 'Lua',
        'description' => 'Lua – известный язык программирования, легкий и простой в освоении, рекомендован для начинающих юных программистов. Многие популярные игры, такие как Angry Birds и World of Warcraft, основаны на Lua.',
    ],
    [
        'id' => 12,
        'name' => 'Rust',
        'description' => 'Это универсальный язык программирования, разрабатываемый компанией Mozilla, три основных принципа которого: скорость, безопасность и эргономика.  Сами создатели нескромно считают его одним наиболее вероятных наследников C/C++. Согласно опросу портала StackOverflow, именно Rust сегодня наиболее любимый разработчиками язык.',
    ],
];
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
                            <tr><td><a href="product_info_all.php?page=index">Главная</a></td></tr>
                            <tr><td><a href="product_info_all.php?page=product_info_all">О курсах</a></td></tr>
                        </table>
                    </td>
                    <?php include basename($page).'.php'; ?>
                    <td align="center">
                        <br/>
                        <?php
                        foreach ($productList as $key => $product) {
                            echo $product['name'] . '<br/><br/>' .
                                $product['description'] . '<br/><br/>';
                        }
                        ?>
                        <br/>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>