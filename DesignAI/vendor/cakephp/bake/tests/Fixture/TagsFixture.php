<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         2.6.1
 * @license       https://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Bake\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class TagsFixture extends TestFixture
{
    public array $records = [
        ['name' => 'tag1', 'description' => 'A big description', 'created' => '2016-01-01 00:00'],
        ['name' => 'tag2', 'description' => 'Another big description', 'created' => '2016-01-01 00:00'],
        ['name' => 'tag3', 'description' => 'Yet another one', 'created' => '2016-01-01 00:00'],
    ];
}
