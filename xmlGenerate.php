<?php
class xmlGenerate
{
    protected $dom;

    public function __construct()
    {
      $this->dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8

    }

    public function ymlCreate($yml_array = array())
    {

        $yml = $this->dom->createElement('yml_catalog'); // создаем yml каталог
        $yml->setAttribute('date', date('Y-m-d h:m'));
        $this->dom->appendChild($yml);

        $shop = $this->dom->createElement('shop'); // создаем магазин
        $yml->appendChild($shop);

        foreach ($yml_array as $first_lvl) // собераем данные 1 уровня вложенности из полученного массива
        {
            $teg = $this->dom->createElement($first_lvl['name'], $first_lvl['text']); // создаем тэг
            $shop->appendChild($teg);

            if($first_lvl['attributes'] !== null && is_array($first_lvl['attributes'])) // если атрибуты есть записываем
            {
                foreach ($first_lvl['attributes'] as $atr_key => $atr_value)
                {
                    $teg->setAttribute($atr_key, $atr_value);
                }
            }

            if($first_lvl['inserted'] !== null && is_array($first_lvl['inserted'])) // если есть вложенные тэги то создаем
            {
                foreach ($first_lvl['inserted'] as $second_lvl)
                {
                    $teg_second = $this->dom->createElement($second_lvl['name'], $second_lvl['text']);
                    $teg->appendChild($teg_second);

                    if($second_lvl['attributes'] !== null && is_array($second_lvl['attributes'])) // добовляем атрибуты 2 уровню тэгам
                    {
                        foreach ($second_lvl['attributes'] as $atr)
                        {
                            $teg_second->setAttribute($atr['name'], $atr['value']);
                        }
                    }

                    if($second_lvl['inserted'] !== null && is_array($second_lvl['inserted'])) // проверяем есть ли 3 уровень вложенности
                    {
                        foreach ($second_lvl['inserted'] as $third_lvl)
                        {
                            $teg_third = $this->dom->createElement($third_lvl['name'], $third_lvl['text']);
                            $teg_second->appendChild($teg_third);

                            if($third_lvl['attributes'] !== null && is_array($third_lvl['attributes'])) // задаем атрибуты 3 уровню
                            {
                                foreach ($third_lvl['attributes'] as $atr)
                                {
                                    $teg_third->setAttribute($atr['name'], $atr['value']);
                                }
                            }

                            if($third_lvl['inserted'] !== null && is_array($third_lvl['inserted'])) // проверяем есть ли 4 уровень вложенности
                            {
                                foreach ($third_lvl['inserted'] as $four_lvl)
                                {
                                    $teg_four = $this->dom->createElement($four_lvl['name'], $four_lvl['text']);
                                    $teg_third->appendChild($teg_four);

                                    if($four_lvl['attributes'] !== null && is_array($four_lvl['attributes'])) // задаем атрибуты 4 уровню
                                    {
                                        foreach ($four_lvl['attributes'] as $atr)
                                        {
                                            $teg_four->setAttribute($atr['name'], $atr['value']);
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }
            $this->dom->save("yml2.xml");
        }
    }
}

// массив который будем собирать в админке
$yml_array = array(
    array(
        'name' => 'name',
        'attributes' => null,
        'text' => 'ABC',
        'inserted' => null,
    ),
    array(
        'name' => 'company',
        'attributes' => null,
        'text' => 'ABC inc.',
        'inserted' => null,
    ),
    array(
        'name' => 'url',
        'attributes' => null,
        'text' => 'ABC.com',
        'inserted' => null,
    ),
    array(
        'name' => 'currencies',
        'attributes' => null,
        'text' => null,
        'inserted' => array(
            array(
                'name' => 'currency',
                'attributes' => array(
                    array(
                        'name' => 'id',
                        'value' => 'RUR',
                    ),
                    array(
                        'name' => 'rate',
                        'value' => '80',
                    ),
                ),
                'text' => null,
                'inserted' => null,
            ),
            array(
                'name' => 'currency',
                'attributes' => array(
                    array(
                        'name' => 'id',
                        'value' => 'RUR',
                    ),
                    array(
                        'name' => 'rate',
                        'value' => '80',
                    ),
                ),
                'text' => null,
                'inserted' => null,
            ),
        ),
    ),
    array(
        'name' => 'categories',
        'attributes' => null,
        'text' => null,
        'inserted' => array(
            array(
                'name' => 'category',
                'attributes' => array(
                    array(
                        'name' => 'id',
                        'value' => '1234',
                    ),
                    array(
                        'name' => 'parentId',
                        'value' => '1278',
                    ),
                ),
                'text' => 'Телевизоры',
                'inserted' => null,
            ),
            array(
                'name' => 'category',
                'attributes' => array(
                    array(
                        'name' => 'id',
                        'value' => '1244',
                    ),
                    array(
                        'name' => 'parentId',
                        'value' => '3278',
                    ),
                ),
                'text' => 'Медиа-плееры',
                'inserted' => null,
            ),
        ),
    ),
    array(
        'name' => 'offers',
        'attributes' => null,
        'text' => null,
        'inserted' => array(
            array(
                'name' => 'offer',
                'attributes' => array(
                    array(
                        'name' => 'id',
                        'value' => '1234',
                    ),
                    array(
                        'name' => 'available',
                        'value' => 'true',
                    ),
                    array(
                        'name' => 'bid',
                        'value' => '1278',
                    ),
                    array(
                        'name' => 'cbid',
                        'value' => '1278',
                    ),
                ),
                'text' => null,
                'inserted' => array(
                    array(
                        'name' => 'delivery-options',
                        'attributes' => null,
                        'text' => null,
                        'inserted' => array(
                            array(
                                'name' => 'option',
                                'attributes' => array(
                                    array(
                                        'name' => 'cost',
                                        'value' => '1000',
                                    ),
                                    array(
                                        'name' => 'days',
                                        'value' => '1',
                                    ),
                                    array(
                                        'name' => 'order-before',
                                        'value' => '15',
                                    ),
                                ),
                                'text' => null,
                                'inserted' => null,
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);

// вызываем скрипт создания юмл документа
$dom = new xmlGenerate($yml_array);

$dom->ymlCreate();