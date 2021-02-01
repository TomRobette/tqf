<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Beelab\PaypalBundle\Entity\Transaction as BaseTransaction;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction extends BaseTransaction
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    public function getDescription(): ?string
    {
        // here you can return a generic description, if you don't want to list items
        return "AAAAAH";
    }

    public function getItems(): array
    {
        // here you can return an array of items, with each item being an array of name, quantity, price
        // Note that if the total (price * quantity) of items doesn't match total amount, this won't work
        return [['name' => 'an item', 'price' => '1.00', 'quantity' => 2]];
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
}
