<?php

namespace bertoost\mailjet\services;

use Craft;
use craft\helpers\App;
use Mailjet\Client;
use Mailjet\Resources;

class MessagesService extends AbstractService
{
    private ?Client $client;

    public function init(): void
    {
        parent::init();

        $emailSettings = Craft::$app->getProjectConfig()->get('email');
        $this->client = new Client(
            App::parseEnv($emailSettings['transportSettings']['apiKey']),
            App::parseEnv($emailSettings['transportSettings']['apiSecret'])
        );
    }

    public function getTotalMessages(): int
    {
        $cacheKey = 'mailjet.messages_total';
        if (false === ($total = $this->cache->get($cacheKey))) {
            $result = $this->client->get(
                Resources::$Message, [
                    'filters' => [
                        'countOnly' => true,
                    ],
                ]
            );

            if ($result->success()) {
                $total = $result->getTotal();
                $this->cacheIt($cacheKey, $total);
            }
        }

        return $total;
    }

    public function getMessagesList(int $limit = 200, int $offset = 0): ?array
    {
        $cacheKey = implode('-', ['mailjet', 'messages', $limit, $offset]);
        if (false === ($messages = $this->cache->get($cacheKey))) {
            // get messages
            $result = $this->client->get(
                Resources::$Message, [
                    'filters' => [
                        'ShowSubject' => true,
                        'ShowContactAlt' => true,
                        'Limit' => $limit,
                        'Offset' => $offset,
                        'S0rt' => 'CreatedAt DESC',
                    ],
                ]
            );

            if ($result->success()) {
                // make them an array
                $messages = $result->getData();

                foreach ($messages as $i => $message) {
                    // include the sender details
                    $messages[$i]['Sender'] = $this->getSenderById($message['SenderID']);
                }

                $this->cacheIt($cacheKey, $messages);
            }
        }

        return $messages !== false ? $messages : [];
    }

    public function getSenderById(int $id): ?array
    {
        $cacheKey = implode('-', ['mailjet', 'senders', $id]);
        if (false === ($sender = $this->cache->get($cacheKey))) {
            // get sender by id
            $sender = $this->client->get(Resources::$Sender, ['id' => $id])->getData()[0];
            $this->cacheIt($cacheKey, $sender);
        }

        return $sender;
    }
}