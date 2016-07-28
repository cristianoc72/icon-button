<?php
/**
 * This file is part of the icon-button package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace cristianoc72\IconButton\Tests;

use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class IconButtonTypeExtensionTest extends IconButtonExtensionTestCase
{
    use DataProviderTrait;

    /**
     * @dataProvider buttonTypeProvider
     */
    public function testOptionsAreNullIfNotSpecified($buttonType)
    {
        $form = $this->factory->create($buttonType);
        $view = $form->createView();

        $this->assertNull($view->vars['icon']);
        $this->assertNull($view->vars['icon_position']);
    }

    /**
     * @dataProvider optionsProvider
     */
    public function testOptions($iconOption, $iconPositionOption, $expectedPosition)
    {
        $form = $this->factory->create(ButtonType::class, null, ['icon' => $iconOption, 'icon_position' => $iconPositionOption]);
        $view = $form->createView();

        $this->assertEquals($expectedPosition, $view->vars['icon_position']);
        $this->assertEquals($iconOption, $view->vars['icon']);
    }

    /**
     * @dataProvider buttonTypeProvider
     */
    public function testRenderWithoutOptions($buttonType)
    {
        $form = $this->factory->create($buttonType);
        $view = $form->createView();
        $label = $this->getLabelFromClass($buttonType);
        $name = lcfirst($label);

        $expected = "<button type=\"$name\" id=\"$name\" name=\"$name\" class=\"btn btn-default\">
                            [trans]".$label.'[/trans]
    </button>';

        $this->assertEquals($expected, $this->renderWidget($view));
    }

    /**
     * @dataProvider buttonTypeProvider
     */
    public function testRenderWithLabelOption($buttonType)
    {
        $form = $this->factory->create($buttonType, null, ['label' => 'My Awesome Button']);
        $view = $form->createView();

        $name = lcfirst($this->getLabelFromClass($buttonType));
        $expected = <<<EOF
<button type="$name" id="$name" name="$name" class="btn btn-default">
                            [trans]My Awesome Button[/trans]
    </button>
EOF;

        $this->assertEquals($expected, $this->renderWidget($view));
    }

    /**
     * @dataProvider renderWidgetProvider
     */
    public function testRenderWidget($type, $icon, $iconPosition, $expected)
    {
        $form = $this->factory->create($type, null, ['icon' => $icon, 'icon_position' => $iconPosition]);
        $view = $form->createView();

        $this->assertEquals($expected, $this->renderWidget($view));
    }

    /**
     * @dataProvider renderWidgetProvider
     */
    public function testRenderWidgetWithLabel($type, $icon, $iconPosition, $expected)
    {
        $form = $this->factory->create($type, null, [
            'label' => 'My Awesome Button',
            'icon' => $icon,
            'icon_position' => $iconPosition,
        ]);
        $view = $form->createView();

        $search = '[trans]'.$this->getLabelFromClass($type).'[/trans]';
        $replace = '[trans]My Awesome Button[/trans]';
        $expected = str_replace($search, $replace, $expected);

        $this->assertEquals($expected, $this->renderWidget($view));
    }

    /**
     * @dataProvider nameProvider
     */
    public function testSetIconAndIconPositionByName($type, $name, $expected)
    {
        $form = $this->factory->createNamed($name, $type);
        $view = $form->createView();

        $this->assertContains($expected, $this->renderWidget($view));
    }

    /**
     * @dataProvider buttonTypeProvider
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidPositionThrowsException($type)
    {
        $form = $this->factory->create($type, null, ['icon' => 'awesome-icon', 'icon_position' => 'foo']);
        $view = $form->createView();
    }

    /**
     * Get the default label from the button class name.
     *
     * @param string $class The class name
     *
     * @return string
     */
    private function getLabelFromClass($class)
    {
        $pieces = explode('\\', $class);
        $piece = array_pop($pieces);

        return substr($piece, 0, strpos($piece, 'Type'));
    }
}
