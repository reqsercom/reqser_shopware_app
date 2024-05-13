<?php declare(strict_types=1);

namespace App\EventListener;

use Shopware\App\SDK\HttpClient\ClientFactory;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Shopware\App\SDK\Context\Webhook\WebhookAction;
use Psr\Log\LoggerInterface;

#[AsEventListener(event: 'webhook.product.written')]
class ProductUpdatedListener
{
    public function __construct(private readonly ClientFactory $clientFactory, private readonly LoggerInterface $logger)
    {
    }

    public function __invoke(WebhookAction $action): void
    {
        $client = $this->clientFactory->createSimpleClient($action->shop);

        $updatedFields = $action->payload[0]['updatedFields'];
        $id = $action->payload[0]['primaryKey'];

        //Here we could add custom logic, but for Reqser App enough to tell the primary key that was updated
        //https://developer.shopware.com/docs/guides/plugins/apps/starter/product-translator.html
    }
}