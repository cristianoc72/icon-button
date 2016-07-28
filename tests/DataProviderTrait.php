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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class DataProviderTrait.
 *
 * @author Cristiano Cinotti
 */
trait DataProviderTrait
{
    public function buttonTypeProvider()
    {
        return [
            [ButtonType::class],
            [SubmitType::class],
        ];
    }

    public function nameProvider()
    {
        return [
            [ButtonType::class, 'next_step', '<span class="glyphicon glyphicon-step-forward"></span>'],
            [SubmitType::class, 'next_step', '<span class="glyphicon glyphicon-step-forward"></span>'],
            [ButtonType::class, 'previous_step', '<span class="glyphicon glyphicon-step-backward"></span>'],
            [SubmitType::class, 'previous_step', '<span class="glyphicon glyphicon-step-backward"></span>'],
        ];
    }

    public function optionsProvider()
    {
        return [
            ['', 0, 0],
            ['', 1, 1],
            ['awesome-icon', 0, 0],
            ['awesome-icon', 1, 1],
        ];
    }

    public function renderWidgetProvider()
    {
        return [
            [ButtonType::class, null, 0,
<<<EOF
<button type="button" id="button" name="button" class="btn btn-default">
                            [trans]Button[/trans]
    </button>
EOF
            ],
            [ButtonType::class, null, 1,
<<<EOF
<button type="button" id="button" name="button" class="btn btn-default">
                            [trans]Button[/trans]
    </button>
EOF
            ],
            [SubmitType::class, null, 0,
<<<EOF
<button type="submit" id="submit" name="submit" class="btn btn-default">
                            [trans]Submit[/trans]
    </button>
EOF
            ],
            [SubmitType::class, null, 1,
<<<EOF
<button type="submit" id="submit" name="submit" class="btn btn-default">
                            [trans]Submit[/trans]
    </button>
EOF
            ],
            [ButtonType::class, 'awesome-icon', 0,
<<<EOF
<button type="button" id="button" name="button" class="btn btn-default">
                <span class="glyphicon awesome-icon"></span>
        [trans]Button[/trans]    </button>
EOF
            ],
            [ButtonType::class, 'awesome-icon', 1,
<<<EOF
<button type="button" id="button" name="button" class="btn btn-default">
                [trans]Button[/trans]<span class="glyphicon awesome-icon"></span>
            </button>
EOF
            ],
            [ButtonType::class, 'awesome-icon', 'before',
<<<EOF
<button type="button" id="button" name="button" class="btn btn-default">
                <span class="glyphicon awesome-icon"></span>
        [trans]Button[/trans]    </button>
EOF
            ],
            [ButtonType::class, 'awesome-icon', 'after',
<<<EOF
<button type="button" id="button" name="button" class="btn btn-default">
                [trans]Button[/trans]<span class="glyphicon awesome-icon"></span>
            </button>
EOF
            ],
            [SubmitType::class, 'awesome-icon', 0,
<<<EOF
<button type="submit" id="submit" name="submit" class="btn btn-default">
                <span class="glyphicon awesome-icon"></span>
        [trans]Submit[/trans]    </button>
EOF
            ],
            [SubmitType::class, 'awesome-icon', 1,
<<<EOF
<button type="submit" id="submit" name="submit" class="btn btn-default">
                [trans]Submit[/trans]<span class="glyphicon awesome-icon"></span>
            </button>
EOF
            ],
            [SubmitType::class, 'awesome-icon', 'before',
<<<EOF
<button type="submit" id="submit" name="submit" class="btn btn-default">
                <span class="glyphicon awesome-icon"></span>
        [trans]Submit[/trans]    </button>
EOF
            ],
            [SubmitType::class, 'awesome-icon', 'after',
<<<EOF
<button type="submit" id="submit" name="submit" class="btn btn-default">
                [trans]Submit[/trans]<span class="glyphicon awesome-icon"></span>
            </button>
EOF
            ],
        ];
    }
}
