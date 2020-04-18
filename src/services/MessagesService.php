<?php

namespace bertoost\mailjet\services;

use Craft;
use Mailjet\Client;
use Mailjet\Resources;

/**
 * Class MessagesService
 */
class MessagesService extends AbstractService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $emailSettings = Craft::$app->getProjectConfig()->get('email');
        $this->client = new Client(
            Craft::parseEnv($emailSettings['transportSettings']['apiKey']),
            Craft::parseEnv($emailSettings['transportSettings']['apiSecret'])
        );
    }

    /**
     * Returns the total number of messages
     *
     * @return int
     */
    public function getTotalMessages(): int
    {
        $cacheKey = 'mailjet.messages_total';
        if (false === ($total = $this->cache->get($cacheKey))) {

            $result = $this->client->get(Resources::$Message, [
                'filters' => [
                    'countOnly' => true,
                ],
            ]);

            if ($result->success()) {

                $total = $result->getTotal();
                $this->cacheIt($cacheKey, $total);
            }
        }

        return $total;
    }

    /**
     * Get all messages send by the API
     *
     * @param int $limit
     * @param int $offset
     *
     * @return array|null
     */
    public function getMessagesList(int $limit = 200, int $offset = 0): ?array
    {
        $cacheKey = implode('-', ['mailjet', 'messages', $limit, $offset]);
        if (false === ($messages = $this->cache->get($cacheKey))) {

            // get messages
            $result = $this->client->get(Resources::$Message, [
                'filters' => [
                    'ShowSubject'    => true,
                    'ShowContactAlt' => true,
                    'Limit'          => $limit,
                    'Offset'         => $offset,
                    'S0rt'           => 'CreatedAt DESC',
                ],
            ]);

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

    /**
     * Gets a sender based on given id
     *
     * @param int $id
     *
     * @return array|null
     */
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