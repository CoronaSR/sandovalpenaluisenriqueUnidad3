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
 * @since         1.2.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TranslateFixture
 */
class TranslatesFixture extends TestFixture
{
    /**
     * table property
     *
     * @var string
     */
    public string $table = 'i18n';

    /**
     * records property
     *
     * @var array
     */
    public array $records = [
        ['locale' => 'eng', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Title #1'],
        ['locale' => 'eng', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'body', 'content' => 'Content #1'],
        ['locale' => 'eng', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'description', 'content' => 'Description #1'],
        ['locale' => 'spa', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'body', 'content' => 'Contenido #1'],
        ['locale' => 'spa', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'description', 'content' => ''],
        ['locale' => 'deu', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Titel #1'],
        ['locale' => 'deu', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'body', 'content' => 'Inhalt #1'],
        ['locale' => 'cze', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Titulek #1'],
        ['locale' => 'cze', 'model' => 'Articles', 'foreign_key' => 1, 'field' => 'body', 'content' => 'Obsah #1'],
        ['locale' => 'eng', 'model' => 'Articles', 'foreign_key' => 2, 'field' => 'title', 'content' => 'Title #2'],
        ['locale' => 'eng', 'model' => 'Articles', 'foreign_key' => 2, 'field' => 'body', 'content' => 'Content #2'],
        ['locale' => 'deu', 'model' => 'Articles', 'foreign_key' => 2, 'field' => 'title', 'content' => 'Titel #2'],
        ['locale' => 'deu', 'model' => 'Articles', 'foreign_key' => 2, 'field' => 'body', 'content' => 'Inhalt #2'],
        ['locale' => 'cze', 'model' => 'Articles', 'foreign_key' => 2, 'field' => 'title', 'content' => 'Titulek #2'],
        ['locale' => 'cze', 'model' => 'Articles', 'foreign_key' => 2, 'field' => 'body', 'content' => 'Obsah #2'],
        ['locale' => 'eng', 'model' => 'Articles', 'foreign_key' => 3, 'field' => 'title', 'content' => 'Title #3'],
        ['locale' => 'eng', 'model' => 'Articles', 'foreign_key' => 3, 'field' => 'body', 'content' => 'Content #3'],
        ['locale' => 'deu', 'model' => 'Articles', 'foreign_key' => 3, 'field' => 'title', 'content' => 'Titel #3'],
        ['locale' => 'deu', 'model' => 'Articles', 'foreign_key' => 3, 'field' => 'body', 'content' => 'Inhalt #3'],
        ['locale' => 'cze', 'model' => 'Articles', 'foreign_key' => 3, 'field' => 'title', 'content' => 'Titulek #3'],
        ['locale' => 'cze', 'model' => 'Articles', 'foreign_key' => 3, 'field' => 'body', 'content' => 'Obsah #3'],
        ['locale' => 'eng', 'model' => 'Comments', 'foreign_key' => 1, 'field' => 'comment', 'content' => 'Comment #1'],
        ['locale' => 'eng', 'model' => 'Comments', 'foreign_key' => 2, 'field' => 'comment', 'content' => 'Comment #2'],
        ['locale' => 'eng', 'model' => 'Comments', 'foreign_key' => 3, 'field' => 'comment', 'content' => 'Comment #3'],
        ['locale' => 'eng', 'model' => 'Comments', 'foreign_key' => 4, 'field' => 'comment', 'content' => 'Comment #4'],
        ['locale' => 'spa', 'model' => 'Comments', 'foreign_key' => 4, 'field' => 'comment', 'content' => 'Comentario #4'],
        ['locale' => 'eng', 'model' => 'Authors', 'foreign_key' => 1, 'field' => 'name', 'content' => 'May-rianoh'],
        ['locale' => 'dan', 'model' => 'NumberTrees', 'foreign_key' => 1, 'field' => 'name', 'content' => 'Elektroniker'],
        ['locale' => 'dan', 'model' => 'NumberTrees', 'foreign_key' => 11, 'field' => 'name', 'content' => 'Alien Tingerne'],
        ['locale' => 'eng', 'model' => 'SpecialTags', 'foreign_key' => 2, 'field' => 'extra_info', 'content' => 'Translated Info'],
    ];
}
