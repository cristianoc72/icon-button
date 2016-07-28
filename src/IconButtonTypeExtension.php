<?php
/**
 * This file is part of the icon-button package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace cristianoc72\IconButton;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class IconButtonTypeExtension.
 *
 * @author  Cristiano Cinotti <cristianocinotti@gmail.com>
 */
class IconButtonTypeExtension extends AbstractTypeExtension
{
    public function getExtendedType()
    {
        return ButtonType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['icon', 'icon_position']);
        $resolver->setDefaults(['attr' => ['class' => 'btn btn-default']]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('icon', $options)) {
            $icon = $options['icon'];

            if (!array_key_exists('icon_position', $options) || !in_array($options['icon_position'], [0, 1, 'after', 'before'], true)) {
                throw new \InvalidArgumentException('`icon_position` property can have only 0, 1, `after` or `before` value.');
            }

            $iconPosition = $options['icon_position'];

            if ('before' == $iconPosition) {
                $iconPosition = 0;
            } elseif ('after' == $iconPosition) {
                $iconPosition = 1;
            }
        } else {
            $icon = null;
            $iconPosition = null;
        }

        $view->vars['icon'] = $icon;
        $view->vars['icon_position'] = $iconPosition;
    }
}
