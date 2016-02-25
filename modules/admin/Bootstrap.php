<?php

namespace modules\admin;

use yii\base\BootstrapInterface;

/**
 * Gallery module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        // Add module URL rules.
        $app->getUrlManager()->addRules(
            [
                '' => 'admin/default/index',
                '<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>'
            ]
        );

        // Add module I18N category.
        if (!isset($app->i18n->translations['vova07/admin']) && !isset($app->i18n->translations['modules/*'])) {
            $app->i18n->translations['modules/admin'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@modules/admin/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'modules/admin' => 'admin.php',
                ]
            ];
        }
    }
}
