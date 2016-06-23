<?php
/**
 * This file is part of the icon-button package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace IconButton\tests;

use IconButton\IconButtonTypeExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bridge\Twig\Tests\Extension\Fixtures\StubFilesystemLoader;
use Symfony\Bridge\Twig\Tests\Extension\Fixtures\StubTranslator;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class IconSubmitExtensionTestCase.
 *
 * @author  Cristiano Cinotti <cristianocinotti@gmail.com>
 */
class IconButtonExtensionTestCase extends TypeTestCase
{
    protected $extension;

    protected function setUp()
    {
        parent::setUp();

        $this->factory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->getExtensions())
            ->addTypeExtension(new IconButtonTypeExtension())
            ->getFormFactory();

        $rendererEngine = new TwigRendererEngine(array(
            'bootstrap_3_layout.html.twig',
            'icon_button.html.twig',
        ));
        $renderer = new TwigRenderer($rendererEngine);

        $this->extension = new FormExtension($renderer);

        $loader = new StubFilesystemLoader(array(
            __DIR__.'/../vendor/symfony/twig-bridge/Resources/views/Form',
            __DIR__.'/../resources/template',
        ));

        $environment = new \Twig_Environment($loader, array('strict_variables' => true));
        $environment->addExtension(new TranslationExtension(new StubTranslator()));
        $environment->addExtension($this->extension);

        $this->extension->initRuntime($environment);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->extension = null;
    }

    protected function renderLabel(FormView $view, $label = null, array $vars = array())
    {
        if ($label !== null) {
            $vars += array('label' => $label);
        }

        return (string) $this->extension->renderer->searchAndRenderBlock($view, 'label', $vars);
    }

    protected function renderWidget(FormView $view, array $vars = array())
    {
        return (string) $this->extension->renderer->searchAndRenderBlock($view, 'widget', $vars);
    }
}
