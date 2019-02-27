<?php

namespace bertoost\mailjet\utilities;

use bertoost\mailjet\assets\utility\UtilityAsset;
use bertoost\mailjet\Plugin;
use Craft;
use craft\base\Utility;

/**
 * Class MailjetEventsUtility
 */
class MailjetEventsUtility extends Utility
{
    /**
     * {@inheritdoc}
     */
    public static function displayName(): string
    {
        return Craft::t('mailjet', 'Mailjet Messages');
    }

    /**
     * {@inheritdoc}
     */
    public static function id(): string
    {
        return 'mailjet-messages-utility';
    }

    /**
     * {@inheritdoc}
     */
    public static function iconPath()
    {
        return Craft::getAlias('@bertoost/mailjet/icon.svg');
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public static function contentHtml(): string
    {
        $service = Plugin::getInstance()->getMessages();
        $totalMessages = $service->getTotalMessages();
        $page = Craft::$app->getRequest()->getQueryParam('page', 1);

        $limit = 14;
        $offset = ($page - 1) * $limit;
        $totalPages = (int) ceil($totalMessages / $limit);

        // view
        $view = Craft::$app->getView();
        $view->registerAssetBundle(UtilityAsset::class);

        return $view->renderTemplate('mailjet/utility', [
            'messages' => $service->getMessagesList($limit, $offset),
            'totals'   => [
                'messages' => $totalMessages,
                'pages'    => $totalPages,
            ],
            'currentPage' => $page,
        ]);
    }
}