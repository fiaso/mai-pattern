<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $productList = [];
        $protoProduct = new Entity\Product(0, '', 0, '');
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            $product = clone $protoProduct;
            $product->setParams($item['id'], $item['name'], $item['price'], $item['description']);
            $productList[] = $product;
        }

        return $productList;
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        $productList = [];
        $protoProduct = new Entity\Product(0, '', 0, '');
        foreach ($this->getDataFromSource() as $item) {
            $product = clone $protoProduct;
            $product->setParams($item['id'], $item['name'], $item['price'], $item['description']);
            $productList[] = $product;
        }

        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
                'description' => 'PHP — один из самых популярных языков программирования, на основе которого работает большинство сайтов мира. Кроме того, знание PHP чаще всего встречается в требованиях работодателей.',
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
                'description' => 'Python – высокоуровневый язык программирования, который имеет простой и понятный синтаксис и большой набор функций. Python работает почти на всех известных платформах – от карманных компьютеров и смартфонов до серверов сети. Его используют Google, Intel, Cisco и Hewlett-Packard, на нем работают популярные площадки YouTube, Instagram, «ВКонтакте», DropBox. ',
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
                'description' => 'Созданный корпорацией Microsoft объектно-ориентированный язык программирования C# служит идеальным инструментом для написания компонентов и приложений, работающих в среде .NET Framework под управлением ОС Windows.',
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
                'description' => 'Java – самый популярный и востребованный язык программирования. С помощью Java реализованы многие известные веб-проекты: Amazon, eBay, LinkedIn, Yahoo!; написано большинство андроид-приложений, этот язык используют для создания приложений многие банки и корпорации. Среди всех программистов именно разработчики Java пользуются самым большим спросом – их зарплата на 30-40% выше, чем в среднем по рынку труда.',
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
                'description' => 'Ruby — современный объектно-ориентированный язык программирования, сочетающий в себе простоту  разработки, эффективный синтаксис и современные концепции построения приложения.',
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
                'description' => 'Среда визуального программирования Delphi, или RAD (Rapid Application Development - «быстрая разработка приложений») Delphi, была разработана на основе языка Pascal (Паскаль), созданного специально для обучения. В этом языке предусмотрена глубокая детализация и большой «запас прочности» в защиту от неверных шагов.',
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
                'description' => 'C++ широко используется для разработки программного обеспечения, являясь одним из самых популярных языков программирования. Область его применения включает создание операционных систем, разнообразных прикладных программ, драйверов устройств, приложений для встраиваемых систем, высокопроизводительных серверов, а также игр.',
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
                'description' => 'Язык C – проверенный десятилетиями язык для эффективной разработки операционных систем и высокопроизводительных приложений. Он предназначен для функционального программирования – ядра систем, расчетных задач и прочего.',
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
                'description' => 'Lua – известный язык программирования, легкий и простой в освоении, рекомендован для начинающих юных программистов. Многие популярные игры, такие как Angry Birds и World of Warcraft, основаны на Lua.',
            ],
            [
                'id' => 12,
                'name' => 'Rust',
                'price' => 10200,
                'description' => 'Это универсальный язык программирования, разрабатываемый компанией Mozilla, три основных принципа которого: скорость, безопасность и эргономика.  Сами создатели нескромно считают его одним наиболее вероятных наследников C/C++. Согласно опросу портала StackOverflow, именно Rust сегодня наиболее любимый разработчиками язык.',
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
