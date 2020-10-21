<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Editor\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Editor\Models;

use Modules\Admin\Models\AccountMapper;
use Modules\Tag\Models\TagMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Editor doc mapper class.
 *
 * @package Modules\Editor\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class EditorDocMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'editor_doc_id'         => ['name' => 'editor_doc_id',         'type' => 'int',      'internal' => 'id'],
        'editor_doc_created_by' => ['name' => 'editor_doc_created_by', 'type' => 'int',      'internal' => 'createdBy', 'readonly' => true],
        'editor_doc_title'      => ['name' => 'editor_doc_title',      'type' => 'string',   'internal' => 'title'],
        'editor_doc_plain'      => ['name' => 'editor_doc_plain',      'type' => 'string',   'internal' => 'plain'],
        'editor_doc_content'    => ['name' => 'editor_doc_content',    'type' => 'string',   'internal' => 'content'],
        'editor_doc_path'       => ['name' => 'editor_doc_path',       'type' => 'string',   'internal' => 'path'],
        'editor_doc_created_at' => ['name' => 'editor_doc_created_at', 'type' => 'DateTimeImmutable', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'external'   => 'editor_doc_created_by',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'tags' => [
            'mapper'   => TagMapper::class,
            'table'    => 'editor_doc_tag',
            'self'     => 'editor_doc_tag_dst',
            'external' => 'editor_doc_tag_src',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'editor_doc';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'editor_doc_id';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'editor_doc_created_at';
}
