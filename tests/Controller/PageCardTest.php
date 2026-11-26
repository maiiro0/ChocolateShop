<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\TestWith;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PageCardTest extends WebTestCase
{
    #[TestWith(['/', 'Accueil'])]
    #[TestWith(['/product', 'Catalogue'])]
    #[TestWith(['/contact', 'Entrer en contact'])]
    public function testPageDisplaysItsOwnCardContent(string $path, string $text): void
    {
        $client = static::createClient();
        $client->request('GET', $path);

        self::assertResponseIsSuccessful();
        self::assertSelectorTextSame('div.bg-primary > p', $text);
    }
}
