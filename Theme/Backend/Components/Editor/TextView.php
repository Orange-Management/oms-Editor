<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Editor
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Editor\Theme\Backend\Components\Editor;

use phpOMS\Localization\L11nManager;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Component view.
 *
 * @package Modules\Editor
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 * @codeCoverageIgnore
 */
class TextView extends View
{
    /**
     * Dom id
     *
     * @var string
     * @since 1.0.0
     */
    private string $id = '';

    /**
     * Dom name
     *
     * @var string
     * @since 1.0.0
     */
    public string $name = '';

    /**
     * Form id
     *
     * @var string
     * @since 1.0.0
     */
    private string $form = '';

    /**
     * Plain content
     *
     * @var string
     * @since 1.0.0
     */
    protected string $plain = '';

    /**
     * Preview content
     *
     * @var string
     * @since 1.0.0
     */
    private string $preview = '';

    /**
     * Tpl text identifier
     *
     * @var string
     * @since 1.0.0
     */
    private string $tplText = '';

    /**
     * Tpl value identifier
     *
     * @var string
     * @since 1.0.0
     */
    private string $tplValue = '';

    /**
     * Tpl value path
     *
     * @var string
     * @since 1.0.0
     */
    private string $tplValuePath = '';

    /**
     * Text value path
     *
     * @var string
     * @since 1.0.0
     */
    private string $textValuePath = '';

    /**
     * {@inheritdoc}
     */
    public function __construct(L11nManager $l11n = null, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($l11n, $request, $response);
        $this->setTemplate('/Modules/Editor/Theme/Backend/Components/Editor/inline-editor');
    }

    /**
     * Render the form id
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function renderId() : string
    {
        return $this->printHtml($this->id);
    }

    /**
     * Render the form name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function renderName() : string
    {
        return $this->printHtml($this->name);
    }

    /**
     * Render the form attribute name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function renderForm() : string
    {
        return $this->printHtml($this->form);
    }

    /**
     * Render the preview
     *
     * Usually markdown
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function renderPreview() : string
    {
        return $this->preview;
    }

    /**
     * Render the plain text
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function renderPlain() : string
    {
        return $this->printHtml($this->plain);
    }

    /**
     * Render template text reference
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function renderTplText() : string
    {
        return $this->printHtml($this->tplText);
    }

    /**
     * Render template value reference
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function renderTplValue() : string
    {
        return $this->printHtml($this->tplValue);
    }

    /**
     * {@inheritdoc}
     */
    public function render(...$data) : string
    {
        $this->id            = $data[0] ?? '';
        $this->name          = $data[1] ?? '';
        $this->form          = $data[2] ?? '';
        $this->plain         = $data[3] ?? '';
        $this->preview       = $data[4] ?? '';
        $this->tplText       = $data[5] ?? '';
        $this->tplValue      = $data[6] ?? '';
        $this->tplValuePath  = $data[7] ?? '';
        $this->textValuePath = $data[8] ?? '';

        return parent::render();
    }
}
